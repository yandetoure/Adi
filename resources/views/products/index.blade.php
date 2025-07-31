@extends('layouts.app')

@section('title', 'Nos Produits - ADI Informatique')
@section('meta_description', 'Découvrez notre sélection complète de produits informatiques de qualité. Trouvez exactement ce que vous cherchez parmi notre large gamme.')
@section('meta_keywords', 'produits, informatique, ordinateurs, accessoires, ADI, Sénégal')

@section('content')
<!-- Styles spécifiques à la page des produits -->
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.4) 100%),
                    url('https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .hero-content {
        position: relative;
        z-index: 10;
    }

    /* Sidebar Filters */
    .sidebar-filters {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        height: fit-content;
        position: sticky;
        top: 2rem;
    }

    .filter-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .filter-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .filter-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Search Input */
    .search-input {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem 1rem 1rem 3rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        width: 100%;
    }

    .search-input:focus {
        border-color: #3b82f6;
        background: white;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        outline: none;
        transform: translateY(-2px);
    }

    /* Price Range Slider */
    .price-range {
        margin: 1rem 0;
    }

    .price-slider {
        width: 100%;
        height: 6px;
        border-radius: 3px;
        background: #e5e7eb;
        outline: none;
        -webkit-appearance: none;
        appearance: none;
    }

    .price-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
    }

    .price-slider::-webkit-slider-thumb:hover {
        transform: scale(1.2);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .price-slider::-moz-range-thumb {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        cursor: pointer;
        border: none;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .price-values {
        display: flex;
        justify-content: space-between;
        margin-top: 0.5rem;
        font-size: 0.9rem;
        color: #6b7280;
    }

    /* Category Filter */
    .category-filter {
        max-height: 300px;
        overflow-y: auto;
    }

    .category-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
    }

    .category-item:hover {
        background: #f3f4f6;
    }

    .category-item.selected {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }

    .category-checkbox {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 2px solid #d1d5db;
        margin-right: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .category-item.selected .category-checkbox {
        background: white;
        border-color: white;
    }

    .category-count {
        margin-left: auto;
        font-size: 0.8rem;
        opacity: 0.7;
    }

    /* Sort Options */
    .sort-option {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
    }

    .sort-option:hover {
        background: #f3f4f6;
    }

    .sort-option.selected {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }

    /* Filter Buttons */
    .filter-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        width: 100%;
        margin-bottom: 1rem;
    }

    .filter-btn:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(59, 130, 246, 0.4);
    }

    .clear-btn {
        background: #f3f4f6;
        color: #6b7280;
        border: 2px solid #e5e7eb;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
    }

    .clear-btn:hover {
        background: #e5e7eb;
        color: #374151;
        transform: translateY(-1px);
    }

    /* Results Info */
    .results-info {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-radius: 16px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        border-left: 5px solid #3b82f6;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1);
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.25rem;
    }

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
        animation: heartBeat 0.6s ease-in-out;
        box-shadow: 0 6px 20px rgba(220, 38, 38, 0.3);
    }

    @keyframes heartBeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.3); }
        28% { transform: scale(1); }
        42% { transform: scale(1.3); }
        70% { transform: scale(1); }
    }

    .product-content {
        padding: 1rem;
        background: white;
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
        letter-spacing: 0.5px;
    }

    .product-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.4rem;
    }

    .product-description {
        color: #64748b;
        font-size: 0.8rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }

    .product-price-container {
        margin-top: auto;
    }

    .product-price {
        font-size: 1.1rem;
        font-weight: 800;
        color: #1e40af;
        margin-bottom: 0.25rem;
    }

    .product-old-price {
        font-size: 0.8rem;
        color: #94a3b8;
        text-decoration: line-through;
        font-weight: 500;
        margin-right: 0.5rem;
    }

    .product-discount {
        font-size: 0.7rem;
        color: #dc2626;
        font-weight: 700;
        background: #fef2f2;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .add-to-cart-btn {
        width: 100%;
        background: linear-gradient(135deg, #1e40af 0%, #1d4ed8 100%);
        color: white;
        border: none;
        padding: 10px 14px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 0.75rem;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
    }

    .add-to-cart-btn:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 64, 175, 0.4);
    }

    .add-to-cart-btn:active {
        transform: translateY(0);
    }

    /* Empty State */
    .empty-state {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .empty-state-icon {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        font-size: 3rem;
        color: white;
        box-shadow: 0 15px 35px rgba(59, 130, 246, 0.3);
    }

    /* Pagination */
    .pagination-container {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-top: 3rem;
    }

    .pagination-container .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .pagination-container .page-link {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        color: #6b7280;
        padding: 12px 18px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .pagination-container .page-link:hover {
        background: #3b82f6;
        border-color: #3b82f6;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .pagination-container .page-item.active .page-link {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border-color: #3b82f6;
        color: white;
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    /* Loading indicator */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .loading-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #f3f4f6;
        border-top: 4px solid #3b82f6;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .sidebar-filters {
            position: static;
            margin-bottom: 2rem;
        }
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .sidebar-filters {
            padding: 1.5rem;
        }

        .product-image-container {
            height: 200px;
        }

        .product-content {
            padding: 1rem;
        }
    }

    @media (max-width: 480px) {
        .product-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section text-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="hero-content text-center">
            <div class="bg-black bg-opacity-30 backdrop-blur-sm rounded-xl p-4 md:p-6 inline-block">
                <h1 class="text-2xl md:text-3xl font-bold mb-2 leading-tight">
                    Nos <span class="text-blue-300">Produits</span>
            </h1>
                <p class="text-sm md:text-base text-gray-100 max-w-2xl mx-auto leading-relaxed">
                Découvrez notre sélection complète de produits informatiques de qualité.
            </p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:col-span-1">
                <div class="sidebar-filters">
                    <form method="GET" action="{{ route('products.index') }}" id="filterForm">
                    <!-- Search -->
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <i class="fas fa-search text-blue-600"></i>
                                Recherche
                            </h3>
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher un produit..."
                                    class="search-input"
                                    id="searchInput"
                        >
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                            </div>
                    </div>

                        <!-- Price Range -->
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <i class="fas fa-tags text-blue-600"></i>
                                Fourchette de prix
                            </h3>
                            <div class="price-range">
                                <input
                                    type="range"
                                    name="max_price"
                                    min="0"
                                    max="1000000"
                                    value="{{ request('max_price', 1000000) }}"
                                    class="price-slider"
                                    id="priceSlider"
                                >
                                <div class="price-values">
                                    <span>0 FCFA</span>
                                    <span id="priceValue">{{ number_format(request('max_price', 1000000), 0, ',', ' ') }} FCFA</span>
                                </div>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <i class="fas fa-th-large text-blue-600"></i>
                                Catégories
                            </h3>
                            <div class="category-filter">
                                @if($categories->count() > 0)
                        @foreach($categories as $category)
                                        <div class="category-item {{ in_array($category->id, request('categories', [])) ? 'selected' : '' }}"
                                             onclick="toggleCategory({{ $category->id }})">
                                            <div class="category-checkbox">
                                                @if(in_array($category->id, request('categories', [])))
                                                    <i class="fas fa-check text-blue-600 text-xs"></i>
                                                @endif
                                            </div>
                                            <span>{{ $category->name }}</span>
                                            <span class="category-count">({{ $category->products_count }})</span>
                                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                                   {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                                   style="display: none;">
                                        </div>
                        @endforeach
                                @else
                                    <p class="text-gray-500 text-sm">Aucune catégorie disponible</p>
                                @endif
                            </div>
                        </div>

                        <!-- Sort Options -->
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <i class="fas fa-sort text-blue-600"></i>
                                Trier par
                            </h3>
                            <div>
                                @php
                                    $sortOptions = [
                                        'newest' => 'Plus récents',
                                        'price_asc' => 'Prix croissant',
                                        'price_desc' => 'Prix décroissant',
                                        'name_asc' => 'Nom A-Z',
                                        'name_desc' => 'Nom Z-A',
                                        'popular' => 'Plus populaires'
                                    ];
                                @endphp
                                @foreach($sortOptions as $value => $label)
                                    <div class="sort-option {{ request('sort') == $value ? 'selected' : '' }}"
                                         onclick="selectSort('{{ $value }}')">
                                        <span>{{ $label }}</span>
                                        <input type="radio" name="sort" value="{{ $value }}"
                                               {{ request('sort') == $value ? 'checked' : '' }}
                                               style="display: none;">
                </div>
                                @endforeach
                            </div>
                        </div>


            </form>
                </div>
        </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
        <!-- Results Info -->
        @if($products->count() > 0)
            <div class="results-info">
                <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-100 rounded-full p-3">
                                    <i class="fas fa-boxes text-blue-600 text-xl"></i>
                                </div>
                    <div>
                                    <h3 class="text-2xl font-bold text-gray-900">
                                        {{ $products->total() }} produit{{ $products->total() > 1 ? 's' : '' }}
                        </h3>
                                    <p class="text-sm text-gray-600">
                                        @if(request('search') || request('categories') || request('sort') || request('max_price'))
                                Filtres appliqués
                                @if(request('search'))
                                    • Recherche: "{{ request('search') }}"
                                @endif
                                            @if(request('categories'))
                                                • {{ count(request('categories', [])) }} catégorie{{ count(request('categories', [])) > 1 ? 's' : '' }}
                                @endif
                                @if(request('sort'))
                                                • Tri: {{ $sortOptions[request('sort')] ?? request('sort') }}
                                @endif
                                            @if(request('max_price') && request('max_price') != 1000000)
                                                • Prix max: {{ number_format(request('max_price'), 0, ',', ' ') }} FCFA
                        @endif
                                        @else
                                            Tous nos produits
                                        @endif
                                    </p>
                    </div>
                            </div>
                            <div>
                                <button onclick="clearFilters()" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-semibold text-sm flex items-center px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Effacer les filtres
                                </button>
                </div>
            </div>
    </div>
                @endif

                <!-- Products -->
        @if($products->count() > 0)
            <div class="product-grid">
                @foreach($products as $product)
                    <div class="product-card" onclick="window.location.href='{{ route('products.show', $product) }}'">
                        <div class="product-image-container">
                            @if($product->getFirstMediaUrl('images') && $product->getFirstMediaUrl('images') !== '')
                                <img src="{{ $product->getFirstMediaUrl('images') }}"
                                     alt="{{ $product->name }}"
                                     class="product-image">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-8xl text-gray-300"></i>
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
                                        <p class="product-description">{{ Str::limit($product->short_description, 100) }}</p>
                            @elseif($product->description)
                                        <p class="product-description">{{ Str::limit(strip_tags($product->description), 100) }}</p>
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

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Aucun produit trouvé</h3>
                <p class="text-gray-600 max-w-md mx-auto mb-8 text-lg">
                    Essayez de modifier vos critères de recherche ou parcourez toutes nos catégories.
                </p>
                <div class="space-x-4">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-home mr-2"></i>
                        Voir tous les produits
                    </a>
                            <a href="{{ route('categories.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-lg hover:from-gray-700 hover:to-gray-800 transition duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-th-large mr-2"></i>
                        Parcourir les catégories
                    </a>
                </div>
            </div>
        @endif
            </div>
        </div>
    </div>
</section>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>

<!-- Scripts -->
<script>
    // Price slider functionality
    const priceSlider = document.getElementById('priceSlider');
    const priceValue = document.getElementById('priceValue');

    priceSlider.addEventListener('input', function() {
        const value = this.value;
        priceValue.textContent = new Intl.NumberFormat('fr-FR').format(value) + ' FCFA';
    });

    // Auto-submit form when price slider changes with debounce
    let priceTimeout;
    priceSlider.addEventListener('change', function() {
        clearTimeout(priceTimeout);
        priceTimeout = setTimeout(() => {
            showLoading();
            document.getElementById('filterForm').submit();
        }, 500); // 500ms delay
    });

    // Search input with debounce
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            showLoading();
            document.getElementById('filterForm').submit();
        }, 1000); // 1 second delay for search
    });

    // Category filter functionality
    function toggleCategory(categoryId) {
        const categoryItem = event.currentTarget;
        const checkbox = categoryItem.querySelector('input[type="checkbox"]');
        const checkIcon = categoryItem.querySelector('.category-checkbox i');

        if (!checkbox) {
            console.error('Checkbox not found for category:', categoryId);
            return;
        }

        // Toggle checkbox state
        checkbox.checked = !checkbox.checked;

        // Update visual state
        if (checkbox.checked) {
            categoryItem.classList.add('selected');
            if (checkIcon) checkIcon.style.display = 'block';
            } else {
            categoryItem.classList.remove('selected');
            if (checkIcon) checkIcon.style.display = 'none';
        }

        // Add a small delay to ensure the checkbox state is updated
        setTimeout(() => {
            // Show loading and auto-submit form
            showLoading();
            document.getElementById('filterForm').submit();
        }, 100);
    }

    // Sort option functionality
    function selectSort(sortValue) {
        const sortOptions = document.querySelectorAll('.sort-option');
        const radioInputs = document.querySelectorAll('input[name="sort"]');

        sortOptions.forEach(option => option.classList.remove('selected'));
        radioInputs.forEach(input => input.checked = false);

        event.currentTarget.classList.add('selected');
        event.currentTarget.querySelector('input[type="radio"]').checked = true;

        // Show loading and auto-submit form
        showLoading();
        document.getElementById('filterForm').submit();
    }

    // Clear filters functionality
    function clearFilters() {
        // Reset all form inputs
        const form = document.getElementById('filterForm');
        const inputs = form.querySelectorAll('input, select');

        inputs.forEach(input => {
            if (input.type === 'checkbox' || input.type === 'radio') {
                input.checked = false;
            } else if (input.type === 'range') {
                input.value = input.max;
            } else {
                input.value = '';
            }
        });

        // Reset category selections
        const categoryItems = document.querySelectorAll('.category-item');
        categoryItems.forEach(item => {
            item.classList.remove('selected');
            const checkIcon = item.querySelector('.category-checkbox i');
            if (checkIcon) checkIcon.style.display = 'none';
        });

        // Reset sort selections
        const sortOptions = document.querySelectorAll('.sort-option');
        sortOptions.forEach(option => option.classList.remove('selected'));

        // Show loading and submit form
        showLoading();
        form.submit();
    }

    // Loading functions
    function showLoading() {
        document.getElementById('loadingOverlay').classList.add('show');
    }

    function hideLoading() {
        document.getElementById('loadingOverlay').classList.remove('show');
    }

    // Fonction pour ajouter au panier
    function addToCart(productId) {
        // Vérifier si l'utilisateur est connecté
        @guest
            window.location.href = '{{ route("login") }}';
            return;
        @endguest

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Créer un formulaire pour l'envoi
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("cart.add") }}';
        form.style.display = 'none';

        // Ajouter le token CSRF
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = token;
        form.appendChild(csrfInput);

        // Ajouter les données du produit
        const productInput = document.createElement('input');
        productInput.type = 'hidden';
        productInput.name = 'product_id';
        productInput.value = productId;
        form.appendChild(productInput);

        const quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = 'quantity';
        quantityInput.value = 1;
        form.appendChild(quantityInput);

        // Ajouter le formulaire au DOM et le soumettre
        document.body.appendChild(form);
        form.submit();
    }

    // Fonction pour gérer les favoris
    function toggleFavorite(productId, button) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const icon = button.querySelector('i');
        const isFavorited = button.classList.contains('favorited');

        fetch('/favorites/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.favorited) {
                    button.classList.add('favorited');
                    icon.style.color = 'white';
                    showNotification('Produit ajouté aux favoris !', 'success');
                } else {
                    button.classList.remove('favorited');
                    icon.style.color = '';
                    showNotification('Produit retiré des favoris', 'info');
                }
            } else {
                showNotification('Erreur lors de la gestion des favoris', 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Erreur lors de la gestion des favoris', 'error');
        });
    }

    // Fonction pour vérifier l'état des favoris au chargement
    function checkFavoritesOnLoad() {
        const favoriteButtons = document.querySelectorAll('.favorite-btn');
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        favoriteButtons.forEach(button => {
            const productId = button.getAttribute('data-product-id');

            fetch(`/favorites/check?product_id=${productId}`, {
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.favorited) {
                    button.classList.add('favorited');
                    const icon = button.querySelector('i');
                    icon.style.color = 'white';
                }
            })
            .catch(error => {
                console.error('Erreur lors de la vérification des favoris:', error);
            });
        });
    }

    // Vérifier les favoris au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        checkFavoritesOnLoad();
        hideLoading();
    });

    // Fonction pour afficher les notifications
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-blue-500 text-white'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-2"></i>
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);

        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 300);
        }, 3000);
    }
</script>
@endsection
