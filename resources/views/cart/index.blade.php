@extends('layouts.app')

@section('title', 'Mon Panier - ADI Informatique')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center">
                <i class="fas fa-shopping-cart text-blue-600 mr-3"></i>
                Mon Panier
            </h1>
            <p class="text-gray-600">Gérez vos articles et finalisez votre commande</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h2 class="text-xl font-bold text-white flex items-center">
                                    <i class="fas fa-box mr-2"></i>
                                    Articles dans votre panier
                                </h2>
                                <form action="{{ route('cart.clear') }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir vider votre panier ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white hover:text-red-200 text-sm font-medium transition-colors">
                                        <i class="fas fa-trash mr-1"></i>
                                        Vider le panier
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach($cartItems as $item)
                                    <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0">
                                            @if($item->product->getFirstMediaUrl('images') && $item->product->getFirstMediaUrl('images') !== '')
                                                <img src="{{ $item->product->getFirstMediaUrl('images') }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     class="w-20 h-20 object-cover rounded-lg shadow-md">
                                            @else
                                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center shadow-md">
                                                    <i class="fas fa-image text-gray-400 text-xl"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Info -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-semibold text-gray-900 text-lg mb-1">{{ $item->product->name }}</h3>
                                            <p class="text-sm text-gray-600 mb-2">{{ $item->product->category->name }}</p>
                                            <p class="text-lg font-bold text-blue-600">{{ number_format($item->product->price, 0, ',', ' ') }} FCFA</p>
                                        </div>

                                        <!-- Quantity Controls -->
                                        <div class="flex items-center space-x-2">
                                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                @method('PUT')
                                                <select name="quantity" onchange="this.form.submit()" 
                                                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                                    @for($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </form>
                                        </div>

                                        <!-- Total Price -->
                                        <div class="text-right min-w-0">
                                            <p class="font-bold text-gray-900 text-lg">{{ number_format($item->quantity * $item->product->price, 0, ',', ' ') }} FCFA</p>
                                        </div>

                                        <!-- Remove Button -->
                                        <div>
                                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-all duration-200"
                                                        title="Retirer du panier">
                                                    <i class="fas fa-trash text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-8">
                        <div class="bg-gradient-to-r from-green-600 to-teal-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center">
                                <i class="fas fa-receipt mr-2"></i>
                                Résumé de la commande
                            </h2>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600">Sous-total</span>
                                    <span class="font-semibold text-gray-900">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                                </div>
                                
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600">Livraison</span>
                                    <span class="font-semibold text-green-600">
                                        @if($total >= 50000)
                                            <span class="text-green-600">Gratuite</span>
                                        @else
                                            <span class="text-gray-900">2,000 FCFA</span>
                                        @endif
                                    </span>
                                </div>
                                
                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-900">Total</span>
                                        <span class="text-2xl font-bold text-blue-600">
                                            @if($total >= 50000)
                                                {{ number_format($total, 0, ',', ' ') }} FCFA
                                            @else
                                                {{ number_format($total + 2000, 0, ',', ' ') }} FCFA
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                
                                @if($total < 50000)
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                        <div class="flex items-center text-yellow-800">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            <span class="text-sm">
                                                Ajoutez {{ number_format(50000 - $total, 0, ',', ' ') }} FCFA pour la livraison gratuite !
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="text-center text-sm text-gray-500 mb-4">
                                    {{ $cartItems->count() }} article(s) dans votre panier
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <a href="{{ route('orders.create') }}" 
                                   class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold py-4 px-6 hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 flex items-center justify-center shadow-lg">
                                    <i class="fas fa-check mr-2"></i>
                                    Finaliser la commande
                                </a>
                                
                                <a href="{{ route('products.index') }}" 
                                   class="w-full border-2 border-gray-300 text-gray-700 rounded-xl font-semibold py-4 px-6 hover:bg-gray-50 transition-all duration-200 flex items-center justify-center">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Continuer les achats
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-16">
                <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shopping-cart text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Votre panier est vide</h3>
                    <p class="text-gray-600 mb-8">Commencez par ajouter quelques produits à votre panier pour continuer vos achats.</p>
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        Découvrir nos produits
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    /* Animations personnalisées */
    .bg-gradient-to-r {
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Hover effects */
    .shadow-lg:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    /* Sticky positioning */
    .sticky {
        position: sticky;
        top: 2rem;
    }
</style>
@endsection 