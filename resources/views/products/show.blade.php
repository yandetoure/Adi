@extends('layouts.app')

@section('title', $product->meta_title ?: $product->name . ' - ADI Store')
@section('meta_description', $product->meta_description ?: Str::limit($product->description, 160))
@section('meta_keywords', $product->meta_keywords ?: $product->category->name . ', ' . $product->name)
@section('og_image', $product->getFirstMediaUrl('images') ?: asset('images/adi-logo.png'))

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ $product->description }}",
    "image": "{{ $product->getFirstMediaUrl('images') ?: asset('images/adi-logo.png') }}",
    "brand": {
        "@type": "Brand",
        "name": "ADI Store"
    },
    "offers": {
        "@type": "Offer",
        "url": "{{ url('/products/' . $product->slug) }}",
        "priceCurrency": "XOF",
        "price": "{{ $product->price }}",
        "availability": "{{ $product->stock_quantity > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
        "priceValidUntil": "{{ now()->addYear()->toISOString() }}"
    },
    "category": "{{ $product->category->name ?? 'Produits' }}"
}
</script>
@endsection

@section('content')
<style>
    /* Product Container */
    .product-container {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
    }

    /* Breadcrumb */
    .breadcrumb {
        background: white;
        border-radius: 20px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .breadcrumb-item {
        color: #6b7280;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .breadcrumb-item:hover {
        color: #3b82f6;
        transform: translateY(-1px);
    }

    /* Product Card */
    .product-card {
        background: white;
        border-radius: 25px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
    }

    /* Image Gallery */
    .image-gallery {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .main-image {
        transition: transform 0.4s ease;
        border-radius: 20px;
    }

    .main-image:hover {
        transform: scale(1.02);
    }

    .thumbnail {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 3px solid transparent;
        border-radius: 15px;
        overflow: hidden;
    }

    .thumbnail:hover {
        border-color: #3b82f6;
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .thumbnail.active {
        border-color: #3b82f6;
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    /* Price Section */
    .price-section {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 2rem;
        border: 2px solid #e2e8f0;
    }

    .price-current {
        color: #3b82f6;
        font-weight: 800;
        font-size: 2.5rem;
    }

    .price-original {
        text-decoration: line-through;
        color: #9ca3af;
        font-size: 1.5rem;
    }

    .discount-badge {
        background: linear-gradient(45deg, #ef4444, #dc2626);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    /* Stock Status */
    .stock-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .stock-in {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #166534;
        border: 2px solid #22c55e;
    }

    .stock-out {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
        border: 2px solid #ef4444;
    }

    /* Action Buttons */
    .action-btn {
        padding: 1rem 2rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .whatsapp-btn {
        background: linear-gradient(135deg, #25D366, #128C7E);
        color: white;
    }

    .whatsapp-btn:hover {
        background: linear-gradient(135deg, #128C7E, #075E54);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(37, 211, 102, 0.4);
    }

    .cart-btn {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
    }

    .cart-btn:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
    }

    /* Favorite Button */
    .favorite-btn {
        transition: all 0.3s ease;
        border-radius: 50%;
        padding: 1rem;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .favorite-btn:hover {
        transform: scale(1.1);
    }

    .favorite-btn.favorited {
        color: #ef4444;
        animation: heartBeat 0.6s ease-in-out;
    }

    @keyframes heartBeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.3); }
        28% { transform: scale(1); }
        42% { transform: scale(1.3); }
        70% { transform: scale(1); }
    }

    /* Features */
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        border-color: #3b82f6;
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
    }

    /* Tabs */
    .tab-button {
        transition: all 0.3s ease;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 600;
        border: 2px solid transparent;
        background: #f8fafc;
        color: #6b7280;
    }

    .tab-button.active {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .tab-button:hover:not(.active) {
        background: #e2e8f0;
        transform: translateY(-2px);
    }

    /* Tab Content */
    .tab-content {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .spec-item {
        border-bottom: 1px solid #e5e7eb;
        padding: 1rem 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .spec-item:last-child {
        border-bottom: none;
    }

    .spec-label {
        font-weight: 600;
        color: #374151;
    }

    .spec-value {
        color: #6b7280;
        font-weight: 500;
    }

    /* Related Products */
    .related-product {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .related-product:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        border-color: #3b82f6;
    }

    .related-product img {
        transition: transform 0.3s ease;
    }

    .related-product:hover img {
        transform: scale(1.05);
    }

    /* Quantity Selector */
    .quantity-selector {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 15px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .quantity-selector:focus {
        border-color: #3b82f6;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        outline: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .price-current {
            font-size: 2rem;
        }

        .price-original {
            font-size: 1.25rem;
        }

        .action-btn {
            padding: 0.875rem 1.5rem;
            font-size: 1rem;
        }

        .feature-card {
            padding: 1rem;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
        }
    }
</style>

<div class="product-container">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 md:space-x-4">
                <li>
                    <a href="{{ route('home') }}" class="breadcrumb-item flex items-center">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                </li>
                <li>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                    <a href="{{ route('products.index') }}" class="breadcrumb-item ml-2 md:ml-4">
                        Produits
                    </a>
                </li>
                @if($product->category)
                <li>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                    <a href="{{ route('categories.show', $product->category) }}" class="breadcrumb-item ml-2 md:ml-4">
                        {{ $product->category->name }}
                    </a>
                </li>
                @endif
                <li>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                    <span class="text-gray-900 font-semibold ml-2 md:ml-4">{{ $product->name }}</span>
                </li>
            </ol>
        </nav>

        <!-- Product Main Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Image Gallery -->
            <div>
                <div class="image-gallery p-6">
                    @if($product->media->count() > 0 && $product->getFirstMediaUrl('images') && $product->getFirstMediaUrl('images') !== '')
                        <div class="mb-6">
                            <img id="main-image" src="{{ $product->getFirstMediaUrl('images') }}"
                                 alt="{{ $product->name }}"
                                 class="main-image w-full h-96 md:h-[500px] object-contain">
                        </div>

                        @if($product->media->count() > 1)
                            <div class="grid grid-cols-4 gap-4">
                                @foreach($product->media as $index => $media)
                                    <button onclick="changeImage('{{ $media->getUrl() }}', {{ $index }})"
                                            class="thumbnail aspect-square w-full {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $media->getUrl() }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="w-full h-96 md:h-[500px] bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-image text-8xl text-gray-400"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <div class="product-card p-8">
                    <!-- Title and Category -->
                    <div class="mb-6">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3 leading-tight">{{ $product->name }}</h1>
                        @if($product->category)
                            <a href="{{ route('categories.show', $product->category) }}"
                               class="inline-flex items-center bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 text-xs px-3 py-1 rounded-full hover:from-blue-200 hover:to-blue-300 transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-tag mr-2"></i>
                                {{ $product->category->name }}
                            </a>
                        @endif
                    </div>

                    <!-- Price Section -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        @if($product->discount_percentage > 0)
                            <div class="flex items-center space-x-4 mb-2">
                                <span class="price-current text-2xl font-bold">{{ number_format($product->price * (1 - $product->discount_percentage / 100), 0, ',', ' ') }} FCFA</span>
                                <span class="price-original text-lg">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                <span class="discount-badge text-white text-sm px-3 py-1 rounded-full font-bold">
                                    -{{ $product->discount_percentage }}%
                                </span>
                            </div>
                        @else
                            <span class="price-current text-2xl font-bold">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                        @endif

                        <!-- Stock Status -->
                        <div class="flex items-center mt-3">
                            <span class="stock-badge {{ $product->stock_quantity > 0 ? 'stock-in' : 'stock-out' }}">
                                <i class="fas {{ $product->stock_quantity > 0 ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                {{ $product->stock_quantity > 0 ? 'En stock' : 'Rupture de stock' }}
                            </span>
                            @if($product->stock_quantity > 0)
                                <span class="text-sm text-gray-600 ml-3">{{ $product->stock_quantity }} unités disponibles</span>
                            @endif
                        </div>
                    </div>

                    <!-- Short Description -->
                    @if($product->short_description)
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                            <h3 class="font-semibold text-blue-900 mb-2 text-sm">Aperçu</h3>
                            <p class="text-blue-800 text-sm">{{ $product->short_description }}</p>
                        </div>
                    @endif

                    <!-- Product Actions -->
                    @if($product->stock_quantity > 0)
                        <div class="space-y-4 mb-6">
                            <!-- Quantity Selector -->
                            <div class="flex items-center space-x-4">
                                <label for="quantity" class="text-sm font-medium text-gray-700">Quantité:</label>
                                <select name="quantity" id="quantity" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                    @for($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- WhatsApp Button -->
                                <a href="https://wa.me/221771234567?text={{ urlencode('Bonjour, je souhaite acheter '. $product->name .' (SKU : '. $product->sku .') au prix de '. number_format($product->discount_percentage > 0 ? $product->price * (1 - $product->discount_percentage / 100) : $product->price, 0, ',', ' ') .' FCFA sur ADI Informatique.') }}"
                                   target="_blank"
                                   class="whatsapp-btn text-white py-3 px-4 rounded-lg font-bold text-center transition-all duration-300 hover:shadow-lg text-sm flex items-center justify-center">
                                    <i class="fab fa-whatsapp mr-2 text-lg"></i>
                                    Discuter sur WhatsApp
                                </a>

                                <!-- Add to Cart Button -->
                                <form action="{{ route('cart.add') }}" method="POST" class="inline w-full">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="quantity-input" value="1">
                                    <button type="submit"
                                            class="cart-btn w-full text-white py-3 px-4 rounded-lg font-bold transition-all duration-300 hover:shadow-lg text-sm flex items-center justify-center">
                                        <i class="fas fa-shopping-cart mr-2 text-lg"></i>
                                        Ajouter au panier
                                    </button>
                                </form>
                            </div>

                            <!-- Favorites -->
                            @auth
                                <div class="flex justify-center">
                                    @if($isFavorite)
                                        <form action="{{ route('favorites.remove', $product) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="favorite-btn favorited bg-red-50 text-red-600 p-2 rounded-full hover:bg-red-100">
                                                <i class="fas fa-heart text-lg"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('favorites.add', $product) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                    class="favorite-btn bg-gray-50 text-gray-600 p-2 rounded-full hover:bg-red-50 hover:text-red-600">
                                                <i class="far fa-heart text-lg"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    @else
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center mb-6">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl mb-2"></i>
                            <p class="text-red-800 font-medium text-sm">Ce produit est actuellement en rupture de stock</p>
                            <p class="text-red-600 text-xs mt-1">Contactez-nous pour plus d'informations</p>
                        </div>
                    @endif

                    <!-- Product Features -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="text-center">
                            <div class="feature-icon feature-warranty mx-auto mb-2">
                                <i class="fas fa-shield-alt text-sm"></i>
                            </div>
                            <p class="text-xs text-gray-600">2 ans de garantie</p>
                        </div>
                        <div class="text-center">
                            <div class="feature-icon feature-shipping mx-auto mb-2">
                                <i class="fas fa-truck text-sm"></i>
                            </div>
                            <p class="text-xs text-gray-600">Livraison gratuite</p>
                        </div>
                        <div class="text-center">
                            <div class="feature-icon feature-return mx-auto mb-2">
                                <i class="fas fa-undo text-sm"></i>
                            </div>
                            <p class="text-xs text-gray-600">Retour 30 jours</p>
                        </div>
                        <div class="text-center">
                            <div class="feature-icon feature-support mx-auto mb-2">
                                <i class="fas fa-headset text-sm"></i>
                            </div>
                            <p class="text-xs text-gray-600">Support 24/7</p>
                        </div>
                    </div>

                    <!-- Product Info Grid -->
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-box text-blue-600"></i>
                            <div>
                                <span class="text-gray-500">Référence</span>
                                <div class="font-medium text-sm">{{ $product->sku }}</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-eye text-green-600"></i>
                            <div>
                                <span class="text-gray-500">Vues</span>
                                <div class="font-medium text-sm">{{ $product->view_count }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="product-card mb-8">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 p-6">
                <nav class="flex flex-wrap gap-4" aria-label="Tabs">
                    <button onclick="showTab('description')"
                            class="tab-button active">
                        <i class="fas fa-file-alt mr-2"></i>
                        Description
                    </button>
                    <button onclick="showTab('specifications')"
                            class="tab-button">
                        <i class="fas fa-cogs mr-2"></i>
                        Spécifications
                    </button>
                    <button onclick="showTab('details')"
                            class="tab-button">
                        <i class="fas fa-info-circle mr-2"></i>
                        Détails
                    </button>
                    <button onclick="showTab('reviews')"
                            class="tab-button">
                        <i class="fas fa-star mr-2"></i>
                        Avis (0)
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Description Tab -->
                <div id="description-tab" class="tab-content">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Description du produit</h3>
                    @if($product->description)
                        <div class="prose max-w-none text-gray-700 leading-relaxed text-sm">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-file-alt text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 text-sm">Aucune description disponible pour ce produit.</p>
                        </div>
                    @endif

                    @if($product->short_description)
                        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                            <h4 class="font-semibold text-blue-900 mb-2 text-sm">Aperçu</h4>
                            <p class="text-blue-800 text-sm">{{ $product->short_description }}</p>
                        </div>
                    @endif
                </div>

                <!-- Specifications Tab -->
                <div id="specifications-tab" class="tab-content hidden">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Spécifications techniques</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-0">
                            <div class="spec-item">
                                <span class="spec-label text-sm">Référence:</span>
                                <span class="spec-value text-sm">{{ $product->sku }}</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label text-sm">Catégorie:</span>
                                <span class="spec-value text-sm">{{ $product->category->name ?? 'Non définie' }}</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label text-sm">Stock:</span>
                                <span class="spec-value text-sm">{{ $product->stock_quantity }} unités</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label text-sm">Prix:</span>
                                <span class="spec-value text-sm">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                        <div class="space-y-0">
                            <div class="spec-item">
                                <span class="spec-label text-sm">Statut:</span>
                                <span class="spec-value text-sm">{{ $product->is_active ? 'Actif' : 'Inactif' }}</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label text-sm">Vues:</span>
                                <span class="spec-value text-sm">{{ $product->view_count }}</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label text-sm">Date d'ajout:</span>
                                <span class="spec-value text-sm">{{ $product->created_at->format('d/m/Y') }}</span>
                            </div>
                            @if($product->discount_percentage > 0)
                            <div class="spec-item">
                                <span class="spec-label text-sm">Réduction:</span>
                                <span class="spec-value text-red-600 font-bold text-sm">{{ $product->discount_percentage }}%</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Details Tab -->
                <div id="details-tab" class="tab-content hidden">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Détails du produit</h3>
                    <div class="space-y-4">
                        @if($product->meta_title)
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2 text-sm">Titre SEO</h4>
                                <p class="text-gray-700 text-sm">{{ $product->meta_title }}</p>
                            </div>
                        @endif

                        @if($product->meta_description)
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2 text-sm">Description SEO</h4>
                                <p class="text-gray-700 text-sm">{{ $product->meta_description }}</p>
                            </div>
                        @endif

                        @if($product->meta_keywords)
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2 text-sm">Mots-clés</h4>
                                <p class="text-gray-700 text-sm">{{ $product->meta_keywords }}</p>
                            </div>
                        @endif

                        <div class="p-4 bg-blue-50 rounded-lg">
                            <h4 class="font-semibold text-blue-900 mb-2 text-sm">Informations générales</h4>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-700">Créé le:</span>
                                    <span class="text-gray-600 ml-2">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Modifié le:</span>
                                    <span class="text-gray-600 ml-2">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                    </div>
                        </div>
                    </div>
                </div>

        <!-- Reviews Tab -->
                <div id="reviews-tab" class="tab-content hidden">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Avis clients</h3>
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-star text-4xl text-gray-300"></i>
                        </div>
                        <p class="text-gray-500 text-xl mb-2">Aucun avis pour le moment</p>
                        <p class="text-gray-400">Soyez le premier à laisser un avis sur ce produit</p>
                    </div>
                </div>
    </div>
        </div>

        <!-- Related Products -->
        @if($product->category && $product->category->products()->where('id', '!=', $product->id)->count() > 0)
        <div class="product-card p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produits similaires</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($product->category->products()->where('id', '!=', $product->id)->where('is_active', true)->take(4)->get() as $similarProduct)
                    <div class="product-card-compact">
                        <div class="product-image-container">
                            <img src="{{ $similarProduct->image_url }}"
                                 alt="{{ $similarProduct->name }}"
                                 class="product-image">
                            @if($similarProduct->discount_percentage > 0)
                                <div class="discount-badge-compact">
                                    -{{ $similarProduct->discount_percentage }}%
                                </div>
                            @endif
                        </div>
                        <div class="product-info-compact">
                            <h3 class="product-title-compact">{{ $similarProduct->name }}</h3>
                            <div class="price-section-compact">
                                @if($similarProduct->discount_percentage > 0)
                                    <span class="current-price-compact">{{ number_format($similarProduct->price * (1 - $similarProduct->discount_percentage / 100), 0, ',', ' ') }} FCFA</span>
                                    <span class="original-price-compact">{{ number_format($similarProduct->price, 0, ',', ' ') }} FCFA</span>
                                @else
                                    <span class="current-price-compact">{{ number_format($similarProduct->price, 0, ',', ' ') }} FCFA</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    function changeImage(src, index) {
        document.getElementById('main-image').src = src;

        // Update active thumbnails
        document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
            if (i === index) {
                thumb.classList.add('active');
            } else {
                thumb.classList.remove('active');
            }
        });
    }

    function showTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
});

        // Remove active class from all tab buttons
document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active');
        });

        // Show selected tab content
        document.getElementById(tabName + '-tab').classList.remove('hidden');

        // Add active class to clicked button
        event.target.classList.add('active');
    }

    // Update quantity for form
    document.getElementById('quantity').addEventListener('change', function() {
        document.getElementById('quantity-input').value = this.value;
    });
</script>
@endsection
