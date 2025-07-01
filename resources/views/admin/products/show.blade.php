@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Détails du Produit</h1>
                    <p class="text-gray-600">
                        @if(auth()->user()->hasRole('assistant'))
                            Assistant - Consultation du produit
                        @else
                            Administration - Détails du produit
                        @endif
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ auth()->user()->hasRole('assistant') ? route('assistant.products.index') : route('admin.products.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                        Retour à la liste
                    </a>
                    <a href="{{ auth()->user()->hasRole('assistant') ? route('assistant.products.edit', $product) : route('admin.products.edit', $product) }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-edit mr-2"></i>Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Images -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Images du produit</h2>
                @if($product->getMedia('images')->count() > 0)
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($product->getMedia('images') as $media)
                            <div class="relative">
                                <img src="{{ $media->getUrl() }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                        <i class="fas fa-image text-3xl text-gray-400"></i>
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations du produit</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $product->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">SKU</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $product->sku }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $product->category->name ?? 'Aucune catégorie' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Prix</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                        </p>
                        @if($product->discount_percentage > 0)
                            <p class="mt-1 text-sm text-red-600">
                                Réduction: -{{ $product->discount_percentage }}%
                            </p>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Stock</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $product->stock }} unités</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Statut</label>
                        <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description courte</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $product->short_description ?? 'Aucune description courte' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description complète</label>
                        <div class="mt-1 text-sm text-gray-900 prose max-w-none">
                            {!! $product->description ?? 'Aucune description' !!}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date de création</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $product->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dernière modification</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $product->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Information -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations SEO</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Titre SEO</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $product->meta_title ?? 'Non défini' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description SEO</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $product->meta_description ?? 'Non définie' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Mots-clés SEO</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $product->meta_keywords ?? 'Non définis' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 