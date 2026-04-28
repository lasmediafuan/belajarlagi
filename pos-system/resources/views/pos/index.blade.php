<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Point of Sale') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <div class="col-md-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4>Products</h4>
                            <div class="row">
                                @foreach($products as $product)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">${{ number_format($product->price, 2) }}</p>
                                                <p class="card-text">Stock: {{ $product->stock }}</p>
                                                <form action="{{ route('pos.addToCart') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="btn btn-primary" {{ $product->stock <= 0 ? 'disabled' : '' }}>Add to Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4>Cart</h4>
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <ul class="list-group mb-3">
                                @php $total = 0; @endphp
                                @foreach($cart as $id => $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $item['name'] }} ({{ $item['quantity'] }})
                                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                    </li>
                                    @php $total += $item['price'] * $item['quantity']; @endphp
                                @endforeach
                            </ul>
                            <h5>Total: ${{ number_format($total, 2) }}</h5>
                            <form action="{{ route('pos.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success" {{ empty($cart) ? 'disabled' : '' }}>Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>