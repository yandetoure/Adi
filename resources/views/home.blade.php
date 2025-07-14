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
    
    /* Nouveaux styles modernes */
    .category-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1rem; }
    .category-item { 
        background: white; 
        border-radius: 16px; 
        padding: 1.5rem 1rem; 
        text-align: center; 
        box-shadow: 0 2px 8px rgba(0,0,0,0.08); 
        transition: all 0.3s ease; 
        border: 2px solid transparent;
    }
    .category-item:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 20px 40px rgba(0,0,0,0.15); 
        border-color: #3b82f6;
    }
    .category-icon { 
        width: 60px; 
        height: 60px; 
        border-radius: 16px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        margin: 0 auto 1rem; 
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }
    .category-item:hover .category-icon { transform: scale(1.1); }
    
    .product-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); 
        gap: 1rem; 
    }
    .product-item { 
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px; 
        overflow: hidden; 
        box-shadow: 0 8px 25px rgba(0,0,0,0.1); 
        transition: all 0.3s ease;
        border: 2px solid transparent;
        cursor: pointer;
        position: relative;
    }
    .product-item:hover { 
        transform: translateY(-10px); 
        box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        border-color: #3b82f6;
    }
    .product-image-container { 
        position: relative; 
        height: 180px; 
        overflow: hidden; 
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    }
    .product-image { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
        transition: transform 0.3s ease;
    }
    .product-item:hover .product-image { transform: scale(1.1); }
    .product-badge { 
        position: absolute; 
        top: 15px; 
        left: 15px; 
        background: linear-gradient(45deg, #ef4444, #dc2626); 
        color: white; 
        padding: 0.5rem 1rem; 
        border-radius: 25px; 
        font-size: 0.875rem; 
        font-weight: 700;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }
    .favorite-btn { 
        position: absolute; 
        top: 10px; 
        right: 10px; 
        width: 35px; 
        height: 35px; 
        border-radius: 50%; 
        background: rgba(255,255,255,0.95); 
        border: none; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        cursor: pointer; 
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 10;
        font-size: 1rem;
    }
    .favorite-btn:hover { 
        background: #ef4444; 
        color: white; 
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }
    .favorite-btn.favorited { 
        background: #ef4444; 
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
        padding: 1rem; 
        background: white;
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
        min-height: 2.5rem;
    }
    .product-price { 
        font-size: 1.25rem; 
        font-weight: 800; 
        color: #3b82f6; 
        margin-bottom: 0.5rem;
    }
    .product-old-price { 
        font-size: 1rem; 
        color: #9ca3af; 
        text-decoration: line-through;
        margin-right: 1rem;
        font-weight: 500;
    }
    .product-discount { 
        font-size: 1rem; 
        color: #ef4444; 
        font-weight: 700;
        background: #fef2f2;
        padding: 0.375rem 0.75rem;
        border-radius: 12px;
    }

    .product-category { 
        font-size: 0.75rem; 
        color: #6b7280; 
        text-transform: uppercase; 
        font-weight: 600; 
        letter-spacing: 0.05em;
        margin-bottom: 0.75rem;
    }
    .section-header { 
        text-align: center; 
        margin-bottom: 3rem;
    }
    .section-title { 
        font-size: 2.5rem; 
        font-weight: 800; 
        color: #1f2937; 
        margin-bottom: 1rem;
    }
    .section-subtitle { 
        font-size: 1.125rem; 
        color: #6b7280; 
        max-width: 600px; 
        margin: 0 auto;
    }
    .category-count { 
        background: #f3f4f6; 
        color: #6b7280; 
        padding: 0.25rem 0.75rem; 
        border-radius: 20px; 
        font-size: 0.75rem; 
        font-weight: 500;
        margin-top: 0.5rem;
        display: inline-block;
    }
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
<section id="categories" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="section-header">
            <h2 class="section-title">Explorez nos catégories</h2>
            <p class="section-subtitle">Découvrez notre gamme complète de produits informatiques organisés par catégorie</p>
        </div>
        
        <div class="category-grid">
            @foreach($categories as $category)
                @php
                    $icon = 'fas fa-laptop';
                    $bgColor = 'bg-blue-100';
                    $textColor = 'text-blue-600';
                    
                    // Icônes et couleurs spécifiques selon le nom de la catégorie
                    if (stripos($category->name, 'ordinateur') !== false || stripos($category->name, 'pc') !== false) {
                        $icon = 'fas fa-laptop';
                        $bgColor = 'bg-blue-100';
                        $textColor = 'text-blue-600';
                    } elseif (stripos($category->name, 'téléphone') !== false || stripos($category->name, 'smartphone') !== false || stripos($category->name, 'mobile') !== false) {
                        $icon = 'fas fa-mobile-alt';
                        $bgColor = 'bg-green-100';
                        $textColor = 'text-green-600';
                    } elseif (stripos($category->name, 'accessoire') !== false) {
                        $icon = 'fas fa-headphones';
                        $bgColor = 'bg-purple-100';
                        $textColor = 'text-purple-600';
                    } elseif (stripos($category->name, 'écran') !== false || stripos($category->name, 'moniteur') !== false) {
                        $icon = 'fas fa-desktop';
                        $bgColor = 'bg-indigo-100';
                        $textColor = 'text-indigo-600';
                    } elseif (stripos($category->name, 'stockage') !== false || stripos($category->name, 'disque') !== false) {
                        $icon = 'fas fa-hdd';
                        $bgColor = 'bg-orange-100';
                        $textColor = 'text-orange-600';
                    } elseif (stripos($category->name, 'réseau') !== false || stripos($category->name, 'wifi') !== false) {
                        $icon = 'fas fa-wifi';
                        $bgColor = 'bg-cyan-100';
                        $textColor = 'text-cyan-600';
                    } elseif (stripos($category->name, 'gaming') !== false || stripos($category->name, 'jeu') !== false) {
                        $icon = 'fas fa-gamepad';
                        $bgColor = 'bg-red-100';
                        $textColor = 'text-red-600';
                    } elseif (stripos($category->name, 'imprimante') !== false) {
                        $icon = 'fas fa-print';
                        $bgColor = 'bg-gray-100';
                        $textColor = 'text-gray-600';
                    } else {
                        $icon = 'fas fa-box';
                        $bgColor = 'bg-blue-100';
                        $textColor = 'text-blue-600';
                    }
                @endphp
                
                <a href="{{ route('categories.show', $category) }}" class="category-item group">
                    <div class="category-icon {{ $bgColor }} {{ $textColor }}">
                        <i class="{{ $icon }}"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                        {{ $category->name }}
                    </h3>
                    <span class="category-count">
                        {{ $category->products()->where('is_active', true)->count() }} produits
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Products by Category -->
<section id="products" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach($categories->take(4) as $category)
            @php
                $products = $category->products()->where('is_active', true)->take(8)->get();
            @endphp
            @if($products->count() > 0)
            <div class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $category->name }}</h3>
                        <p class="text-gray-600">Découvrez nos meilleurs produits de cette catégorie</p>
                    </div>
                    <a href="{{ route('categories.show', $category) }}" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center group">
                        Voir tout 
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                
                <div class="product-grid">
                    @foreach($products as $product)
                        <div class="product-item" onclick="window.location.href='{{ route('products.show', $product) }}'">
                            <div class="product-image-container">
                                @if($product->getFirstMediaUrl('images') && $product->getFirstMediaUrl('images') !== '')
                                    <img src="{{ $product->getFirstMediaUrl('images') }}" 
                                         alt="{{ $product->name }}" 
                                         class="product-image">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-4xl text-gray-300"></i>
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
                                <div class="product-category">{{ $category->name }}</div>
                                <h4 class="product-title">{{ $product->name }}</h4>
                                
                                @if($product->short_description)
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->short_description, 100) }}</p>
                                @elseif($product->description)
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit(strip_tags($product->description), 100) }}</p>
                                @endif
                                

                                
                                <div class="product-price">
                                    @if($product->discount_percentage > 0)
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="product-price">
                                                {{ number_format($product->price * (1 - $product->discount_percentage / 100), 0, ',', ' ') }} FCFA
                                            </span>
                                            <span class="product-old-price">
                                                {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                            </span>
                                            <span class="product-discount">
                                                -{{ $product->discount_percentage }}%
                                            </span>
                                        </div>
                                    @else
                                        <span class="product-price">
                                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="mt-2 text-center">
                                    <span class="text-xs text-gray-500 font-medium">Cliquez pour voir les détails</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="section-header">
            <h2 class="section-title">Pourquoi choisir ADI Informatique ?</h2>
            <p class="section-subtitle">Nous nous engageons à vous offrir la meilleure expérience d'achat</p>
        </div>
        
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
<script>
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
        // Créer un token CSRF
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
                // Afficher une notification de succès
                showNotification('Produit ajouté au panier !', 'success');
                
                // Mettre à jour le compteur du panier si il existe
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
    });

    // Fonction pour afficher les notifications
    function showNotification(message, type = 'info') {
        // Créer l'élément de notification
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
        
        // Ajouter au DOM
        document.body.appendChild(notification);
        
        // Animer l'entrée
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Supprimer automatiquement après 3 secondes
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
