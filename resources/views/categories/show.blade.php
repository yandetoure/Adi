@extends('layouts.app')

@section('title', $category->name . ' - ADI Store')
@section('meta_description', $category->description ?? 'Découvrez nos produits dans la catégorie ' . $category->name)
@section('meta_keywords', $category->name . ', produits, ADI Store')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Category Header -->
    <div class="category-header relative bg-gradient-to-r from-blue-600 to-purple-700 text-white py-16 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-20"
             style="background-image: url('https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/80 to-purple-700/80"></div>

        <!-- Content -->
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">{{ $category->name }}</h1>
                <p class="text-lg md:text-xl opacity-90 hidden md:block">{{ $products->count() }} produits disponibles</p>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="container mx-auto px-4 py-12">
        @if($products->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach($products as $product)
                    <div class="product-card-compact bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                        <a href="{{ route('products.show', $product) }}" class="block">
                            <div class="product-image-container relative">
                                <img src="{{ $product->image_url }}"
                                     alt="{{ $product->name }}"
                                     class="product-image w-full h-32 object-cover">
                                @if($product->discount_percentage > 0)
                                    <div class="discount-badge-compact absolute top-2 right-2 bg-orange-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                                        -{{ $product->discount_percentage }}%
                                    </div>
                                @endif
                            </div>
                            <div class="product-info-compact p-3">
                                <h3 class="product-title-compact text-sm font-medium text-gray-900 mb-2 line-clamp-2 leading-tight">
                                    {{ Str::limit($product->name, 50) }}
                                </h3>
                                <div class="price-section-compact">
                                    @if($product->discount_percentage > 0)
                                        <span class="current-price-compact text-orange-600 font-bold text-sm">
                                            {{ number_format($product->price * (1 - $product->discount_percentage / 100), 0, ',', ' ') }} FCFA
                                        </span>
                                        <span class="original-price-compact text-gray-500 text-xs line-through ml-1">
                                            {{ number_format($product->price, 0, ',', ' ') }}
                                        </span>
                                    @else
                                        <span class="current-price-compact text-gray-900 font-bold text-sm">
                                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-box text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun produit trouvé</h3>
                <p class="text-gray-600 mb-8">Cette catégorie ne contient actuellement aucun produit.</p>
                <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                    Retour à l'accueil
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .category-header {
        position: relative;
        background-attachment: fixed;
    }

    @media (max-width: 768px) {
        .category-header {
            background-attachment: scroll;
            padding: 2rem 0;
        }

        .category-header h1 {
            font-size: 1.875rem;
        }
    }

    .product-card-compact {
        transition: all 0.3s ease;
    }

    .product-card-compact:hover {
        transform: translateY(-2px);
    }

    .product-image-container {
        position: relative;
        overflow: hidden;
    }

    .product-image {
        transition: transform 0.3s ease;
    }

    .product-card-compact:hover .product-image {
        transform: scale(1.05);
    }

    .discount-badge-compact {
        z-index: 10;
    }

    .product-title-compact {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
