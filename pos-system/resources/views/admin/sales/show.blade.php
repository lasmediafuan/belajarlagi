<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sale Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4>Sale ID: {{ $sale->id }}</h4>
                    <p>User: {{ $sale->user->name }}</p>
                    <p>Total: ${{ number_format($sale->total, 2) }}</p>
                    <p>Date: {{ $sale->sale_date->format('Y-m-d H:i') }}</p>

                    <h5 class="mt-4">Items:</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->saleItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>