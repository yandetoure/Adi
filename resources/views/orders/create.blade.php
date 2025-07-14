@extends('layouts.app')

@section('title', 'Finaliser la commande')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Finaliser votre commande</h1>
            <p class="text-gray-600">Remplissez les informations ci-dessous pour finaliser votre commande</p>
        </div>

        <form action="{{ route('orders.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <!-- Order Summary -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-shopping-cart mr-3"></i>
                        Résumé de votre commande
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        @if($item->product->getFirstMediaUrl('images'))
                                            <img src="{{ $item->product->getFirstMediaUrl('images') }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-16 h-16 object-cover rounded-lg">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                        <p class="text-sm text-gray-500">Quantité: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-blue-600">{{ number_format($item->quantity * $item->product->price, 0, ',', ' ') }} FCFA</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Total -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center text-lg font-bold">
                            <span>Total de la commande:</span>
                            <span class="text-2xl text-blue-600">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-teal-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-truck mr-3"></i>
                        Informations de livraison
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">
                                Adresse de livraison <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="shipping_address" 
                                name="shipping_address" 
                                rows="4" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                placeholder="Entrez votre adresse complète de livraison..."
                            >{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Numéro de téléphone <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                placeholder="Ex: +221 77 123 45 67"
                                value="{{ old('phone') }}"
                            >
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-edit mr-3"></i>
                        Informations supplémentaires
                    </h2>
                </div>
                <div class="p-6">
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notes pour la commande
                        </label>
                        <textarea 
                            id="notes" 
                            name="notes" 
                            rows="3" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Instructions spéciales, préférences de livraison, etc..."
                        >{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-600 to-orange-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-credit-card mr-3"></i>
                        Mode de paiement
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center p-4 border border-gray-200 rounded-xl hover:border-blue-500 transition-colors cursor-pointer">
                            <input type="radio" id="payment_cash" name="payment_method" value="cash" class="mr-3" checked>
                            <label for="payment_cash" class="flex items-center cursor-pointer">
                                <i class="fas fa-money-bill-wave text-green-600 mr-3 text-xl"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Paiement à la livraison</div>
                                    <div class="text-sm text-gray-600">Payez en espèces ou par carte à la réception</div>
                                </div>
                            </label>
                        </div>
                        
                        <div class="flex items-center p-4 border border-gray-200 rounded-xl hover:border-blue-500 transition-colors cursor-pointer">
                            <input type="radio" id="payment_mobile" name="payment_method" value="mobile" class="mr-3">
                            <label for="payment_mobile" class="flex items-center cursor-pointer">
                                <i class="fab fa-whatsapp text-green-600 mr-3 text-xl"></i>
                                <div>
                                    <div class="font-semibold text-gray-900">Paiement mobile</div>
                                    <div class="text-sm text-gray-600">Orange Money, Wave, Free Money</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                <a href="{{ route('cart.index') }}" 
                   class="w-full sm:w-auto px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-200 flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour au panier
                </a>
                
                <button type="submit" 
                        class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-check mr-2"></i>
                    Confirmer la commande
                </button>
            </div>
        </form>
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
    
    /* Focus styles */
    textarea:focus, input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
</style>
@endsection 