@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Mon Profil</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Informations du profil -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations personnelles</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                        <p class="mt-1 text-sm text-gray-900">{{ auth()->user()->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ auth()->user()->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Membre depuis</label>
                        <p class="mt-1 text-sm text-gray-900">{{ auth()->user()->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Actions rapides</h2>
                
                <div class="space-y-3">
                    <a href="{{ route('favorites.index') }}" class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <h3 class="font-medium text-gray-900">Mes Favoris</h3>
                        <p class="text-sm text-gray-500">Voir vos produits favoris</p>
                    </a>
                    
                    <a href="{{ route('cart.index') }}" class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <h3 class="font-medium text-gray-900">Mon Panier</h3>
                        <p class="text-sm text-gray-500">Gérer votre panier</p>
                    </a>
                    
                    <a href="{{ route('orders.index') }}" class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <h3 class="font-medium text-gray-900">Mes Commandes</h3>
                        <p class="text-sm text-gray-500">Voir vos commandes</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex justify-center">
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                    Se déconnecter
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 