@extends('layouts.app')

@section('title', 'Nos Produits - ADI Store')
@section('meta_description', 'Découvrez notre sélection de produits de qualité. Trouvez ce que vous cherchez parmi notre large gamme.')
@section('meta_keywords', 'produits, boutique, ADI Store, qualité, sélection')

@section('content')
<!-- Styles spécifiques à la page des produits -->
<style>
    .hero-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
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
    .filter-section {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 3rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .search-input {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 15px;
        padding: 1rem 1rem 1rem 3rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .search-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.15);
        outline: none;
    }
    .filter-select {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 15px;
        padding: 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        cursor: pointer;
    }
    .filter-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.15);
        outline: none;
    }
    .results-info {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid #3b82f6;
    }
    .empty-state {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .pagination-container {
        background: white;
        border-radius: 15px;
        padding: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-top: 3rem;
    }
</style>

<!-- Hero Section -->
<section class="hero-gradient text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Nos <span class="text-yellow-300">Produits</span>
            </h1>
            <p class="text-xl text-gray-100 max-w-3xl mx-auto">
                Découvrez notre sélection complète de produits informatiques de qualité. 
                Trouvez exactement ce que vous cherchez parmi notre large gamme.
            </p>
        </div>
    </div>
</section>

<!-- Filters and Search -->
<section class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="filter-section">
            <form method="GET" action="{{ route('products.index') }}" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Rechercher un produit..." 
                            class="search-input w-full"
                        >
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
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
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105">
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
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $products->total() }} produit(s) trouvé(s)
                        </h3>
                        @if(request('search') || request('category') || request('sort'))
                            <p class="text-sm text-gray-600 mt-1">
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
                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                        <i class="fas fa-times mr-1"></i>
                        Effacer les filtres
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Products Grid -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($products->count() > 0)
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
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($product->short_description, 80) }}</p>
                            @elseif($product->description)
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit(strip_tags($product->description), 80) }}</p>
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

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="mb-6">
                    <i class="fas fa-search text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucun produit trouvé</h3>
                    <p class="text-gray-600 max-w-md mx-auto">
                        Essayez de modifier vos critères de recherche ou parcourez toutes nos catégories.
                    </p>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-home mr-2"></i>
                        Voir tous les produits
                    </a>
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-300">
                        <i class="fas fa-th-large mr-2"></i>
                        Parcourir les catégories
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Scripts pour les favoris -->
<script>
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