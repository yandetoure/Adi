@extends('layouts.app')

@section('title', 'Livraison - Centre d\'aide ADI Informatique')
@section('meta_description', 'Informations sur les options de livraison ADI Informatique - Délais et zones de livraison')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header moderne -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shipping-fast text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Livraison</h1>
                        <p class="text-gray-600">Options et délais de livraison</p>
                    </div>
                </div>
                <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à l'aide
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Options de livraison -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Livraison à domicile -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-home text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Livraison à domicile</h3>
                    <p class="text-gray-600 text-sm">Livraison directe chez vous</p>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Dakar</span>
                        <span class="text-green-600 font-semibold">24-48h</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Autres villes</span>
                        <span class="text-blue-600 font-semibold">2-5 jours</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Zones rurales</span>
                        <span class="text-orange-600 font-semibold">3-7 jours</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">Livraison gratuite à partir de 50 000 FCFA</p>
                    </div>
                </div>
            </div>

            <!-- Point relais -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-store text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Point relais</h3>
                    <p class="text-gray-600 text-sm">Retrait en point relais</p>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Dakar</span>
                        <span class="text-green-600 font-semibold">24h</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Autres villes</span>
                        <span class="text-blue-600 font-semibold">1-3 jours</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">Frais de livraison : 1 500 FCFA</p>
                        <p class="text-sm text-gray-600">Garde gratuite 7 jours</p>
                    </div>
                </div>
            </div>

            <!-- Bureau -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Livraison bureau</h3>
                    <p class="text-gray-600 text-sm">Livraison à votre bureau</p>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Dakar</span>
                        <span class="text-green-600 font-semibold">24-48h</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Autres villes</span>
                        <span class="text-blue-600 font-semibold">2-5 jours</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">Frais de livraison : 2 000 FCFA</p>
                        <p class="text-sm text-gray-600">Horaires de livraison : 8h-18h</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Zones de livraison -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Zones de livraison</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Zones couvertes</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Tout le Sénégal</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Dakar et banlieue</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Villes principales</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span class="text-gray-700">Zones rurales</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations importantes</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-clock text-blue-600 mt-1"></i>
                            <div>
                                <div class="font-medium text-gray-900">Horaires de livraison</div>
                                <div class="text-sm text-gray-600">Lundi-Samedi : 8h-18h</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-phone text-green-600 mt-1"></i>
                            <div>
                                <div class="font-medium text-gray-900">Contact livraison</div>
                                <div class="text-sm text-gray-600">+221 78 630 95 81</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-exclamation-triangle text-orange-600 mt-1"></i>
                            <div>
                                <div class="font-medium text-gray-900">Préparation</div>
                                <div class="text-sm text-gray-600">Préparer une pièce d'identité</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Suivi de livraison -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Suivi de votre livraison</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Comment suivre votre commande</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-700">
                        <li>Connectez-vous à votre compte</li>
                        <li>Allez dans "Mes Commandes"</li>
                        <li>Trouvez votre commande</li>
                        <li>Cliquez sur "Suivre la livraison"</li>
                        <li>Recevez des SMS de mise à jour</li>
                    </ol>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Notifications</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg">
                            <i class="fas fa-sms text-blue-600"></i>
                            <div>
                                <div class="font-medium text-gray-900">SMS de confirmation</div>
                                <div class="text-sm text-gray-600">Quand votre colis est en route</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                            <i class="fas fa-phone text-green-600"></i>
                            <div>
                                <div class="font-medium text-gray-900">Appel du livreur</div>
                                <div class="text-sm text-gray-600">30 minutes avant la livraison</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                            <i class="fas fa-envelope text-purple-600"></i>
                            <div>
                                <div class="font-medium text-gray-900">Email de suivi</div>
                                <div class="text-sm text-gray-600">Mises à jour par email</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact support -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl p-8 text-white">
            <h2 class="text-2xl font-bold mb-4">Questions sur la livraison ?</h2>
            <p class="text-blue-100 mb-6">Notre équipe logistique est là pour vous aider</p>
            
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