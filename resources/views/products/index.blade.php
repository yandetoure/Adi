@extends('layouts.app')

@section('title', 'Nos Produits - ADI Store')
@section('meta_description', 'Découvrez notre sélection de produits de qualité. Trouvez ce que vous cherchez parmi notre large gamme.')
@section('meta_keywords', 'produits, boutique, ADI Store, qualité, sélection')

@section('content')
<!-- Styles spécifiques à la page des produits -->
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: 25px;
        padding: 2.5rem;
        margin-bottom: 3rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
    }

    .search-input {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 20px;
        padding: 1.25rem 1.25rem 1.25rem 3.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .search-input:focus {
        border-color: #3b82f6;
        background: white;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        outline: none;
        transform: translateY(-2px);
    }

    .filter-select {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 20px;
        padding: 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        cursor: pointer;
    }

    .filter-select:focus {
        border-color: #3b82f6;
        background: white;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        outline: none;
        transform: translateY(-2px);
    }

    .filter-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        border: none;
        padding: 1.25rem 2rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }

    .filter-btn:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
    }

    /* Results Info */
    .results-info {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-radius: 20px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        border-left: 5px solid #3b82f6;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1);
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }

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
        height: 180px;
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

    /* Empty State */
    .empty-state {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 25px;
        padding: 5rem 2rem;
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
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        margin-top: 4rem;
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
        border-radius: 15px;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .filter-section {
            padding: 2rem;
        }

        .product-image-container {
            height: 220px;
        }

        .product-content {
            padding: 1.5rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="hero-content text-center">
            <h1 class="text-5xl md:text-7xl font-bold mb-8 leading-tight">
                Nos <span class="text-yellow-300">Produits</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-100 max-w-4xl mx-auto leading-relaxed">
                Découvrez notre sélection complète de produits informatiques de qualité.
                Trouvez exactement ce que vous cherchez parmi notre large gamme.
            </p>
        </div>
    </div>
</section>

<!-- Filters and Search -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="filter-section">
            <form method="GET" action="{{ route('products.index') }}" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Search -->
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher un produit..."
                            class="search-input w-full"
                        >
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                    </div>

                    <!-- Category Filter -->
                    <select name="category" class="filter-select w-full">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Sort -->
                    <select name="sort" class="filter-select w-full">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récents</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nom A-Z</option>
                    </select>

                    <!-- Submit Button -->
                    <button type="submit" class="filter-btn">
                        <i class="fas fa-search mr-2"></i>
                        Filtrer
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Info -->
        @if($products->count() > 0)
            <div class="results-info">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">
                            {{ $products->total() }} produit(s) trouvé(s)
                        </h3>
                        @if(request('search') || request('category') || request('sort'))
                            <p class="text-sm text-gray-600 mt-2">
                                Filtres appliqués
                                @if(request('search'))
                                    • Recherche: "{{ request('search') }}"
                                @endif
                                @if(request('category'))
                                    • Catégorie: {{ $categories->find(request('category'))->name ?? '' }}
                                @endif
                                @if(request('sort'))
                                    • Tri: {{ ucfirst(str_replace('_', ' ', request('sort'))) }}
                                @endif
                            </p>
                        @endif
                    </div>
                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center">
                        <i class="fas fa-times mr-2"></i>
                        Effacer les filtres
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Products Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-300 transform hover:scale-105">
                        <i class="fas fa-home mr-2"></i>
                        Voir tous les produits
                    </a>
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-lg hover:from-gray-700 hover:to-gray-800 transition duration-300 transform hover:scale-105">
                        <i class="fas fa-th-large mr-2"></i>
                        Parcourir les catégories
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Scripts pour les favoris et panier -->
<script>
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
