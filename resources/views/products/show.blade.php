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
        "priceCurrency": "EUR",
        "price": "{{ $product->price }}",
        "availability": "{{ $product->stock_quantity > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
        "priceValidUntil": "{{ now()->addYear()->toISOString() }}"
    },
    "category": "{{ $product->category->name ?? 'Produits' }}",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.5",
        "reviewCount": "10"
    }
}
</script>
@endsection

@section('content')
<style>
    .product-gallery { background: #f8f9fa; }
    .price-original { text-decoration: line-through; color: #9ca3af; }
    .price-discount { color: #ef4444; font-weight: bold; }
    .whatsapp-btn { background: #25D366; }
    .whatsapp-btn:hover { background: #128C7E; }
    .add-to-cart-btn { background: #f59e0b; }
    .add-to-cart-btn:hover { background: #d97706; }
    .favorite-btn { transition: all 0.3s ease; }
    .favorite-btn:hover { transform: scale(1.1); }
    .favorite-btn.favorited { color: #ef4444; }
    .breadcrumb-item { color: #6b7280; }
    .breadcrumb-item:hover { color: #3b82f6; }
    .product-image { transition: transform 0.3s ease; }
    .product-image:hover { transform: scale(1.05); }
    .thumbnail { cursor: pointer; transition: all 0.3s ease; }
    .thumbnail:hover { border-color: #3b82f6; transform: scale(1.05); }
    .thumbnail.active { border-color: #3b82f6; }
</style>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Images du produit -->
            <div class="product-gallery rounded-lg p-6">
                @if($product->media->count() > 0 && $product->getFirstMediaUrl('images') && $product->getFirstMediaUrl('images') !== '')
                    <div class="mb-6">
                        <img id="main-image" src="{{ $product->getFirstMediaUrl('images') }}" 
                             alt="{{ $product->name }}" 
                             class="product-image w-full h-96 object-contain rounded-lg">
                    </div>
                    
                    @if($product->media->count() > 1)
                        <div class="grid grid-cols-4 gap-3">
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

            <!-- Informations du produit -->
            <div class="space-y-6">
                <!-- Titre et catégorie -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $product->name }}</h1>
                    @if($product->category)
                        <a href="{{ route('categories.show', $product->category) }}" 
                           class="inline-flex items-center bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full hover:bg-blue-200 transition">
                            <i class="fas fa-tag mr-2"></i>
                            {{ $product->category->name }}
                        </a>
                    @endif
                </div>

                <!-- Prix -->
                <div class="space-y-2">
                    @if($product->discount_percentage > 0)
                        <div class="flex items-center space-x-3">
                            <span class="price-discount text-4xl font-bold">{{ number_format($product->price * (1 - $product->discount_percentage / 100), 0, ',', ' ') }} FCFA</span>
                            <span class="price-original text-xl">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                            <span class="bg-red-500 text-white text-sm px-3 py-1 rounded-full font-bold">
                                -{{ $product->discount_percentage }}%
                            </span>
                        </div>
                    @else
                        <span class="text-4xl font-bold text-gray-900">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                    @endif
                </div>

                <!-- Description courte -->
                @if($product->short_description)
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700">{{ $product->short_description }}</p>
                    </div>
                @endif

                <!-- Informations produit -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-box text-blue-600"></i>
                        <div>
                            <span class="text-sm text-gray-500">SKU</span>
                            <div class="font-medium">{{ $product->sku }}</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-eye text-green-600"></i>
                        <div>
                            <span class="text-sm text-gray-500">Vues</span>
                            <div class="font-medium">{{ $product->view_count }}</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-warehouse text-orange-600"></i>
                        <div>
                            <span class="text-sm text-gray-500">Stock</span>
                            <div class="font-medium {{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock_quantity > 0 ? $product->stock_quantity . ' en stock' : 'Rupture de stock' }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-shipping-fast text-purple-600"></i>
                        <div>
                            <span class="text-sm text-gray-500">Livraison</span>
                            <div class="font-medium text-green-600">Gratuite</div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                @if($product->stock_quantity > 0)
                    <div class="space-y-4">
                        <!-- Quantité -->
                        <div class="flex items-center space-x-4">
                            <label for="quantity" class="text-sm font-medium text-gray-700">Quantité:</label>
                            <select name="quantity" id="quantity" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @for($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/221771234567?text={{ urlencode('Bonjour, je souhaite acheter '. $product->name .' (SKU : '. $product->sku .') au prix de '. number_format($product->discount_percentage > 0 ? $product->price * (1 - $product->discount_percentage / 100) : $product->price, 0, ',', ' ') .' FCFA sur ADI Informatique.') }}" 
                               target="_blank" 
                               class="whatsapp-btn text-white py-4 px-6 rounded-lg font-bold text-center transition hover:shadow-lg">
                                <i class="fab fa-whatsapp mr-2 text-xl"></i>
                                Commander sur WhatsApp
                            </a>

                            <!-- Ajouter au panier -->
                            <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="quantity-input" value="1">
                                <button type="submit" 
                                        class="add-to-cart-btn text-white py-4 px-6 rounded-lg font-bold w-full transition hover:shadow-lg">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Ajouter au panier
                                </button>
                            </form>
                        </div>

                        <!-- Favoris -->
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
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl mb-2"></i>
                        <p class="text-red-800 font-medium">Ce produit est actuellement en rupture de stock</p>
                        <p class="text-red-600 text-sm mt-1">Contactez-nous pour plus d'informations</p>
                    </div>
                @endif

                <!-- Garanties -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="font-bold text-blue-900 mb-3">Nos garanties</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-shield-alt text-blue-600"></i>
                            <span class="text-blue-800">2 ans de garantie</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-truck text-blue-600"></i>
                            <span class="text-blue-800">Livraison gratuite</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-undo text-blue-600"></i>
                            <span class="text-blue-800">Retour sous 30 jours</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-headset text-blue-600"></i>
                            <span class="text-blue-800">Support 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description détaillée -->
        @if($product->description)
        <div class="mt-12">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Description du produit</h2>
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>
        </div>
        @endif

        <!-- Produits similaires -->
        @if($product->category && $product->category->products()->where('id', '!=', $product->id)->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produits similaires</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($product->category->products()->where('id', '!=', $product->id)->where('is_active', true)->take(4)->get() as $similarProduct)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
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
                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $similarProduct->name }}</h3>
                            <div class="text-lg font-bold text-blue-600">
                                {{ number_format($similarProduct->price, 0, ',', ' ') }} FCFA
                            </div>
                        </div>
                    </a>
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
        
        // Mettre à jour les thumbnails actifs
        document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
            if (i === index) {
                thumb.classList.add('active');
            } else {
                thumb.classList.remove('active');
            }
        });
    }

    // Mettre à jour la quantité pour le formulaire
    document.getElementById('quantity').addEventListener('change', function() {
        document.getElementById('quantity-input').value = this.value;
    });
</script>
@endsection 