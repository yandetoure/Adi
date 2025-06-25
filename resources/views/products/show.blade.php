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
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                    Accueil
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('products.index') }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">
                        Produits
                    </a>
                </div>
            </li>
            @if($product->category)
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('categories.show', $product->category) }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">
                        {{ $product->category->name }}
                    </a>
                </div>
            </li>
            @endif
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-gray-500 md:ml-2">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Images du produit -->
        <div class="space-y-4">
            @if($product->media->count() > 0)
                <div class="aspect-w-1 aspect-h-1 w-full">
                    <img id="main-image" src="{{ $product->getFirstMediaUrl('images') }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-96 object-cover rounded-lg shadow-lg">
                </div>
                
                @if($product->media->count() > 1)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->media as $media)
                            <button onclick="changeImage('{{ $media->getUrl() }}')" 
                                    class="aspect-w-1 aspect-h-1 w-full">
                                <img src="{{ $media->getUrl() }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-20 object-cover rounded-lg border-2 border-transparent hover:border-blue-500 transition-colors">
                            </button>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="aspect-w-1 aspect-h-1 w-full bg-gray-200 rounded-lg flex items-center justify-center">
                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
        </div>

        <!-- Informations du produit -->
        <div class="space-y-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                @if($product->category)
                    <a href="{{ route('categories.show', $product->category) }}" 
                       class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full hover:bg-blue-200 transition-colors">
                        {{ $product->category->name }}
                    </a>
                @endif
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-3xl font-bold text-gray-900">{{ number_format($product->price, 2) }} €</span>
                @if($product->is_on_sale && $product->sale_price)
                    <span class="text-xl text-gray-500 line-through">{{ number_format($product->sale_price, 2) }} €</span>
                    <span class="bg-red-100 text-red-800 text-sm px-2 py-1 rounded-full">
                        -{{ $product->discount_percentage }}%
                    </span>
                @endif
            </div>

            @if($product->short_description)
                <p class="text-gray-600 text-lg">{{ $product->short_description }}</p>
            @endif

            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Stock:</span>
                    @if($product->stock_quantity > 0)
                        <span class="text-green-600 font-medium">{{ $product->stock_quantity }} en stock</span>
                    @else
                        <span class="text-red-600 font-medium">Rupture de stock</span>
                    @endif
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">Vues:</span>
                    <span class="text-gray-700">{{ $product->view_count }}</span>
                </div>
            </div>

            @if($product->stock_quantity > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="flex items-center space-x-4">
                        <label for="quantity" class="text-sm font-medium text-gray-700">Quantité:</label>
                        <select name="quantity" id="quantity" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @for($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                        </svg>
                        Ajouter au panier
                    </button>
                </form>
            @else
                <div class="bg-gray-100 text-gray-600 py-3 px-6 rounded-lg text-center">
                    Ce produit n'est actuellement pas disponible
                </div>
            @endif
        </div>
    </div>

    <!-- Description complète -->
    @if($product->description)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Description</h2>
            <div class="prose max-w-none">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    @endif

    <!-- Produits similaires -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produits similaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <a href="{{ route('products.show', $relatedProduct) }}">
                            @if($relatedProduct->getFirstMediaUrl('images'))
                                <img src="{{ $relatedProduct->getFirstMediaUrl('images') }}" 
                                     alt="{{ $relatedProduct->name }}" 
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </a>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">
                                <a href="{{ route('products.show', $relatedProduct) }}" class="hover:text-blue-600">
                                    {{ $relatedProduct->name }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($relatedProduct->short_description, 60) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-gray-900">{{ number_format($relatedProduct->price, 2) }} €</span>
                                <a href="{{ route('products.show', $relatedProduct) }}" 
                                   class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
function changeImage(src) {
    document.getElementById('main-image').src = src;
}
</script>
@endsection 