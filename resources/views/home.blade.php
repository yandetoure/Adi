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

    /* Category Cards */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-top: 2rem;
    }

    .category-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        height: 200px;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    }

    .category-image-container {
        position: relative;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .category-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.3) 100%);
    }

    .category-content {
        position: relative;
        z-index: 10;
        text-align: center;
        color: white;
        padding: 20px;
    }

    .category-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.5rem;
        backdrop-filter: blur(10px);
    }

    .category-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 8px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .category-count {
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 500;
    }

    /* Product Cards - ADI Style */
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

        .categories-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
        }

        .category-card {
            height: 180px;
        }

        .category-title {
            font-size: 1.1rem;
        }

        .category-icon {
            width: 50px;
            height: 50px;
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

    @media (max-width: 480px) {
        .categories-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .category-card {
            height: 160px;
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
                <a href="#products" class="bg-gradient-to-r from-blue-800 to-blue-900 hover:from-blue-900 hover:to-blue-950 text-white font-bold py-4 px-8 rounded-lg transition duration-300 inline-block text-center transform hover:scale-105 shadow-lg hover:shadow-xl">
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
                <a href="#products" class="bg-gradient-to-r from-blue-800 to-blue-900 hover:from-blue-900 hover:to-blue-950 text-white font-bold py-4 px-8 rounded-lg transition duration-300 inline-block text-center transform hover:scale-105 shadow-lg hover:shadow-xl">
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
                <a href="#features" class="bg-gradient-to-r from-blue-800 to-blue-900 hover:from-blue-900 hover:to-blue-950 text-white font-bold py-4 px-8 rounded-lg transition duration-300 inline-block text-center transform hover:scale-105 shadow-lg hover:shadow-xl">
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

        <div class="categories-grid">
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

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-items-center">
            @foreach($featuredProducts->take(15) as $product)
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
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-800 to-blue-900 text-white font-bold rounded-lg hover:from-blue-900 hover:to-blue-950 transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i class="fas fa-th-large mr-2"></i>
                Voir tous les produits
            </a>
        </div>
    </div>
</section>

<!-- Products by Category Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach($categories->take(3) as $category)
            @if($category->products()->where('is_active', true)->count() > 0)
                <div class="mb-16">
                    <div class="section-header mb-8">
                        <h2 class="section-title">{{ $category->name }}</h2>
                        <p class="section-subtitle">Découvrez notre sélection de {{ strtolower($category->name) }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-items-center">
                        @foreach($category->products()->where('is_active', true)->take(10)->get() as $product)
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

                    <div class="text-center mt-8">
                        <a href="{{ route('categories.show', $category) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-lg hover:from-gray-700 hover:to-gray-800 transition duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Voir tous les {{ strtolower($category->name) }}
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
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

{{-- <!-- Floating WhatsApp Button -->
<a href="https://wa.me/221771234567" class="fixed bottom-8 right-8 bg-green-500 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl shadow-lg hover:bg-green-600 transition duration-300 transform hover:scale-110 z-50" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a> --}}

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
