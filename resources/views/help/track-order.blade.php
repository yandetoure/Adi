@extends('layouts.app')

@section('title', 'Suivre ma commande - Centre d\'aide ADI Informatique')
@section('meta_description', 'Comment suivre votre commande ADI Informatique - Localisez votre colis en temps réel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header moderne -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-truck text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Suivre ma commande</h1>
                        <p class="text-gray-600">Localisez votre colis en temps réel</p>
                    </div>
                </div>
                <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à l'aide
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Comment suivre sa commande -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Comment suivre votre commande</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Méthode 1 -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-user mr-3 text-blue-600"></i>
                        Via votre espace client
                    </h3>
                    <ol class="list-decimal list-inside space-y-2 text-gray-600">
                        <li>Connectez-vous à votre compte</li>
                        <li>Allez dans "Mes Commandes"</li>
                        <li>Trouvez votre commande dans la liste</li>
                        <li>Cliquez sur "Suivre la commande"</li>
                        <li>Consultez les détails de livraison</li>
                    </ol>
                </div>

                <!-- Méthode 2 -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-envelope mr-3 text-green-600"></i>
                        Via les emails de suivi
                    </h3>
                    <ol class="list-decimal list-inside space-y-2 text-gray-600">
                        <li>Vérifiez vos emails (spam inclus)</li>
                        <li>Ouvrez l'email de confirmation</li>
                        <li>Cliquez sur le lien de suivi</li>
                        <li>Consultez les mises à jour</li>
                        <li>Recevez des notifications SMS</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- États de commande -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">États de votre commande</h2>
            
            <div class="space-y-6">
                <!-- En attente -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-white text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">En attente</h3>
                        <p class="text-gray-600 text-sm">Votre commande a été reçue et est en cours de traitement</p>
                    </div>
                </div>

                <!-- En préparation -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-box text-white text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">En préparation</h3>
                        <p class="text-gray-600 text-sm">Votre commande est en cours de préparation dans nos entrepôts</p>
                    </div>
                </div>

                <!-- Expédiée -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-shipping-fast text-white text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">Expédiée</h3>
                        <p class="text-gray-600 text-sm">Votre commande a été expédiée et est en route vers vous</p>
                    </div>
                </div>

                <!-- En livraison -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-truck text-white text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">En livraison</h3>
                        <p class="text-gray-600 text-sm">Le livreur est en route vers votre adresse</p>
                    </div>
                </div>

                <!-- Livrée -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">Livrée</h3>
                        <p class="text-gray-600 text-sm">Votre commande a été livrée avec succès</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations de livraison -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Informations de livraison</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Délais de livraison -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Délais de livraison</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium">Dakar</span>
                            <span class="text-green-600 font-semibold">24-48h</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium">Autres villes</span>
                            <span class="text-blue-600 font-semibold">2-5 jours</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium">Zones rurales</span>
                            <span class="text-orange-600 font-semibold">3-7 jours</span>
                        </div>
                    </div>
                </div>

                <!-- Options de livraison -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Options de livraison</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg">
                            <i class="fas fa-home text-blue-600"></i>
                            <div>
                                <div class="font-medium">Livraison à domicile</div>
                                <div class="text-sm text-gray-600">Livraison directe chez vous</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                            <i class="fas fa-store text-green-600"></i>
                            <div>
                                <div class="font-medium">Point relais</div>
                                <div class="text-sm text-gray-600">Retrait en point relais</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                            <i class="fas fa-building text-purple-600"></i>
                            <div>
                                <div class="font-medium">Bureau</div>
                                <div class="text-sm text-gray-600">Livraison au bureau</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact support -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl p-8 text-white">
            <h2 class="text-2xl font-bold mb-4">Besoin d'aide ?</h2>
            <p class="text-blue-100 mb-6">Si vous avez des questions sur votre commande, notre équipe est là pour vous aider</p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="https://wa.me/221786309581" target="_blank" class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 transform hover:scale-105">
                    <i class="fab fa-whatsapp mr-2"></i>
                    WhatsApp
                </a>
                <a href="tel:+221786309581" class="inline-flex items-center px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition duration-200 transform hover:scale-105">
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