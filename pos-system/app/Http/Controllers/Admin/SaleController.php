<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user', 'saleItems.product')->get();
        return view('admin.sales.index', compact('sales'));
    }

    public function show(string $id)
    {
        $sale = Sale::with('user', 'saleItems.product')->findOrFail($id);
        return view('admin.sales.show', compact('sale'));
    }
}
