@extends("layouts.app")

@section('title', 'ADI Informatique - Votre boutique informatique au Sénégal')
@section('meta_description', 'ADI Informatique, votre boutique en ligne de confiance pour tous vos besoins informatiques. Ordinateurs, accessoires et matériel informatique au meilleur prix au Sénégal.')
@section('meta_keywords', 'ADI, informatique, ordinateurs, accessoires, matériel informatique, Sénégal, boutique en ligne')

@section('content')
@php
    $categories = \App\Models\Category::where('is_active', true)->take(8)->get();
@endphp

<!-- Styles spécifiques à la page d'accueil -->
<style>
    .hero-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .category-card { transition: all 0.3s ease; }
    .category-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.15); }
    .product-card { transition: all 0.3s ease; border: 1px solid #e5e7eb; }
    .product-card:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
    .flash-sale-badge { background: linear-gradient(45deg, #ff6b6b, #ee5a24); animation: pulse 2s infinite; }
    @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.8; } }
    .swiper-button-next, .swiper-button-prev { color: #3b82f6; background: rgba(255, 255, 255, 0.9); width: 40px; height: 40px; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .swiper-button-next:after, .swiper-button-prev:after { font-size: 16px; }
    .floating-whatsapp { position: fixed; bottom: 30px; right: 30px; background: #25D366; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4); transition: all 0.3s ease; z-index: 1000; }
    .floating-whatsapp:hover { transform: scale(1.1); box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6); }
    .price-original { text-decoration: line-through; color: #9ca3af; font-size: 14px; }
    .price-discount { color: #ef4444; font-weight: bold; font-size: 18px; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .top-banner { background: linear-gradient(90deg, #ff6b6b, #ee5a24, #ff6b6b); background-size: 200% 100%; animation: gradient 3s ease infinite; }
    @keyframes gradient { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
</style>

<!-- Top Banner -->
<div class="top-banner text-white py-2 text-center text-sm font-medium">
    <span>🎉 Livraison gratuite à partir de 50,000 FCFA | Paiement en ligne sécurisé</span>
</div>

<!-- Hero Section -->
<section class="hero-gradient text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
                    Votre boutique informatique<br>
                    <span class="text-yellow-300">de confiance</span>
                </h1>
                <p class="text-xl mb-8 text-gray-100">
                    Ordinateurs, accessoires et matériel informatique au meilleur prix. 
                    Livraison rapide dans tout le Sénégal.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#products" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-4 px-8 rounded-lg transition duration-300 inline-block text-center">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Acheter maintenant
                    </a>
                    <a href="#categories" class="bg-transparent border-2 border-white hover:bg-white hover:text-gray-900 text-white font-bold py-4 px-8 rounded-lg transition duration-300 inline-block text-center">
                        <i class="fas fa-th-large mr-2"></i>
                        Voir les catégories
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Informatique" class="rounded-lg shadow-2xl">
            </div>
        </div>
    </div>
</section>

<!-- Flash Sales Banner -->
<section class="bg-red-600 text-white py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-center space-x-4">
            <i class="fas fa-bolt text-2xl"></i>
            <span class="text-lg font-bold">FLASH SALES - Jusqu'à 70% de réduction</span>
            <span class="bg-white text-red-600 px-3 py-1 rounded-full text-sm font-bold">24:00:00</span>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Catégories populaires</h2>
            <p class="text-gray-600">Découvrez nos produits par catégorie</p>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="category-card block bg-gray-50 hover:bg-blue-50 rounded-lg p-4 text-center group">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-200 transition">
                        <i class="fas fa-laptop text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Products by Category -->
<section id="products" class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach($categories->take(4) as $category)
            @php
                $products = $category->products()->where('is_active', true)->take(10)->get();
            @endphp
            @if($products->count() > 0)
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $category->name }}</h3>
                        <p class="text-gray-600">Les meilleurs produits de la catégorie</p>
                    </div>
                    <a href="{{ route('categories.show', $category) }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        Voir tout <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <div class="swiper category-swiper-{{ $category->id }}">
                    <div class="swiper-wrapper">
                        @foreach($products as $product)
                            <div class="swiper-slide">
                                <div class="product-card bg-white rounded-lg p-4 h-full">
                                    <div class="relative mb-4">
                                        @if($product->getFirstMediaUrl('images'))
                                            <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-image text-3xl text-gray-400"></i>
                                            </div>
                                        @endif
                                        @if($product->discount_percentage > 0)
                                            <div class="flash-sale-badge absolute top-2 left-2 text-white text-xs font-bold px-2 py-1 rounded">
                                                -{{ $product->discount_percentage }}%
                                            </div>
                                        @endif
                                        <button class="absolute top-2 right-2 bg-white/90 hover:bg-red-500 text-gray-400 hover:text-white border-none shadow p-2 rounded-full transition">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    
                                    <h3 class="font-semibold text-sm mb-2 line-clamp-2 text-gray-800">{{ $product->name }}</h3>
                                    
                                    <div class="mb-3">
                                        @if($product->discount_percentage > 0)
                                            <span class="price-original">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                            <div class="price-discount">{{ number_format($product->price * (1 - $product->discount_percentage / 100), 0, ',', ' ') }} FCFA</div>
                                        @else
                                            <div class="text-blue-700 font-bold text-lg">{{ number_format($product->price, 0, ',', ' ') }} FCFA</div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex space-x-2">
                                        <a href="https://wa.me/221771234567?text={{ urlencode('Bonjour, je souhaite acheter '. $product->name .' (SKU : '. $product->sku .') sur ADI Informatique.') }}" 
                                           target="_blank" 
                                           class="flex-1 bg-green-500 hover:bg-green-600 text-white text-center py-2 px-3 rounded text-sm transition">
                                            <i class="fab fa-whatsapp mr-1"></i> Acheter
                                        </a>
                                        <a href="{{ route('products.show', $product) }}" 
                                           class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-3 rounded text-sm transition">
                                            <i class="fas fa-eye mr-1"></i> Voir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-truck text-blue-600 text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Livraison Rapide</h3>
                <p class="text-gray-600">Livraison gratuite à partir de 50,000 FCFA</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Garantie</h3>
                <p class="text-gray-600">2 ans de garantie sur tous nos produits</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Support 24/7</h3>
                <p class="text-gray-600">Assistance technique disponible</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-undo text-purple-600 text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Retour Facile</h3>
                <p class="text-gray-600">30 jours pour changer d'avis</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-blue-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Restez informé</h2>
        <p class="mb-8 text-lg">Recevez nos offres spéciales et promotions directement dans votre boîte mail</p>
        <div class="max-w-md mx-auto flex">
            <input type="email" placeholder="Votre adresse email" class="flex-grow px-4 py-3 rounded-l-lg focus:outline-none text-gray-800">
            <button class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-6 py-3 rounded-r-lg font-medium transition duration-300">
                S'abonner
            </button>
        </div>
    </div>
</section>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/221771234567" class="floating-whatsapp" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Scripts spécifiques à la page d'accueil -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
    // Category Swipers
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($categories->take(4) as $category)
        new Swiper('.category-swiper-{{ $category->id }}', {
            slidesPerView: 2,
            spaceBetween: 16,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: { slidesPerView: 3 },
                768: { slidesPerView: 4 },
                1024: { slidesPerView: 5 },
                1280: { slidesPerView: 6 },
            },
        });
        @endforeach
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
</script>
@endsection
