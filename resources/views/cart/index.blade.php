@extends('layouts.app')

@section('title', 'Mon Panier')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Mon Panier</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($cartItems->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Articles dans votre panier</h2>
                        <form action="{{ route('cart.clear') }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir vider votre panier ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                Vider le panier
                            </button>
                        </form>
                    </div>

                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                    @if($item->product->getFirstMediaUrl())
                                        <img src="{{ $item->product->getFirstMediaUrl() }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                    <p class="text-lg font-bold text-blue-600">{{ number_format($item->product->price, 2) }} Fcfa</p>
                                </div>

                                <!-- Quantity Controls -->
                                <div class="flex items-center space-x-2">
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="quantity" onchange="this.form.submit()" class="border border-gray-300 rounded px-2 py-1 text-sm">
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </form>
                                </div>

                                <!-- Total Price -->
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">{{ number_format($item->quantity * $item->product->price, 2) }} Fcfa</p>
                                </div>

                                <!-- Remove Button -->
                                <div>
                                    <form action="{{ route('cart.remove', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Cart Summary -->
                    <div class="mt-6 border-t pt-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-lg font-semibold text-gray-900">Total: {{ number_format($total, 2) }} Fcfa</p>
                                <p class="text-sm text-gray-600">{{ $cartItems->count() }} article(s)</p>
                            </div>
                            <div class="flex space-x-4">
                                <a href="{{ route('products.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                    Continuer les achats
                                </a>
                                {{-- <a href="{{ route('orders.create') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"> --}}
                                    Passer la commande
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Votre panier est vide</h3>
                <p class="mt-1 text-sm text-gray-500">Commencez par ajouter quelques produits à votre panier.</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Découvrir nos produits
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 