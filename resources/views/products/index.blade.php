@extends('layouts.app')

@section('title', 'Nos Produits - ADI Store')
@section('meta_description', 'Découvrez notre sélection de produits de qualité. Trouvez ce que vous cherchez parmi notre large gamme.')
@section('meta_keywords', 'produits, boutique, ADI Store, qualité, sélection')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Nos Produits</h1>
            <p class="text-xl text-blue-100">Découvrez notre sélection de produits de qualité</p>
        </div>
    </div>
</section>

<!-- Filters and Search -->
<section class="bg-white py-8 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Search -->
            <div class="w-full md:w-96">
                <form method="GET" action="{{ route('products.index') }}" class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Rechercher un produit..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </form>
            </div>

            <!-- Category Filter -->
            <div class="flex gap-4">
                <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Sort -->
                <select name="sort" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récents</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nom A-Z</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
                    <!-- Product Image -->
                    <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                        @if($product->getFirstMediaUrl('images') && $product->getFirstMediaUrl('images') !== '')
                            <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Sale Badge -->
                        @if($product->is_on_sale && $product->current_price < $product->price)
                            <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-bold">
                                -{{ round((($product->price - $product->current_price) / $product->price) * 100) }}%
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <div class="mb-2">
                            <span class="text-sm text-gray-500">{{ $product->category->name }}</span>
                        </div>
                        
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <a href="{{ route('products.show', $product) }}" class="hover:text-blue-600 transition-colors">
                                {{ $product->name }}
                            </a>
                        </h3>
                        
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            {{ Str::limit($product->short_description ?? $product->description, 80) }}
                        </p>
                        
                        <!-- Price -->
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-2">
                                @if($product->current_price < $product->price)
                                    <span class="text-lg font-bold text-red-600">{{ number_format($product->current_price, 2) }} Fcfa</span>
                                    <span class="text-sm text-gray-500 line-through">{{ number_format($product->price, 2) }} Fcfa</span>
                                @else
                                    <span class="text-lg font-bold text-blue-600">{{ number_format($product->price, 2) }} Fcfa</span>
                                @endif
                            </div>
                            
                            <!-- Stock Status -->
                            @if($product->stock_quantity > 0)
                                <span class="text-sm text-green-600">En stock</span>
                            @else
                                <span class="text-sm text-red-600">Rupture</span>
                            @endif
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('products.show', $product) }}" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition-colors text-center">
                                Voir détails
                            </a>
                            
                            <!-- Favorite Button -->
                            <x-favorite-button :product="$product" />
                            
                            @if($product->stock_quantity > 0)
                                <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit trouvé</h3>
                <p class="mt-1 text-sm text-gray-500">Essayez de modifier vos critères de recherche.</p>
            </div>
        @endif
    </div>
</section>
@endsection 