@extends('layouts.app')

@section('title', 'Tableau de bord - Administration')
@section('meta_description', 'Tableau de bord administrateur ADI Informatique')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-100">
    <!-- Header moderne -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Dashboard Administration</h1>
                        <p class="text-gray-600">Gestion complète de la plateforme ADI Informatique</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-indigo-100 px-4 py-2 rounded-full">
                        <span class="text-sm font-medium text-indigo-800">
                            <i class="fas fa-user-shield mr-2"></i>Administrateur
                        </span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition duration-200 transform hover:scale-105">
                            <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section avec design moderne -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Products -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Total Produits</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['totalProducts'] }}</p>
                            <p class="text-xs text-green-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>Actifs
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-box text-white text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Categories -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Catégories</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['totalCategories'] }}</p>
                            <p class="text-xs text-blue-600 mt-1">
                                <i class="fas fa-tags mr-1"></i>Disponibles
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-tags text-white text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Orders -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Commandes</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['totalOrders'] }}</p>
                            <p class="text-xs text-purple-600 mt-1">
                                <i class="fas fa-shopping-cart mr-1"></i>Total
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-white text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Utilisateurs</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['totalUsers'] }}</p>
                            <p class="text-xs text-indigo-600 mt-1">
                                <i class="fas fa-users mr-1"></i>Inscrits
                            </p>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Actions rapides avec design moderne -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Actions rapides</h2>
                <p class="text-gray-600">Gérez votre plateforme en quelques clics</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Ajouter un produit -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('admin.products.create') }}'">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-plus text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Ajouter un produit</h3>
                            <p class="text-sm text-gray-600">Créer un nouveau produit</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <!-- Gérer les produits -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('admin.products.index') }}'">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-boxes text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Gérer les produits</h3>
                            <p class="text-sm text-gray-600">Voir et modifier les produits</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>

                <!-- Commandes -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('admin.orders.index') }}'">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Commandes</h3>
                            <p class="text-sm text-gray-600">Gérer les commandes clients</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 70%"></div>
                        </div>
                    </div>
                </div>

                <!-- Catégories -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('admin.categories.index') }}'">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-tags text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Catégories</h3>
                            <p class="text-sm text-gray-600">Organiser les produits</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-indigo-500 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                </div>

                <!-- Utilisateurs -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('admin.users.index') }}'">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Utilisateurs</h3>
                            <p class="text-sm text-gray-600">Gérer les comptes</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: 90%"></div>
                        </div>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('admin.products.index') }}'">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-pink-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-bar text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Statistiques</h3>
                            <p class="text-sm text-gray-600">Analyses détaillées</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-pink-500 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section récentes commandes -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Commandes récentes</h2>
                <p class="text-gray-600">Suivez les dernières commandes</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Dernières commandes</h3>
                        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Voir toutes <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                
                <div class="divide-y divide-gray-200">
                    @forelse($recentOrders ?? [] as $order)
                    <div class="px-6 py-4 hover:bg-gray-50 transition duration-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Commande #{{ $order->id }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->user->name ?? 'Client' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">{{ number_format($order->total, 0, ',', ' ') }} FCFA</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center">
                        <i class="fas fa-shopping-cart text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-500">Aucune commande récente</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Section produits populaires -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Produits populaires</h2>
                <p class="text-gray-600">Les produits les plus consultés</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($popularProducts ?? [] as $product)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-box text-white text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ Str::limit($product->name, 30) }}</h3>
                                <p class="text-sm text-gray-500">{{ $product->category->name ?? 'Catégorie' }}</p>
                                <p class="text-lg font-bold text-blue-600">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-8">
                    <i class="fas fa-box text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500">Aucun produit populaire</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section statistiques avancées -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Statistiques avancées</h2>
                <p class="text-gray-600">Analyses détaillées de la plateforme</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Chiffre d'affaires -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Chiffre d'affaires</p>
                            <p class="text-2xl font-bold">{{ number_format($stats['totalRevenue'] ?? 0, 0, ',', ' ') }} FCFA</p>
                        </div>
                        <i class="fas fa-chart-line text-3xl opacity-80"></i>
                    </div>
                </div>

                <!-- Commandes en attente -->
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">En attente</p>
                            <p class="text-2xl font-bold">{{ $stats['pendingOrders'] ?? 0 }}</p>
                        </div>
                        <i class="fas fa-clock text-3xl opacity-80"></i>
                    </div>
                </div>

                <!-- Nouveaux utilisateurs -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Nouveaux clients</p>
                            <p class="text-2xl font-bold">{{ $stats['newUsers'] ?? 0 }}</p>
                        </div>
                        <i class="fas fa-user-plus text-3xl opacity-80"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .hover\:shadow-xl:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .transform {
        transition: transform 0.3s ease;
    }
    
    .hover\:-translate-y-1:hover {
        transform: translateY(-4px);
    }
</style>
@endsection
