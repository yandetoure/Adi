@extends('layouts.app')

@section('title', 'Centre d\'aide - ADI Informatique')
@section('meta_description', 'Centre d\'aide ADI Informatique - Trouvez rapidement les réponses à vos questions')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header moderne -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-question-circle text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Centre d'aide</h1>
                        <p class="text-gray-600">Trouvez rapidement les réponses à vos questions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Barre de recherche -->
        <div class="mb-8">
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <input type="text" placeholder="Rechercher dans l'aide..." 
                           class="w-full px-6 py-4 pl-12 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Catégories principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <!-- Comment commander -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('help.how-to-order') }}'">
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Comment commander</h3>
                            <p class="text-sm text-gray-600">Guide étape par étape</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Apprenez à passer une commande en quelques étapes simples</p>
                </div>
            </div>

            <!-- Suivre ma commande -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('help.track-order') }}'">
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-truck text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Suivre ma commande</h3>
                            <p class="text-sm text-gray-600">Localiser votre colis</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Suivez l'état de votre commande en temps réel</p>
                </div>
            </div>

            <!-- Support client -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('help.customer-support') }}'">
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-headset text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Support client</h3>
                            <p class="text-sm text-gray-600">Contactez-nous</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Notre équipe est là pour vous aider</p>
                </div>
            </div>

            <!-- FAQ -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('help.faq') }}'">
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-question text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">FAQ</h3>
                            <p class="text-sm text-gray-600">Questions fréquentes</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Trouvez rapidement les réponses aux questions courantes</p>
                </div>
            </div>

            <!-- Livraison -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('help.shipping') }}'">
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-shipping-fast text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Livraison</h3>
                            <p class="text-sm text-gray-600">Options et délais</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Informations sur les options de livraison disponibles</p>
                </div>
            </div>

            <!-- Modes de paiement -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('help.payment-methods') }}'">
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-credit-card text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Modes de paiement</h3>
                            <p class="text-sm text-gray-600">Comptant, livraison, Wave</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Options de paiement sécurisées disponibles</p>
                </div>
            </div>

            <!-- Retours -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 cursor-pointer" onclick="window.location.href='{{ route('help.returns') }}'">
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-undo text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Retours</h3>
                            <p class="text-sm text-gray-600">Politique de retour</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">Comment retourner un produit et obtenir un remboursement</p>
                </div>
            </div>
        </div>

        <!-- Section contact rapide -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Besoin d'aide supplémentaire ?</h2>
                <p class="text-gray-600 mb-6">Notre équipe support est disponible pour vous aider</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="https://wa.me/221786309581" target="_blank" class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 transform hover:scale-105">
                        <i class="fab fa-whatsapp mr-2"></i>
                        WhatsApp
                    </a>
                    <a href="tel:+221786309581" class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 transform hover:scale-105">
                        <i class="fas fa-phone mr-2"></i>
                        Appeler
                    </a>
                    <a href="mailto:contact@aditechnologie.com" class="inline-flex items-center px-6 py-3 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition duration-200 transform hover:scale-105">
                        <i class="fas fa-envelope mr-2"></i>
                        Email
                    </a>
                </div>
            </div>
        </div>
    </div>
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