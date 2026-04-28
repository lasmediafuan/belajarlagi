<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as " . auth()->user()->role . "!") }}

                    @if(auth()->user()->isAdmin())
                        <div class="mt-4">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Manage Categories</a>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Manage Products</a>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
                            <a href="{{ route('admin.sales.index') }}" class="btn btn-primary">View Sales</a>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('pos.index') }}" class="btn btn-success">Go to POS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
