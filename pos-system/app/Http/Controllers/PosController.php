<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $cart = session()->get('cart', []);
        return view('pos.index', compact('products', 'cart'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $sale = Sale::create([
            'total' => $total,
            'user_id' => auth()->id(),
            'sale_date' => now(),
        ]);

        foreach ($cart as $productId => $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            // Update stock
            $product = Product::find($productId);
            $product->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');
        return redirect()->route('pos.index')->with('success', 'Sale completed successfully.');
    }
}
