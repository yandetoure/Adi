@extends('layouts.app')

@section('title', 'Comment commander - Centre d\'aide ADI Informatique')
@section('meta_description', 'Guide étape par étape pour passer une commande sur ADI Informatique')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header moderne -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Comment commander</h1>
                        <p class="text-gray-600">Guide étape par étape pour passer une commande</p>
                    </div>
                </div>
                <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à l'aide
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Étapes de commande -->
        <div class="space-y-8">
            <!-- Étape 1 -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="flex items-start space-x-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        1
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Parcourir nos produits</h3>
                        <p class="text-gray-600 mb-4">
                            Explorez notre catalogue de produits informatiques. Vous pouvez :
                        </p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                            <li>Utiliser la barre de recherche pour trouver un produit spécifique</li>
                            <li>Parcourir les catégories (Ordinateurs, Accessoires, etc.)</li>
                            <li>Filtrer par prix, marque ou disponibilité</li>
                            <li>Ajouter des produits à vos favoris pour plus tard</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Étape 2 -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="flex items-start space-x-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        2
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Ajouter au panier</h3>
                        <p class="text-gray-600 mb-4">
                            Une fois que vous avez trouvé le produit souhaité :
                        </p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                            <li>Cliquez sur "Ajouter au panier" sur la page du produit</li>
                            <li>Vérifiez la quantité souhaitée</li>
                            <li>Le produit apparaîtra dans votre panier en haut à droite</li>
                            <li>Vous pouvez continuer vos achats ou aller au panier</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Étape 3 -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="flex items-start space-x-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        3
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Finaliser votre panier</h3>
                        <p class="text-gray-600 mb-4">
                            Dans votre panier, vous pouvez :
                        </p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                            <li>Modifier les quantités de chaque produit</li>
                            <li>Supprimer des produits que vous ne voulez plus</li>
                            <li>Vérifier le total de votre commande</li>
                            <li>Appliquer des codes promo si vous en avez</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Étape 4 -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="flex items-start space-x-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        4
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Passer la commande</h3>
                        <p class="text-gray-600 mb-4">
                            Cliquez sur "Commander" et suivez ces étapes :
                        </p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                            <li>Connectez-vous à votre compte ou créez-en un</li>
                            <li>Remplissez vos informations de livraison</li>
                            <li>Choisissez votre mode de paiement</li>
                            <li>Vérifiez une dernière fois votre commande</li>
                            <li>Confirmez votre commande</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Étape 5 -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="flex items-start space-x-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        5
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Suivre votre commande</h3>
                        <p class="text-gray-600 mb-4">
                            Après avoir passé votre commande :
                        </p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                            <li>Vous recevrez un email de confirmation</li>
                            <li>Vous pouvez suivre votre commande dans votre espace client</li>
                            <li>Nous vous tiendrons informé de l'état de votre commande</li>
                            <li>Vous recevrez un SMS quand votre colis sera en route</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conseils utiles -->
        <div class="mt-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl p-8 text-white">
            <h2 class="text-2xl font-bold mb-6">Conseils utiles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-check-circle text-green-300 mt-1"></i>
                    <div>
                        <h4 class="font-semibold mb-2">Vérifiez la disponibilité</h4>
                        <p class="text-blue-100 text-sm">Assurez-vous que le produit est en stock avant de commander</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-check-circle text-green-300 mt-1"></i>
                    <div>
                        <h4 class="font-semibold mb-2">Informations de livraison</h4>
                        <p class="text-blue-100 text-sm">Remplissez correctement votre adresse de livraison</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-check-circle text-green-300 mt-1"></i>
                    <div>
                        <h4 class="font-semibold mb-2">Paiement sécurisé</h4>
                        <p class="text-blue-100 text-sm">Tous nos paiements sont sécurisés et cryptés</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-check-circle text-green-300 mt-1"></i>
                    <div>
                        <h4 class="font-semibold mb-2">Support disponible</h4>
                        <p class="text-blue-100 text-sm">Notre équipe est là pour vous aider si besoin</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 transform hover:scale-105">
                <i class="fas fa-shopping-cart mr-2"></i>
                Commencer mes achats
            </a>
            <a href="{{ route('help.customer-support') }}" class="inline-flex items-center px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200 transform hover:scale-105">
                <i class="fas fa-headset mr-2"></i>
                Contacter le support
            </a>
        </div>
    </div>
</div>

<style>
    .transform {
        transition: transform 0.3s ease;
    }
    
    .hover\:scale-105:hover {
        transform: scale(1.05);
    }
</style>
@endsection 