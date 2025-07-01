@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Détails de la Catégorie</h1>
                    <p class="text-gray-600">
                        @if(auth()->user()->hasRole('assistant'))
                            Assistant - Consultation de la catégorie
                        @else
                            Administration - Détails de la catégorie
                        @endif
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ auth()->user()->hasRole('assistant') ? route('assistant.categories.index') : route('admin.categories.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                        Retour à la liste
                    </a>
                    <a href="{{ auth()->user()->hasRole('assistant') ? route('assistant.categories.edit', $category) : route('admin.categories.edit', $category) }}" 
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
            <!-- Category Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations de la catégorie</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $category->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Slug</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $category->slug ?? 'Non défini' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1 text-sm text-gray-900">
                            {{ $category->description ?? 'Aucune description' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Statut</label>
                        <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date de création</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dernière modification</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $category->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Products in Category -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Produits dans cette catégorie</h2>
                
                @if($category->products->count() > 0)
                    <div class="space-y-3">
                        @foreach($category->products->take(10) as $product)
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                                                            @if($product->getFirstMediaUrl('images') && $product->getFirstMediaUrl('images') !== '')
                                        <img class="h-8 w-8 rounded object-cover" 
                                             src="{{ $product->getFirstMediaUrl('images') }}" 
                                             alt="{{ $product->name }}">
                                    @else
                                        <div class="h-8 w-8 rounded bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-image text-xs text-gray-400"></i>
                                        </div>
                                    @endif
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-500">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                    <a href="{{ auth()->user()->hasRole('assistant') ? route('assistant.products.show', $product) : route('admin.products.show', $product) }}" 
                                       class="text-blue-600 hover:text-blue-900 text-xs">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($category->products->count() > 10)
                            <div class="text-center pt-4">
                                <p class="text-sm text-gray-500">
                                    Et {{ $category->products->count() - 10 }} autres produits...
                                </p>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-box-open text-3xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500">Aucun produit dans cette catégorie</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 