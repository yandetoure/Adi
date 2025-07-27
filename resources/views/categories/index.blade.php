@extends('layouts.app')

@section('title', 'Catégories - ADI Store')
@section('meta_description', 'Découvrez toutes nos catégories de produits informatiques')
@section('meta_keywords', 'catégories, produits informatiques, ADI Store')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Categories Header -->
    <div class="category-header relative bg-gradient-to-r from-blue-600 to-purple-700 text-white py-16 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-20"
             style="background-image: url('https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');">
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/80 to-purple-700/80"></div>

        <!-- Content -->
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">Nos Catégories</h1>
                <p class="text-lg md:text-xl opacity-90 hidden md:block">Découvrez notre gamme complète de produits informatiques</p>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($categories as $index => $category)
                @php
                    $backgroundImages = [
                        'https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1526738549149-8e07eca6c147?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                    ];

                    $icon = 'fas fa-laptop';
                    if (stripos($category->name, 'ordinateur') !== false || stripos($category->name, 'pc') !== false) {
                        $icon = 'fas fa-laptop';
                    } elseif (stripos($category->name, 'téléphone') !== false || stripos($category->name, 'smartphone') !== false || stripos($category->name, 'mobile') !== false) {
                        $icon = 'fas fa-mobile-alt';
                    } elseif (stripos($category->name, 'accessoire') !== false) {
                        $icon = 'fas fa-headphones';
                    } elseif (stripos($category->name, 'écran') !== false || stripos($category->name, 'moniteur') !== false) {
                        $icon = 'fas fa-desktop';
                    } elseif (stripos($category->name, 'stockage') !== false || stripos($category->name, 'disque') !== false) {
                        $icon = 'fas fa-hdd';
                    } elseif (stripos($category->name, 'réseau') !== false || stripos($category->name, 'wifi') !== false) {
                        $icon = 'fas fa-wifi';
                    } elseif (stripos($category->name, 'gaming') !== false || stripos($category->name, 'jeu') !== false) {
                        $icon = 'fas fa-gamepad';
                    } elseif (stripos($category->name, 'imprimante') !== false) {
                        $icon = 'fas fa-print';
                    }
                @endphp

                <div class="category-card bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <a href="{{ route('categories.show', $category) }}" class="block">
                        <div class="category-image-container relative h-48 overflow-hidden"
                             style="background-image: url('{{ $backgroundImages[$index % count($backgroundImages)] }}'); background-size: cover; background-position: center;">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/80 to-purple-600/80 opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="category-content relative z-10 p-6 text-center text-white h-full flex flex-col justify-center">
                                <div class="category-icon mb-4">
                                    <i class="{{ $icon }} text-4xl opacity-80"></i>
                                </div>
                                <h3 class="category-title text-xl font-bold mb-2">{{ $category->name }}</h3>
                                <p class="category-count text-sm opacity-90">{{ $category->products()->where('is_active', true)->count() }} produits</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .category-header {
        position: relative;
        background-attachment: fixed;
    }

    @media (max-width: 768px) {
        .category-header {
            background-attachment: scroll;
            padding: 2rem 0;
        }

        .category-header h1 {
            font-size: 1.875rem;
        }
    }

    .category-card {
        transition: all 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-5px);
    }

    .category-image-container {
        position: relative;
        overflow: hidden;
    }

    .category-content {
        transition: all 0.3s ease;
    }

    .category-card:hover .category-content {
        transform: scale(1.05);
    }
</style>
@endsection
