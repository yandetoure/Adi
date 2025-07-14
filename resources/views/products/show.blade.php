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
    .product-container { background: #f8f9fa; min-height: 100vh; }
    .product-card { background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .image-gallery { background: white; border-radius: 12px; overflow: hidden; }
    .main-image { transition: transform 0.3s ease; }
    .main-image:hover { transform: scale(1.02); }
    .thumbnail { cursor: pointer; transition: all 0.3s ease; border: 2px solid transparent; }
    .thumbnail:hover { border-color: #3b82f6; transform: scale(1.05); }
    .thumbnail.active { border-color: #3b82f6; }
    .price-current { color: #ef4444; font-weight: 800; }
    .price-original { text-decoration: line-through; color: #9ca3af; }
    .discount-badge { background: linear-gradient(45deg, #ef4444, #dc2626); }
    .whatsapp-btn { background: linear-gradient(45deg, #25D366, #128C7E); }
    .whatsapp-btn:hover { background: linear-gradient(45deg, #128C7E, #075E54); transform: translateY(-2px); }
    .cart-btn { background: linear-gradient(45deg, #f59e0b, #d97706); }
    .cart-btn:hover { background: linear-gradient(45deg, #d97706, #b45309); transform: translateY(-2px); }
    .favorite-btn { transition: all 0.3s ease; }
    .favorite-btn:hover { transform: scale(1.1); }
    .favorite-btn.favorited { color: #ef4444; animation: heartBeat 0.6s ease-in-out; }
    @keyframes heartBeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.3); }
        28% { transform: scale(1); }
        42% { transform: scale(1.3); }
        70% { transform: scale(1); }
    }
    .tab-button { transition: all 0.3s ease; }
    .tab-button.active { background: #3b82f6; color: white; }
    .tab-button:hover:not(.active) { background: #f3f4f6; }
    .spec-item { border-bottom: 1px solid #e5e7eb; padding: 12px 0; }
    .spec-item:last-child { border-bottom: none; }
    .breadcrumb-item { color: #6b7280; transition: color 0.3s ease; }
    .breadcrumb-item:hover { color: #3b82f6; }
    .stock-badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .stock-in { background: #dcfce7; color: #166534; }
    .stock-out { background: #fee2e2; color: #991b1b; }
    .feature-icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
    .feature-warranty { background: #dbeafe; color: #1e40af; }
    .feature-shipping { background: #d1fae5; color: #065f46; }
    .feature-return { background: #fef3c7; color: #92400e; }
    .feature-support { background: #f3e8ff; color: #7c3aed; }
</style>

<div class="product-container">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="breadcrumb-item hover:text-blue-600 transition">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('products.index') }}" class="breadcrumb-item hover:text-blue-600 transition">
                            Produits
                        </a>
                    </div>
                </li>
                @if($product->category)
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('categories.show', $product->category) }}" class="breadcrumb-item hover:text-blue-600 transition">
                            {{ $product->category->name }}
                        </a>
                    </div>
                </li>
                @endif
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-900 font-medium">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Main Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Image Gallery -->
            <div class="lg:col-span-1">
                <div class="image-gallery p-4">
                    @if($product->media->count() > 0 && $product->getFirstMediaUrl('images') && $product->getFirstMediaUrl('images') !== '')
                        <div class="mb-4">
                            <img id="main-image" src="{{ $product->getFirstMediaUrl('images') }}" 
                                 alt="{{ $product->name }}" 
                                 class="main-image w-full h-96 object-contain rounded-lg">
                        </div>
                        
                        @if($product->media->count() > 1)
                            <div class="grid grid-cols-4 gap-2">
                                @foreach($product->media as $index => $media)
                                    <button onclick="changeImage('{{ $media->getUrl() }}', {{ $index }})" 
                                            class="thumbnail aspect-square w-full border-2 border-gray-200 rounded-lg overflow-hidden {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $media->getUrl() }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-image text-6xl text-gray-400"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="lg:col-span-2">
                <div class="product-card p-6">
                    <!-- Title and Category -->
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-900 mb-3 leading-tight">{{ $product->name }}</h1>
                        @if($product->category)
                            <a href="{{ route('categories.show', $product->category) }}" 
                               class="inline-flex items-center bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full hover:bg-blue-200 transition">
                                <i class="fas fa-tag mr-2"></i>
                                {{ $product->category->name }}
                            </a>
                        @endif
                    </div>

                    <!-- Price Section -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        @if($product->discount_percentage > 0)
                            <div class="flex items-center space-x-4 mb-2">
                                <span class="price-current text-4xl font-bold">{{ number_format($product->price * (1 - $product->discount_percentage / 100), 0, ',', ' ') }} FCFA</span>
                                <span class="price-original text-xl">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                <span class="discount-badge text-white text-sm px-3 py-1 rounded-full font-bold">
                                    -{{ $product->discount_percentage }}%
                                </span>
                            </div>
                        @else
                            <span class="price-current text-4xl font-bold">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
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
                            <h3 class="font-semibold text-blue-900 mb-2">Aperçu</h3>
                            <p class="text-blue-800">{{ $product->short_description }}</p>
                        </div>
                    @endif

                    <!-- Product Actions -->
                    @if($product->stock_quantity > 0)
                        <div class="space-y-4 mb-6">
                            <!-- Quantity Selector -->
                            <div class="flex items-center space-x-4">
                                <label for="quantity" class="text-sm font-medium text-gray-700">Quantité:</label>
                                <select name="quantity" id="quantity" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                                   class="whatsapp-btn text-white py-4 px-6 rounded-lg font-bold text-center transition-all duration-300 hover:shadow-lg text-lg flex items-center justify-center">
                                    <i class="fab fa-whatsapp mr-3 text-xl"></i>
                                    Discuter sur WhatsApp
                                </a>

                                <!-- Add to Cart Button -->
                                <form action="{{ route('cart.add') }}" method="POST" class="inline w-full">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="quantity-input" value="1">
                                    <button type="submit" 
                                            class="cart-btn w-full text-white py-4 px-6 rounded-lg font-bold transition-all duration-300 hover:shadow-lg text-lg flex items-center justify-center">
                                        <i class="fas fa-shopping-cart mr-3 text-xl"></i>
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
                                                    class="favorite-btn favorited bg-red-50 text-red-600 p-3 rounded-full hover:bg-red-100">
                                                <i class="fas fa-heart text-xl"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('favorites.add', $product) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="favorite-btn bg-gray-50 text-gray-600 p-3 rounded-full hover:bg-red-50 hover:text-red-600">
                                                <i class="far fa-heart text-xl"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    @else
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center mb-6">
                            <i class="fas fa-exclamation-triangle text-red-600 text-2xl mb-2"></i>
                            <p class="text-red-800 font-medium">Ce produit est actuellement en rupture de stock</p>
                            <p class="text-red-600 text-sm mt-1">Contactez-nous pour plus d'informations</p>
                        </div>
                    @endif

                    <!-- Product Features -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="text-center">
                            <div class="feature-icon feature-warranty mx-auto mb-2">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <p class="text-xs text-gray-600">2 ans de garantie</p>
                        </div>
                        <div class="text-center">
                            <div class="feature-icon feature-shipping mx-auto mb-2">
                                <i class="fas fa-truck"></i>
                            </div>
                            <p class="text-xs text-gray-600">Livraison gratuite</p>
                        </div>
                        <div class="text-center">
                            <div class="feature-icon feature-return mx-auto mb-2">
                                <i class="fas fa-undo"></i>
                            </div>
                            <p class="text-xs text-gray-600">Retour 30 jours</p>
                        </div>
                        <div class="text-center">
                            <div class="feature-icon feature-support mx-auto mb-2">
                                <i class="fas fa-headset"></i>
                            </div>
                            <p class="text-xs text-gray-600">Support 24/7</p>
                        </div>
                    </div>

                    <!-- Product Info Grid -->
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-box text-blue-600"></i>
                            <div>
                                <span class="text-gray-500">Référence</span>
                                <div class="font-medium">{{ $product->sku }}</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-eye text-green-600"></i>
                            <div>
                                <span class="text-gray-500">Vues</span>
                                <div class="font-medium">{{ $product->view_count }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="product-card">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button onclick="showTab('description')" 
                            class="tab-button active py-4 px-1 border-b-2 border-transparent font-medium text-sm">
                        <i class="fas fa-file-alt mr-2"></i>
                        Description
                    </button>
                    <button onclick="showTab('specifications')" 
                            class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm">
                        <i class="fas fa-cogs mr-2"></i>
                        Spécifications
                    </button>
                    <button onclick="showTab('reviews')" 
                            class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm">
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
                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    @else
                        <p class="text-gray-500">Aucune description disponible pour ce produit.</p>
                    @endif
                </div>

                <!-- Specifications Tab -->
                <div id="specifications-tab" class="tab-content hidden">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Spécifications techniques</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-0">
                            <div class="spec-item">
                                <span class="font-medium text-gray-900">Référence:</span>
                                <span class="text-gray-600 ml-2">{{ $product->sku }}</span>
                            </div>
                            <div class="spec-item">
                                <span class="font-medium text-gray-900">Catégorie:</span>
                                <span class="text-gray-600 ml-2">{{ $product->category->name ?? 'Non définie' }}</span>
                            </div>
                            <div class="spec-item">
                                <span class="font-medium text-gray-900">Stock:</span>
                                <span class="text-gray-600 ml-2">{{ $product->stock_quantity }} unités</span>
                            </div>
                            <div class="spec-item">
                                <span class="font-medium text-gray-900">Prix:</span>
                                <span class="text-gray-600 ml-2">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                        <div class="space-y-0">
                            <div class="spec-item">
                                <span class="font-medium text-gray-900">Statut:</span>
                                <span class="text-gray-600 ml-2">{{ $product->is_active ? 'Actif' : 'Inactif' }}</span>
                            </div>
                            <div class="spec-item">
                                <span class="font-medium text-gray-900">Vues:</span>
                                <span class="text-gray-600 ml-2">{{ $product->view_count }}</span>
                            </div>
                            <div class="spec-item">
                                <span class="font-medium text-gray-900">Date d'ajout:</span>
                                <span class="text-gray-600 ml-2">{{ $product->created_at->format('d/m/Y') }}</span>
                            </div>
                            @if($product->discount_percentage > 0)
                            <div class="spec-item">
                                <span class="font-medium text-gray-900">Réduction:</span>
                                <span class="text-red-600 ml-2 font-bold">{{ $product->discount_percentage }}%</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="reviews-tab" class="tab-content hidden">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Avis clients</h3>
                    <div class="text-center py-8">
                        <i class="fas fa-star text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Aucun avis pour le moment</p>
                        <p class="text-sm text-gray-400 mt-2">Soyez le premier à laisser un avis sur ce produit</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($product->category && $product->category->products()->where('id', '!=', $product->id)->count() > 0)
        <div class="mt-8">
            <div class="product-card p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produits similaires</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($product->category->products()->where('id', '!=', $product->id)->where('is_active', true)->take(4)->get() as $similarProduct)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300 hover:scale-105">
                        <a href="{{ route('products.show', $similarProduct) }}">
                            @if($similarProduct->getFirstMediaUrl('images') && $similarProduct->getFirstMediaUrl('images') !== '')
                                <img src="{{ $similarProduct->getFirstMediaUrl('images') }}" 
                                     alt="{{ $similarProduct->name }}" 
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-3xl text-gray-400"></i>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 text-sm">{{ $similarProduct->name }}</h3>
                                <div class="text-lg font-bold text-blue-600">
                                    {{ number_format($similarProduct->price, 0, ',', ' ') }} FCFA
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
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