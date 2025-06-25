@extends('layouts.app')

@section('title', 'ADI - Votre boutique en ligne de confiance')
@section('meta_description', 'Découvrez ADI, votre boutique en ligne de confiance. Une large sélection de produits de qualité, des prix compétitifs et un service client exceptionnel.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Bienvenue chez <span class="text-yellow-300">ADI</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100">
                Votre boutique en ligne de confiance pour tous vos besoins
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Découvrir nos produits
                </a>
                <a href="{{ route('categories.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                    Parcourir les catégories
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Pourquoi choisir ADI ?</h2>
            <p class="text-lg text-gray-600">Nous nous engageons à vous offrir la meilleure expérience d'achat possible</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Qualité garantie</h3>
                <p class="text-gray-600">Tous nos produits sont sélectionnés avec soin pour garantir la meilleure qualité.</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Livraison rapide</h3>
                <p class="text-gray-600">Recevez vos commandes rapidement avec notre service de livraison express.</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Support 24/7</h3>
                <p class="text-gray-600">Notre équipe est disponible 24h/24 et 7j/7 pour vous accompagner.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Categories -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Catégories populaires</h2>
            <p class="text-lg text-gray-600">Découvrez nos catégories les plus populaires</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $categories = \App\Models\Category::withCount('products')
                    ->where('is_active', true)
                    ->orderBy('products_count', 'desc')
                    ->limit(6)
                    ->get();
            @endphp
            
            @forelse($categories as $category)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-48 flex items-center justify-center">
                        <div class="text-center text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ $category->name }}</h3>
                            <p class="text-blue-100">{{ $category->products_count }} produits</p>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($category->description)
                            <p class="text-gray-600 mb-4">{{ Str::limit($category->description, 100) }}</p>
                        @endif
                        <a href="{{ route('categories.show', $category) }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
                            Voir les produits
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune catégorie disponible</h3>
                    <p class="text-gray-500">Les catégories apparaîtront ici une fois créées.</p>
                </div>
            @endforelse
        </div>
        
        @if($categories->count() > 0)
            <div class="text-center mt-8">
                <a href="{{ route('categories.index') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    Voir toutes les catégories
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Featured Products -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Produits en vedette</h2>
            <p class="text-lg text-gray-600">Découvrez nos produits les plus populaires</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $featuredProducts = \App\Models\Product::with('category')
                    ->where('is_active', true)
                    ->latest()
                    ->limit(8)
                    ->get();
            @endphp
            
            @forelse($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="bg-gray-200 h-48 flex items-center justify-center">
                        @if($product->getFirstMediaUrl('images'))
                            <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-blue-600 font-medium">{{ $product->category->name ?? 'Sans catégorie' }}</span>
                            <span class="text-sm text-gray-500">{{ $product->stock }} en stock</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        @if($product->short_description)
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->short_description, 80) }}</p>
                        @endif
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-blue-600">{{ number_format($product->price, 2) }} €</span>
                            <a href="{{ route('products.show', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                Voir détails
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun produit disponible</h3>
                    <p class="text-gray-500">Les produits apparaîtront ici une fois ajoutés.</p>
                </div>
            @endforelse
        </div>
        
        @if($featuredProducts->count() > 0)
            <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    Voir tous les produits
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Prêt à commencer vos achats ?</h2>
        <p class="text-xl text-blue-100 mb-8">Rejoignez des milliers de clients satisfaits qui font confiance à ADI</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @guest
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Créer un compte
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                    Se connecter
                </a>
            @else
                <a href="{{ route('products.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Commencer à acheter
                </a>
                <a href="{{ route('orders.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                    Mes commandes
                </a>
            @endguest
        </div>
    </div>
</section>
@endsection