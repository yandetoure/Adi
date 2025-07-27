@extends("layouts.app")

@section('title', 'ADI Informatique - Votre boutique informatique au Sénégal')
@section('meta_description', 'ADI Informatique, votre boutique en ligne de confiance pour tous vos besoins informatiques. Ordinateurs, accessoires et matériel informatique au meilleur prix au Sénégal.')
@section('meta_keywords', 'ADI, informatique, ordinateurs, accessoires, matériel informatique, Sénégal, boutique en ligne')

@section('content')
@php
    $categories = \App\Models\Category::where('is_active', true)->take(8)->get();
    $featuredProducts = \App\Models\Product::where('is_active', true)->inRandomOrder()->take(12)->get();
@endphp

<!-- Styles spécifiques à la page d'accueil -->
<style>
    /* Carousel Styles */
    .carousel-container {
        position: relative;
        overflow: hidden;
        height: 600px;
    }

    .carousel-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .carousel-slide.active {
        opacity: 1;
    }

    .carousel-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 10;
        max-width: 800px;
        width: 90%;
    }

    .carousel-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.3) 100%);
    }

    .carousel-nav {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 20;
    }

    .carousel-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-dot.active {
        background: white;
        transform: scale(1.2);
    }

    .carousel-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.9);
        color: #333;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 20;
        font-size: 20px;
    }

    .carousel-arrow:hover {
        background: white;
        transform: translateY(-50%) scale(1.1);
    }

    .carousel-arrow.prev {
        left: 30px;
    }

    .carousel-arrow.next {
        right: 30px;
    }

    /* Category Carousel */
    .categories-carousel-container {
        position: relative;
        overflow: hidden;
        padding: 0 60px;
    }

    .categories-carousel {
        display: flex;
        gap: 24px;
        transition: transform 0.5s ease-in-out;
    }

    .category-card {
        flex-shrink: 0;
        width: 256px;
        min-width: 256px;
    }

    .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        z-index: 10;
        cursor: pointer;
    }

    .carousel-nav:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-50%) scale(1.1);
    }

    .carousel-nav.prev {
        left: 16px;
    }

    .carousel-nav.next {
        right: 16px;
    }

    /* Product Cards - Jumia Style */
    .product-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        border: 1px solid #f0f0f0;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border-color: #f39c12;
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
        object-fit: contain;
        transition: transform 0.3s ease;
        padding: 10px;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-badge {
        position: absolute;
        top: 8px;
        left: 8px;
        background: #e74c3c;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 10;
    }

    .favorite-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255,255,255,0.9);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        z-index: 10;
        font-size: 0.9rem;
    }

    .favorite-btn:hover {
        background: #e74c3c;
        color: white;
        transform: scale(1.1);
    }

    .favorite-btn.favorited {
        background: #e74c3c;
        color: white;
        animation: heartBeat 0.6s ease-in-out;
    }

    @keyframes heartBeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.3); }
        28% { transform: scale(1); }
        42% { transform: scale(1.3); }
        70% { transform: scale(1); }
    }

    .product-content {
        padding: 12px;
        background: white;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-category {
        font-size: 0.7rem;
        color: #666;
        text-transform: uppercase;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .product-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.4rem;
    }

    .product-description {
        color: #666;
        font-size: 0.8rem;
        margin-bottom: 12px;
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
        font-weight: 700;
        color: #f39c12;
        margin-bottom: 4px;
    }

    .product-old-price {
        font-size: 0.8rem;
        color: #999;
        text-decoration: line-through;
        font-weight: 400;
        margin-right: 8px;
    }

    .product-discount {
        font-size: 0.75rem;
        color: #e74c3c;
        font-weight: 600;
        background: #fdf2f2;
        padding: 2px 6px;
        border-radius: 3px;
    }

    .add-to-cart-btn {
        width: 100%;
        background: #f39c12;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 8px;
    }

    .add-to-cart-btn:hover {
        background: #e67e22;
        transform: translateY(-1px);
    }

    /* Section Headers */
    .section-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-title {
        font-size: 3rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #1f2937 0%, #3b82f6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .section-subtitle {
        font-size: 1.25rem;
        color: #6b7280;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Features Section */
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        border-color: #3b82f6;
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        font-size: 2rem;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }

    /* Newsletter Section */
    .newsletter-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
    }

    .newsletter-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .newsletter-content {
        position: relative;
        z-index: 10;
    }

    .newsletter-input {
        background: rgba(255,255,255,0.95);
        border: none;
        padding: 18px 25px;
        border-radius: 15px 0 0 15px;
        font-size: 1rem;
        width: 100%;
        backdrop-filter: blur(10px);
    }

    .newsletter-btn {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: #1f2937;
        border: none;
        padding: 18px 30px;
        border-radius: 0 15px 15px 0;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .newsletter-btn:hover {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        transform: translateY(-2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .carousel-container {
            height: 400px;
        }

        .carousel-content h1 {
            font-size: 2rem;
        }

        .carousel-content p {
            font-size: 1rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .category-card {
            height: 150px;
        }

        .category-name {
            font-size: 1.2rem;
        }

        .carousel-arrow {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .carousel-arrow.prev {
            left: 15px;
        }

        .carousel-arrow.next {
            right: 15px;
        }
    }
</style>

<!-- Hero Carousel Section -->
<section class="carousel-container">
    <div class="carousel-slide active" style="background-image: url('https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                Votre boutique informatique<br>
                <span class="text-yellow-300">de confiance</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-100">
                Ordinateurs, accessoires et matériel informatique au meilleur prix.
                Livraison rapide dans tout le Sénégal.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#products" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-4 px-8 rounded-lg transition duration-300 inline-block text-center transform hover:scale-105">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Acheter maintenant
                </a>
                <a href="#categories" class="bg-transparent border-2 border-white hover:bg-white hover:text-gray-900 text-white font-bold py-4 px-8 rounded-lg transition duration-300 inline-block text-center transform hover:scale-105">
                    <i class="fas fa-th-large mr-2"></i>
                    Voir les catégories
                </a>
            </div>
        </div>
    </div>

    <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                Technologies de<br>
                <span class="text-blue-300">pointe</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-100">
                Découvrez les dernières innovations en matière d'informatique.
                Performance et qualité garanties.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#products" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-8 rounded-lg transition duration-300 inline-block text-center transform hover:scale-105">
                    <i class="fas fa-rocket mr-2"></i>
                    Découvrir
                </a>
            </div>
        </div>
    </div>

    <div class="carousel-slide" style="background-image: url('https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
        <div class="carousel-overlay"></div>
        <div class="carousel-content">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                Service client<br>
                <span class="text-green-300">excellence</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-100">
                Support technique 24/7, garantie 2 ans et retour facile.
                Votre satisfaction est notre priorité.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#features" class="bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded-lg transition duration-300 inline-block text-center transform hover:scale-105">
                    <i class="fas fa-headset mr-2"></i>
                    En savoir plus
                </a>
            </div>
        </div>
    </div>

    <!-- Carousel Navigation -->
    <div class="carousel-arrow prev">
        <i class="fas fa-chevron-left"></i>
    </div>
    <div class="carousel-arrow next">
        <i class="fas fa-chevron-right"></i>
    </div>

    <div class="carousel-nav">
        <div class="carousel-dot active"></div>
        <div class="carousel-dot"></div>
        <div class="carousel-dot"></div>
    </div>
</section>

<!-- Flash Sales Banner -->
<section class="bg-gradient-to-r from-red-600 via-red-500 to-red-600 text-white py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-center space-x-4">
            <i class="fas fa-bolt text-2xl animate-pulse"></i>
            <span class="text-lg font-bold">FLASH SALES - Jusqu'à 70% de réduction</span>
            <span class="bg-white text-red-600 px-4 py-2 rounded-full text-sm font-bold animate-pulse">24:00:00</span>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nos Catégories</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Découvrez notre gamme complète de produits informatiques organisés par catégories</p>
        </div>

                <div class="categories-carousel-container relative">
                    <div class="categories-carousel flex transition-transform duration-500 ease-in-out" id="categoriesCarousel">
                        @foreach($categories as $index => $category)
                            @php
                                $backgroundImages = [
                                    'https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1526738549149-8e07eca6c147?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                                ];

                                $icon = 'fas fa-laptop';
                                if (stripos($category->name, 'ordinateur') !== false || stripos($category->name, 'pc') !== false) {
                                    $icon = 'fas fa-laptop';
                                } elseif (stripos($category->name, 'téléphone') !== false || stripos($category->name, 'smartphone') !== false || stripos($category->name, 'mobile') !== false) {
                                    $icon = 'fas fa-mobile-alt';
                                } elseif (stripos($category->name, 'accessoire') !== false) {
                                    $icon = 'fas fa-headphones';
                                } elseif (stripos($category->name, 'écran') !== false || stripos($category->name, 'moniteur') !== false) {
                                    $icon = 'fas fa-desktop';
                                } elseif (stripos($category->name, 'stockage') !== false || stripos($category->name, 'disque') !== false) {
                                    $icon = 'fas fa-hdd';
                                } elseif (stripos($category->name, 'réseau') !== false || stripos($category->name, 'wifi') !== false) {
                                    $icon = 'fas fa-wifi';
                                } elseif (stripos($category->name, 'gaming') !== false || stripos($category->name, 'jeu') !== false) {
                                    $icon = 'fas fa-gamepad';
                                } elseif (stripos($category->name, 'imprimante') !== false) {
                                    $icon = 'fas fa-print';
                                }
                            @endphp

                            <div class="category-card">
                                <a href="{{ route('categories.show', $category) }}" class="block group">
                                    <div class="category-image-container"
                                         style="background-image: url('{{ $backgroundImages[$index % count($backgroundImages)] }}');">
                                        <div class="category-background"></div>
                                        <div class="category-content">
                                            <div class="category-icon">
                                                <i class="{{ $icon }}"></i>
                                            </div>
                                            <h3 class="category-title">{{ $category->name }}</h3>
                                            <p class="category-count">{{ $category->products_count }} produits</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Arrows -->
                    <button class="carousel-nav prev" onclick="moveCarousel(-1)">
                        <i class="fas fa-chevron-left text-gray-600"></i>
                    </button>
                    <button class="carousel-nav next" onclick="moveCarousel(1)">
                        <i class="fas fa-chevron-right text-gray-600"></i>
                    </button>
                </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section id="products" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="section-header">
            <h2 class="section-title">Produits vedettes</h2>
            <p class="section-subtitle">Découvrez notre sélection de produits les plus populaires et les mieux notés</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach($featuredProducts as $product)
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

        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-300 transform hover:scale-105">
                <i class="fas fa-th-large mr-2"></i>
                Voir tous les produits
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="section-header">
            <h2 class="section-title">Pourquoi choisir ADI Informatique ?</h2>
            <p class="section-subtitle">Nous nous engageons à vous offrir la meilleure expérience d'achat</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="font-bold text-xl mb-4">Livraison Rapide</h3>
                <p class="text-gray-600">Livraison gratuite à partir de 50,000 FCFA dans tout le Sénégal</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="font-bold text-xl mb-4">Garantie 2 Ans</h3>
                <p class="text-gray-600">Garantie complète sur tous nos produits avec support technique</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="font-bold text-xl mb-4">Support 24/7</h3>
                <p class="text-gray-600">Assistance technique disponible 24h/24 et 7j/7</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-undo"></i>
                </div>
                <h3 class="font-bold text-xl mb-4">Retour Facile</h3>
                <p class="text-gray-600">30 jours pour changer d'avis avec retour gratuit</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section py-20 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="newsletter-content text-center">
            <h2 class="text-4xl font-bold mb-4">Restez informé</h2>
            <p class="mb-8 text-xl opacity-90">Recevez nos offres spéciales et promotions directement dans votre boîte mail</p>
            <div class="max-w-md mx-auto flex">
                <input type="email" placeholder="Votre adresse email" class="newsletter-input focus:outline-none">
                <button class="newsletter-btn">
                    S'abonner
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/221771234567" class="fixed bottom-8 right-8 bg-green-500 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl shadow-lg hover:bg-green-600 transition duration-300 transform hover:scale-110 z-50" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Carousel Script -->
<script>
    // Carousel functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const totalSlides = slides.length;

    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        // Show current slide
        slides[index].classList.add('active');
        dots[index].classList.add('active');
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    // Event listeners
    document.querySelector('.carousel-arrow.next').addEventListener('click', nextSlide);
    document.querySelector('.carousel-arrow.prev').addEventListener('click', prevSlide);

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    // Auto-advance carousel
    setInterval(nextSlide, 5000);

    // Category Carousel functionality
    let categoryCarouselPosition = 0;
    const categoryCarousel = document.getElementById('categoryCarousel');
    const categoryCards = document.querySelectorAll('.category-card');
    const cardsPerView = window.innerWidth > 1024 ? 4 : window.innerWidth > 768 ? 3 : 2;

    function moveCategoryCarousel(direction) {
        const maxPosition = Math.max(0, categoryCards.length - cardsPerView);

        if (direction === 1) {
            categoryCarouselPosition = Math.min(categoryCarouselPosition + 1, maxPosition);
        } else {
            categoryCarouselPosition = Math.max(categoryCarouselPosition - 1, 0);
        }

        const translateX = -categoryCarouselPosition * (200 + 24); // card width + gap
        categoryCarousel.style.transform = `translateX(${translateX}px)`;

        // Update arrow visibility
        document.querySelector('.category-carousel-arrow.prev').style.opacity = categoryCarouselPosition === 0 ? '0.5' : '1';
        document.querySelector('.category-carousel-arrow.next').style.opacity = categoryCarouselPosition === maxPosition ? '0.5' : '1';
    }

    // Initialize category carousel arrows
    document.addEventListener('DOMContentLoaded', function() {
        if (categoryCards.length > cardsPerView) {
            document.querySelector('.category-carousel-arrow.prev').style.opacity = '0.5';
        }
    });

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Fonction pour ajouter au panier
    function addToCart(productId) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Produit ajouté au panier !', 'success');
                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    const currentCount = parseInt(cartCount.textContent) || 0;
                    cartCount.textContent = currentCount + 1;
                }
            } else {
                showNotification('Erreur lors de l\'ajout au panier', 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Erreur lors de l\'ajout au panier', 'error');
        });
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

        // Auto-scroll pour le carousel des catégories
        startCategoriesAutoScroll();
    });

    // Fonction pour le défilement automatique des catégories
    let categoriesAutoScrollInterval;
    let currentCategoryIndex = 0;
    const categoryCards = document.querySelectorAll('.category-card');
    const totalCategories = categoryCards.length;

    function startCategoriesAutoScroll() {
        if (totalCategories <= 4) return; // Pas besoin de défilement si moins de 4 catégories

        categoriesAutoScrollInterval = setInterval(() => {
            currentCategoryIndex = (currentCategoryIndex + 1) % totalCategories;
            updateCategoriesCarousel();
        }, 3000); // Défilement toutes les 3 secondes
    }

    function updateCategoriesCarousel() {
        const carousel = document.getElementById('categoriesCarousel');
        if (!carousel) return;

        const cardWidth = 280; // 256px (largeur) + 24px (gap)
        const translateX = -currentCategoryIndex * cardWidth;
        carousel.style.transform = `translateX(${translateX}px)`;
    }

    function moveCarousel(direction) {
        // Arrêter le défilement automatique temporairement
        clearInterval(categoriesAutoScrollInterval);

        currentCategoryIndex += direction;

        // Gestion des limites
        if (currentCategoryIndex < 0) {
            currentCategoryIndex = totalCategories - 1;
        } else if (currentCategoryIndex >= totalCategories) {
            currentCategoryIndex = 0;
        }

        updateCategoriesCarousel();

        // Redémarrer le défilement automatique après 5 secondes
        setTimeout(() => {
            startCategoriesAutoScroll();
        }, 5000);
    }

    // Initialiser le carousel au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        // Pause du défilement au survol
        const carouselContainer = document.querySelector('.categories-carousel-container');
        if (carouselContainer) {
            carouselContainer.addEventListener('mouseenter', () => {
                clearInterval(categoriesAutoScrollInterval);
            });

            carouselContainer.addEventListener('mouseleave', () => {
                startCategoriesAutoScroll();
            });
        }

        // Initialiser le carousel
        startCategoriesAutoScroll();
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
