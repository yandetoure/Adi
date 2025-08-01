@extends('layouts.app')

@section('title', $category->name . ' - ADI Informatique')
@section('meta_description', $category->description ?? 'Découvrez nos produits dans la catégorie ' . $category->name . ' - ADI Informatique')
@section('meta_keywords', $category->name . ', produits, ADI Informatique, Dakar, Sénégal')

@section('content')
<!-- Page Header -->
<div class="page-header py-16">
    <div class="container mx-auto px-4">
        <div class="page-header-content text-center">
            <div class="page-header-card">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $category->name }}</h1>
                <p class="text-xl text-white opacity-90">Découvrez notre sélection de produits {{ strtolower($category->name) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Products Count and Info -->
<div class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="results-info">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-boxes text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">{{ $products->count() }} produits</div>
                        <div class="text-gray-600">Catégorie {{ $category->name }}</div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Voir toutes les catégories
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Grid -->
<div class="py-12 bg-white">
    <div class="container mx-auto px-4">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-items-center">
                @foreach($products as $product)
                    <div class="product-card" onclick="window.location.href='{{ route('products.show', $product) }}'">
                        <div class="product-image-container">
                            @if($product->getFirstMediaUrl('images') && $product->getFirstMediaUrl('images') !== '')
                                <img src="{{ $product->getFirstMediaUrl('images') }}"
                                     alt="{{ $product->name }}"
                                     class="product-image">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-6xl text-gray-300"></i>
                                </div>
                            @endif

                            @if($product->discount_percentage > 0)
                                <div class="product-badge">
                                    -{{ $product->discount_percentage }}%
                                </div>
                            @endif

                            <button class="favorite-btn"
                                    onclick="event.stopPropagation(); toggleFavorite({{ $product->id }}, this)"
                                    data-product-id="{{ $product->id }}"
                                    title="Ajouter aux favoris">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>

                        <div class="product-content">
                            <div class="product-category">{{ $product->category->name }}</div>
                            <h4 class="product-title">{{ $product->name }}</h4>

                            @if($product->short_description)
                                <p class="product-description">{{ Str::limit($product->short_description, 80) }}</p>
                            @elseif($product->description)
                                <p class="product-description">{{ Str::limit(strip_tags($product->description), 80) }}</p>
                            @endif

                            <div class="product-price-container">
                                @if($product->discount_percentage > 0)
                                    <span class="product-price">
                                        {{ number_format($product->price * (1 - $product->discount_percentage / 100), 0, ',', ' ') }} FCFA
                                    </span>
                                    <span class="product-old-price">
                                        {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                    </span>
                                    <span class="product-discount">
                                        -{{ $product->discount_percentage }}%
                                    </span>
                                @else
                                    <span class="product-price">
                                        {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                    </span>
                                @endif
                            </div>

                            <button class="add-to-cart-btn" onclick="event.stopPropagation(); addToCart({{ $product->id }})">
                                <i class="fas fa-shopping-cart"></i>
                                Ajouter au panier
                            </button>
                        </div>
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
                <div class="space-x-4">
                    <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                        Retour à l'accueil
                    </a>
                    <a href="{{ route('categories.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                        Voir toutes les catégories
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    /* Product Grid Styles */
    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        border: 1px solid #f0f0f0;
        height: 100%;
        display: flex;
        flex-direction: column;
        max-width: 280px;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(59, 130, 246, 0.15);
        border-color: #3b82f6;
    }

    .product-image-container {
        position: relative;
        height: 200px;
        overflow: hidden;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        z-index: 10;
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
    }

    .favorite-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255,255,255,0.95);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 10;
        font-size: 0.9rem;
        backdrop-filter: blur(10px);
    }

    .favorite-btn:hover {
        background: #dc2626;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(220, 38, 38, 0.3);
    }

    .favorite-btn.favorited {
        background: #dc2626;
        color: white;
    }

    .product-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-category {
        font-size: 0.75rem;
        color: #6b7280;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .product-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-description {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price-container {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .product-price {
        font-size: 1.125rem;
        font-weight: 700;
        color: #059669;
    }

    .product-old-price {
        font-size: 0.875rem;
        color: #9ca3af;
        text-decoration: line-through;
    }

    .product-discount {
        font-size: 0.75rem;
        color: #dc2626;
        font-weight: 600;
    }

    .add-to-cart-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: auto;
    }

    .add-to-cart-btn:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    /* Results Info Styles */
    .results-info {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-radius: 16px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        border-left: 5px solid #3b82f6;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .product-image-container {
            height: 180px;
        }

        .product-content {
            padding: 1rem;
        }

        .results-info {
            padding: 1rem 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .product-grid {
            grid-template-columns: 1fr;
            justify-items: center;
        }
    }
</style>
@endsection
