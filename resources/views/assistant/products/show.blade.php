@extends('layouts.app')

@section('title', 'Détails du Produit - Assistant')
@section('meta_description', 'Consultez les détails du produit')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50">
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Détails du Produit</h1>
                    <p class="text-gray-600 mt-1">Assistant - Consultation du produit</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('assistant.products.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 shadow-sm">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour à la liste
                    </a>
                    <a href="{{ route('assistant.products.edit', $product) }}"
                       class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Images -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-3 h-10 bg-gradient-to-b from-orange-400 to-red-500 rounded-full shadow-lg"></div>
                    <h2 class="text-xl font-bold text-gray-900">Images du produit</h2>
                </div>

                @if($product->getMedia('images')->count() > 0)
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($product->getMedia('images') as $media)
                            <div class="relative group">
                                <img src="{{ $media->getUrl() }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover rounded-xl border-2 border-gray-200 hover:border-emerald-300 transition-all duration-300">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 rounded-xl"></div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">Aucune image disponible</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-3 h-10 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full shadow-lg"></div>
                    <h2 class="text-xl font-bold text-gray-900">Informations du produit</h2>
                </div>

                <div class="space-y-6">
                    <div class="p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nom du produit</label>
                        <p class="text-lg font-semibold text-gray-900">{{ $product->name }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl border-2 border-cyan-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Catégorie</label>
                            <p class="text-sm text-gray-900">{{ $product->category->name ?? 'Aucune catégorie' }}</p>
                        </div>

                        <div class="p-4 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl border-2 border-cyan-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Prix</label>
                            <p class="text-lg font-bold text-emerald-600">
                                {{ number_format($product->price, 0, ',', ' ') }} FCFA
                            </p>
                        </div>

                        <div class="p-4 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl border-2 border-cyan-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Stock</label>
                            <p class="text-sm text-gray-900">{{ $product->stock_quantity }} unités</p>
                        </div>

                        <div class="p-4 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl border-2 border-cyan-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Statut</label>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full
                                {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Description courte</label>
                        <p class="text-sm text-gray-900">{{ $product->short_description ?? 'Aucune description courte' }}</p>
                    </div>

                    <div class="p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Description complète</label>
                        <div class="text-sm text-gray-900 prose max-w-none">
                            {!! $product->description ?? 'Aucune description' !!}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Date de création</label>
                            <p class="text-sm text-gray-900">{{ $product->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Dernière modification</label>
                            <p class="text-sm text-gray-900">{{ $product->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Information -->
        <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-3 h-10 bg-gradient-to-b from-purple-400 to-pink-500 rounded-full shadow-lg"></div>
                <h2 class="text-xl font-bold text-gray-900">Informations SEO</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border-2 border-purple-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Titre SEO</label>
                    <p class="text-sm text-gray-900">{{ $product->meta_title ?? 'Non défini' }}</p>
                </div>

                <div class="p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border-2 border-purple-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Description SEO</label>
                    <p class="text-sm text-gray-900">{{ $product->meta_description ?? 'Non définie' }}</p>
                </div>

                <div class="p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border-2 border-purple-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Mots-clés SEO</label>
                    <p class="text-sm text-gray-900">{{ $product->meta_keywords ?? 'Non définis' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
