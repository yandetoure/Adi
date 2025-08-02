@extends('layouts.app')

@section('title', 'Ordinateurs Portables et de Bureau - ADI Technologies | Livraison Gratuite Dakar')
@section('meta_description', 'Découvrez notre sélection d\'ordinateurs portables et de bureau au meilleur prix au Sénégal. Ordinateurs HP, Dell, Lenovo, Asus. Livraison gratuite Dakar. Service client 24/7.')
@section('meta_keywords', 'ordinateurs, ordinateur portable, ordinateur de bureau, laptop, computer, HP, Dell, Lenovo, Asus, ADI Technologies, Dakar, Sénégal')

@section('content')
<!-- Hero Section -->
<section class="page-header text-white py-20">
    <div class="container mx-auto px-4">
        <div class="page-header-content text-center">
            <div class="page-header-card">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    <span class="text-yellow-300">Ordinateurs</span> Performants
                </h1>
                <p class="text-xl text-gray-100 max-w-3xl mx-auto mb-8">
                    Découvrez notre gamme complète d'ordinateurs portables et de bureau.
                    Ordinateurs HP, Dell, Lenovo, Asus au meilleur prix au Sénégal.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <span class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold">
                        <i class="fas fa-shipping-fast mr-2"></i>Livraison Gratuite
                    </span>
                    <span class="bg-green-600 text-white px-4 py-2 rounded-full text-sm font-semibold">
                        <i class="fas fa-shield-alt mr-2"></i>Garantie Officielle
                    </span>
                    <span class="bg-purple-600 text-white px-4 py-2 rounded-full text-sm font-semibold">
                        <i class="fas fa-headset mr-2"></i>Support 24/7
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SEO Content Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">
                    Ordinateurs Professionnels au Sénégal
                </h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">
                            <i class="fas fa-laptop text-blue-600 mr-2"></i>
                            Pourquoi choisir ADI Technologies ?
                        </h3>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Ordinateurs originaux HP, Dell, Lenovo, Asus</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Garantie officielle constructeur</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Configuration sur mesure</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Service après-vente local</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                                <span>Prix compétitifs et transparents</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">
                            <i class="fas fa-tags text-blue-600 mr-2"></i>
                            Types d'ordinateurs disponibles
                        </h3>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="fas fa-circle text-blue-500 mr-3 mt-2"></i>
                                <span>Ordinateurs portables (laptops)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-circle text-blue-500 mr-3 mt-2"></i>
                                <span>Ordinateurs de bureau (desktop)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-circle text-blue-500 mr-3 mt-2"></i>
                                <span>Ordinateurs gaming</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-circle text-blue-500 mr-3 mt-2"></i>
                                <span>Ordinateurs professionnels</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-circle text-blue-500 mr-3 mt-2"></i>
                                <span>Ordinateurs pour étudiants</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    Nos Ordinateurs
                </h2>
                <p class="text-gray-600">
                    {{ $ordinateurs->total() }} ordinateurs disponibles
                </p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-th-large mr-2"></i>
                    Voir tous les produits
                </a>
            </div>
        </div>

        @if($ordinateurs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($ordinateurs as $product)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 product-card">
                        <div class="relative">
                            @if($product->getFirstMediaUrl('images'))
                                <img src="{{ $product->getFirstMediaUrl('images') }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-laptop text-4xl text-gray-400"></i>
                                </div>
                            @endif

                            <!-- Favorite Button -->
                            <button class="absolute top-4 right-4 bg-white rounded-full p-2 shadow-lg hover:bg-red-50 transition-colors favorite-btn"
                                    data-product-id="{{ $product->id }}">
                                <i class="fas fa-heart text-gray-400 hover:text-red-500 transition-colors"></i>
                            </button>
                        </div>

                        <div class="p-6">
                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                {{ $product->description }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-blue-600">
                                    {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                </span>
                                <a href="{{ route('products.show', $product) }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                                    <i class="fas fa-eye mr-2"></i>
                                    Voir
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $ordinateurs->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-laptop text-6xl text-gray-400 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun ordinateur disponible</h3>
                <p class="text-gray-600 mb-8">
                    Nous mettons à jour notre catalogue d'ordinateurs.
                    Contactez-nous pour des demandes spécifiques.
                </p>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                    <i class="fas fa-phone mr-2"></i>
                    Nous contacter
                </a>
            </div>
        @endif
    </div>
</section>

<!-- SEO Footer Content -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">
                    Ordinateurs au Sénégal - ADI Technologies
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p class="mb-4">
                        <strong>ADI Technologies</strong> est votre spécialiste des ordinateurs au Sénégal.
                        Nous proposons une large gamme d'ordinateurs portables et de bureau des meilleures marques :
                        HP, Dell, Lenovo, Asus et bien d'autres.
                    </p>
                    <p class="mb-4">
                        Nos ordinateurs sont garantis constructeur et bénéficient de notre service après-vente local.
                        Nous proposons également des configurations sur mesure selon vos besoins spécifiques.
                    </p>
                    <p class="mb-4">
                        Que vous cherchiez un ordinateur portable pour vos études, un ordinateur de bureau pour votre entreprise,
                        ou un ordinateur gaming pour vos loisirs, ADI Technologies a la solution qu'il vous faut.
                    </p>
                    <p>
                        Contactez-nous au <strong>+221 78 630 95 81</strong> pour toute question sur nos ordinateurs
                        ou visitez notre boutique à Dakar, Medina Rue 15 angle Blaise Diagne.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WhatsApp Button -->
@include('components.whatsapp-float')
@endsection
