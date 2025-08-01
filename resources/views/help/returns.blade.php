@extends('layouts.app')

@section('title', 'Retours - Centre d\'aide ADI Informatique')
@section('meta_description', 'Politique de retour ADI Informatique - Comment retourner un produit et obtenir un remboursement')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header moderne -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-undo text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Retours</h1>
                        <p class="text-gray-600">Politique de retour et remboursement</p>
                    </div>
                </div>
                <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à l'aide
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Conditions de retour -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Conditions de retour</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Produits éligibles</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Produits non utilisés</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Emballage d'origine intact</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Accessoires inclus</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Facture de vente</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Produits non éligibles</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-times-circle text-red-600"></i>
                            <span class="text-gray-700">Produits personnalisés</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-times-circle text-red-600"></i>
                            <span class="text-gray-700">Produits endommagés</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-times-circle text-red-600"></i>
                            <span class="text-gray-700">Logiciels ouverts</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-times-circle text-red-600"></i>
                            <span class="text-gray-700">Produits de sécurité</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Délais et processus -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Délais de retour -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Délais de retour</h2>
                <div class="space-y-6">
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-calendar-check text-green-600"></i>
                            <div>
                                <div class="font-semibold text-gray-900">Délai standard</div>
                                <div class="text-sm text-gray-600">14 jours après réception</div>
                            </div>
                        </div>
                        <span class="text-green-600 font-bold">14 jours</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-exclamation-triangle text-blue-600"></i>
                            <div>
                                <div class="font-semibold text-gray-900">Délai étendu</div>
                                <div class="text-sm text-gray-600">Produits défectueux</div>
                            </div>
                        </div>
                        <span class="text-blue-600 font-bold">30 jours</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-clock text-orange-600"></i>
                            <div>
                                <div class="font-semibold text-gray-900">Traitement</div>
                                <div class="text-sm text-gray-600">Après réception du retour</div>
                            </div>
                        </div>
                        <span class="text-orange-600 font-bold">3-5 jours</span>
                    </div>
                </div>
            </div>

            <!-- Processus de retour -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Processus de retour</h2>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm">1</div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Contactez-nous</h3>
                            <p class="text-gray-600 text-sm">Appelez ou WhatsApp pour initier le retour</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-sm">2</div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Préparez le colis</h3>
                            <p class="text-gray-600 text-sm">Remettez le produit dans son emballage d'origine</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-sm">3</div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Livraison retour</h3>
                            <p class="text-gray-600 text-sm">Nous récupérons le produit à votre adresse</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-sm">4</div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Remboursement</h3>
                            <p class="text-gray-600 text-sm">Remboursement sous 3-5 jours ouvrables</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Options de remboursement -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Options de remboursement</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Remboursement complet -->
                <div class="text-center p-6 bg-green-50 rounded-xl">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-money-bill-wave text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Remboursement complet</h3>
                    <p class="text-gray-600 text-sm mb-4">Produit non utilisé dans son emballage d'origine</p>
                    <div class="text-green-600 font-bold">100% du montant</div>
                </div>

                <!-- Échange -->
                <div class="text-center p-6 bg-blue-50 rounded-xl">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exchange-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Échange</h3>
                    <p class="text-gray-600 text-sm mb-4">Échange contre un autre produit de même valeur</p>
                    <div class="text-blue-600 font-bold">Valeur équivalente</div>
                </div>

                <!-- Crédit boutique -->
                <div class="text-center p-6 bg-purple-50 rounded-xl">
                    <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-gift text-white text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Crédit boutique</h3>
                    <p class="text-gray-600 text-sm mb-4">Crédit pour vos prochains achats</p>
                    <div class="text-purple-600 font-bold">+10% de bonus</div>
                </div>
            </div>
        </div>

        <!-- Frais de retour -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Frais de retour</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Retours gratuits</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Produits défectueux</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Erreur de notre part</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Produit non conforme</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Frais applicables</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-700">Retour standard</span>
                            <span class="text-red-600 font-semibold">2 000 FCFA</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-700">Récupération express</span>
                            <span class="text-red-600 font-semibold">3 500 FCFA</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-700">Zones éloignées</span>
                            <span class="text-red-600 font-semibold">5 000 FCFA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact support -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-8 text-white">
            <h2 class="text-2xl font-bold mb-4">Initier un retour</h2>
            <p class="text-red-100 mb-6">Contactez-nous pour commencer le processus de retour</p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="https://wa.me/221786309581" target="_blank" class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 transform hover:scale-105">
                    <i class="fab fa-whatsapp mr-2"></i>
                    WhatsApp
                </a>
                <a href="tel:+221786309581" class="inline-flex items-center px-6 py-3 bg-white text-red-600 rounded-lg hover:bg-gray-100 transition duration-200 transform hover:scale-105">
                    <i class="fas fa-phone mr-2"></i>
                    Appeler
                </a>
                <a href="{{ route('help.customer-support') }}" class="inline-flex items-center px-6 py-3 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition duration-200 transform hover:scale-105">
                    <i class="fas fa-headset mr-2"></i>
                    Support en ligne
                </a>
            </div>
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