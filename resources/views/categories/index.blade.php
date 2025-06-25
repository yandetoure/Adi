@extends('layouts.app')

@section('title', 'Catégories - ADI Store')
@section('meta_description', 'Parcourez nos catégories de produits. Trouvez facilement ce que vous cherchez.')
@section('meta_keywords', 'catégories, produits, ADI Store, organisation')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Nos Catégories</h1>
            <p class="text-xl text-blue-100">Parcourez nos produits par catégorie</p>
        </div>
    </div>
</section>

<!-- Categories Grid -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($categories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="group">
                        <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1">
                            <!-- Category Icon -->
                            <div class="w-20 h-20 mx-auto mb-6 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                                @if($category->image)
                                    <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-12 h-12 object-cover rounded-full">
                                @else
                                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                @endif
                            </div>
                            
                            <!-- Category Info -->
                            <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-200">
                                {{ $category->name }}
                            </h3>
                            
                            @if($category->description)
                                <p class="text-gray-600 mb-4 line-clamp-2">
                                    {{ Str::limit($category->description, 100) }}
                                </p>
                            @endif
                            
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                                <span>{{ $category->products_count }} produits</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune catégorie disponible</h3>
                <p class="mt-1 text-sm text-gray-500">Les catégories seront bientôt disponibles.</p>
            </div>
        @endif
    </div>
</section>
@endsection 