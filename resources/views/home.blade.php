@extends("layouts.app")
@section('content')
@php
    $categories = \App\Models\Category::where('is_active', true)->take(5)->get();
@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADI Informatique - Matériel & Accessoires</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <style>
        .hero-section {
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .product-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .category-tab.active {
            border-bottom: 3px solid #3b82f6;
            color: #3b82f6;
            font-weight: 600;
        }
        
        .favorite-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
            color: #9ca3af;
        }
        
        .favorite-btn:hover {
            background: #ef4444;
            color: white;
            transform: scale(1.1);
        }
        
        .favorite-btn.favorited {
            background: #ef4444;
            color: white;
        }
        
        .discount-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ef4444;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            z-index: 10;
        }
        
        .product-image-container {
            position: relative;
            overflow: hidden;
        }
        
        .product-image-container img {
            transition: transform 0.3s ease;
        }
        
        .product-card:hover .product-image-container img {
            transform: scale(1.05);
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }
        
        .btn-whatsapp {
            background: #25D366;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            transition: all 0.3s ease;
        }
        
        .btn-whatsapp:hover {
            background: #128C7E;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-view {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            transition: all 0.3s ease;
        }
        
        .btn-view:hover {
            background: #2563eb;
            color: white;
            transform: translateY(-2px);
        }
        
        .swiper-slide {
            height: auto;
        }
        
        .product-card {
            height: 100%;
            min-height: 400px;
        }
        
        .btn-whatsapp, .btn-view {
            min-height: 36px;
            font-size: 11px;
        }
        
        .swiper-button-next, .swiper-button-prev {
            color: #3b82f6;
            background: rgba(255, 255, 255, 0.9);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 16px;
        }
        
        .contact-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .contact-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-whatsapp {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .floating-whatsapp:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
        }
        
        .price-original {
            text-decoration: line-through;
            color: #9ca3af;
            font-size: 14px;
        }
        
        .price-discount {
            color: #ef4444;
            font-weight: bold;
            font-size: 18px;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <!-- Hero Section - Plein écran -->
    <section class="hero-section flex items-center justify-center relative">
        <div class="container mx-auto px-4 text-center text-white relative z-10">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                Votre boutique informatique<br>
                <span class="text-blue-400">de confiance</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed">
                Tout ce dont vous avez besoin pour équiper votre bureau ou votre maison au meilleur prix
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#products" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-full transition duration-300 inline-block text-lg">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Découvrir nos produits
                </a>
                <a href="#contact" class="bg-transparent border-2 border-white hover:bg-white hover:text-gray-900 text-white font-bold py-4 px-8 rounded-full transition duration-300 inline-block text-lg">
                    <i class="fas fa-phone mr-2"></i>
                    Nous contacter
                </a>
            </div>
        </div>
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <a href="#features" class="text-white animate-bounce">
                <i class="fas fa-chevron-down text-2xl"></i>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center p-6 rounded-lg hover:bg-gray-50 transition duration-300">
                    <div class="bg-blue-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-truck text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Livraison Rapide</h3>
                    <p class="text-gray-600">Expédition sous 24h</p>
                </div>
                <div class="text-center p-6 rounded-lg hover:bg-gray-50 transition duration-300">
                    <div class="bg-blue-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Garantie</h3>
                    <p class="text-gray-600">2 ans sur tous nos produits</p>
                </div>
                <div class="text-center p-6 rounded-lg hover:bg-gray-50 transition duration-300">
                    <div class="bg-blue-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Support 24/7</h3>
                    <p class="text-gray-600">Assistance technique</p>
                </div>
                <div class="text-center p-6 rounded-lg hover:bg-gray-50 transition duration-300">
                    <div class="bg-blue-100 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-undo text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Retour Facile</h3>
                    <p class="text-gray-600">30 jours pour changer d'avis</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Carousel Publicité Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Nos Promotions</h2>
            <div class="swiper promo-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Promotion 1">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Promotion 2">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Promotion 3">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Promotion 4">
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <!-- Section Catégories en tuiles -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Catégories populaires</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mb-2">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="block bg-gray-50 hover:bg-blue-50 rounded-lg shadow-sm p-4 text-center transition">
                        <div class="flex justify-center mb-2">
                            <i class="fas fa-box-open text-2xl text-blue-500"></i>
                        </div>
                        <span class="font-semibold text-gray-700">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10">Nos Sélections</h2>
            @foreach($categories as $category)
                @php
                    $products = $category->products()->where('is_active', true)->take(10)->get();
                @endphp
                @if($products->count() > 0)
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-blue-700">{{ $category->name }}</h3>
                        <a href="{{ route('categories.show', $category) }}" class="text-blue-600 hover:underline font-medium">Voir tout <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                    <div class="swiper product-swiper-{{ $category->id }}">
                        <div class="swiper-wrapper">
                            @foreach($products as $product)
                                <div class="swiper-slide">
                                    <div class="bg-white rounded-lg shadow-md border hover:shadow-lg transition flex flex-col relative group h-full cursor-pointer" onclick="window.location.href='{{ route('products.show', $product) }}'">
                                        <div class="relative">
                                            @if($product->getFirstMediaUrl('images'))
                                                <img src="{{ $product->getFirstMediaUrl('images') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-lg">
                                            @elseif($product->default_image_url)
                                                <img src="{{ $product->default_image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-lg">
                                            @else
                                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-t-lg">
                                                    <i class="fas fa-image text-3xl text-gray-400"></i>
                                                </div>
                                            @endif
                                            <!-- Badge réduction -->
                                            @if($product->discount_percentage > 0)
                                                <span class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">-{{ $product->discount_percentage }}%</span>
                                            @endif
                                            <!-- Favori -->
                                            <button class="absolute top-2 right-2 favorite-btn bg-white/90 hover:bg-red-500 text-gray-400 hover:text-white border-none shadow p-2 rounded-full transition z-10" data-product-id="{{ $product->id }}" onclick="event.stopPropagation()">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                        <div class="p-4 flex-1 flex flex-col">
                                            <h4 class="font-semibold text-sm mb-2 line-clamp-2 text-gray-800">{{ $product->name }}</h4>
                                            <div class="mb-3">
                                                @if($product->discount_percentage > 0)
                                                    <div class="flex flex-col">
                                                        <span class="text-gray-400 text-sm line-through">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                                        <span class="text-orange-500 font-bold text-lg">{{ number_format($product->price * (1 - $product->discount_percentage / 100), 0, ',', ' ') }} FCFA</span>
                                                    </div>
                                                @else
                                                    <span class="text-blue-700 font-bold text-lg">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                                @endif
                                            </div>
                                            <div class="flex-1 mb-4">
                                                <p class="text-xs text-gray-600 line-clamp-3 leading-relaxed">{{ Str::limit($product->short_description, 80) }}</p>
                                            </div>
                                            <div class="flex items-center justify-between gap-2">
                                                <a href="https://wa.me/221771234567?text={{ urlencode('Bonjour, je souhaite avoir des informations sur le produit '. $product->name .' (SKU : '. $product->sku .') sur ADI Informatique.') }}" target="_blank" class="btn-whatsapp flex-1 flex items-center justify-center text-xs py-2 px-3" onclick="event.stopPropagation()">
                                                    <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                                                </a>
                                                <a href="{{ route('products.show', $product) }}" class="btn-view flex-1 flex items-center justify-center text-xs py-2 px-3" onclick="event.stopPropagation()">
                                                    <i class="fas fa-eye mr-1"></i> Voir détails
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next swiper-button-next-{{ $category->id }}"></div>
                        <div class="swiper-button-prev swiper-button-prev-{{ $category->id }}"></div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section py-16 text-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Contactez-nous</h2>
            <p class="text-center mb-12 max-w-2xl mx-auto">Notre équipe est là pour vous accompagner dans tous vos projets informatiques</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="contact-card rounded-xl p-8 text-center">
                    <div class="bg-white bg-opacity-20 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-2">Téléphone</h3>
                    <p class="mb-2">+221 77 123 45 67</p>
                    <p class="text-sm opacity-80">Lun-Ven: 8h-18h</p>
                </div>
                
                <div class="contact-card rounded-xl p-8 text-center">
                    <div class="bg-white bg-opacity-20 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-2">Email</h3>
                    <p class="mb-2">contact@adi-informatique.com</p>
                    <p class="text-sm opacity-80">Réponse sous 24h</p>
                </div>
                
                <div class="contact-card rounded-xl p-8 text-center">
                    <div class="bg-white bg-opacity-20 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-2">Adresse</h3>
                    <p class="mb-2">123 Avenue de la République</p>
                    <p class="text-sm opacity-80">Dakar, Sénégal</p>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <a href="https://wa.me/221771234567" target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-8 rounded-full transition duration-300 inline-block text-lg">
                    <i class="fab fa-whatsapp mr-2"></i>
                    Discuter sur WhatsApp
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Restez informé</h2>
            <p class="mb-8 max-w-2xl mx-auto">Recevez nos offres spéciales et promotions directement dans votre boîte mail</p>
            <div class="max-w-md mx-auto flex">
                <input type="email" placeholder="Votre adresse email" class="flex-grow px-4 py-3 rounded-l-lg focus:outline-none text-gray-800">
                <button class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-r-lg font-medium transition duration-300">
                    S'abonner
                </button>
            </div>
        </div>
    </section>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/221771234567" class="floating-whatsapp" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <script>
        // Initialisation du carousel Swiper
        const swiper = new Swiper('.promo-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
        });

        // Gestion des favoris
        const favoriteButtons = document.querySelectorAll('.favorite-btn');
        favoriteButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                const icon = this.querySelector('i');
                
                // Toggle de l'état favori
                this.classList.toggle('favorited');
                
                // Animation du cœur
                if (this.classList.contains('favorited')) {
                    icon.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        icon.style.transform = 'scale(1)';
                    }, 200);
                }
                
                // Ici vous pouvez ajouter la logique pour sauvegarder en base de données
                console.log('Produit favori:', productId);
            });
        });

        // Smooth scroll pour les ancres
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

        document.addEventListener('DOMContentLoaded', function() {
            @foreach($categories as $category)
            new Swiper('.product-swiper-{{ $category->id }}', {
                slidesPerView: 2,
                spaceBetween: 16,
                navigation: {
                    nextEl: '.swiper-button-next-{{ $category->id }}',
                    prevEl: '.swiper-button-prev-{{ $category->id }}',
                },
                breakpoints: {
                    640: { slidesPerView: 3 },
                    1024: { slidesPerView: 5 },
                },
            });
            @endforeach
        });
    </script>
</body>
</html>
@endsection
