@extends('layouts.app')

@section('title', 'Modes de paiement - Centre d\'aide ADI Informatique')
@section('meta_description', 'Modes de paiement ADI Informatique - Comptant, paiement à la livraison, Wave et plus')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header moderne -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-credit-card text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Modes de paiement</h1>
                        <p class="text-gray-600">Options de paiement sécurisées</p>
                    </div>
                </div>
                <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à l'aide
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Modes de paiement disponibles -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Paiement à la livraison -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-truck text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Paiement à la livraison</h3>
                    <p class="text-gray-600 text-sm">Payez quand vous recevez</p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="text-gray-700">Espèces acceptées</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="text-gray-700">Cartes bancaires</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="text-gray-700">Mobile Money</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">Frais supplémentaires : 1 000 FCFA</p>
                    </div>
                </div>
            </div>

            <!-- Wave -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Wave</h3>
                    <p class="text-gray-600 text-sm">Paiement mobile sécurisé</p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="text-gray-700">Paiement instantané</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="text-gray-700">Sécurisé et fiable</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="text-gray-700">Reçu par SMS</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">Aucun frais supplémentaire</p>
                    </div>
                </div>
            </div>

            <!-- Comptant -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-money-bill-wave text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Paiement comptant</h3>
                    <p class="text-gray-600 text-sm">Paiement en magasin</p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="text-gray-700">Espèces</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="text-gray-700">Cartes bancaires</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="text-gray-700">Chèques</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">Aucun frais supplémentaire</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sécurité des paiements -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Sécurité des paiements</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Protection des données</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-shield-alt text-blue-600 mt-1"></i>
                            <div>
                                <div class="font-medium text-gray-900">Chiffrement SSL</div>
                                <div class="text-sm text-gray-600">Toutes les transactions sont cryptées</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-lock text-green-600 mt-1"></i>
                            <div>
                                <div class="font-medium text-gray-900">Données sécurisées</div>
                                <div class="text-sm text-gray-600">Aucune information bancaire stockée</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-certificate text-purple-600 mt-1"></i>
                            <div>
                                <div class="font-medium text-gray-900">Certification PCI</div>
                                <div class="text-sm text-gray-600">Conformité aux standards de sécurité</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Garanties</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-undo text-orange-600 mt-1"></i>
                            <div>
                                <div class="font-medium text-gray-900">Remboursement garanti</div>
                                <div class="text-sm text-gray-600">En cas de problème de paiement</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-headset text-blue-600 mt-1"></i>
                            <div>
                                <div class="font-medium text-gray-900">Support 24/7</div>
                                <div class="text-sm text-gray-600">Assistance en cas de problème</div>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-receipt text-green-600 mt-1"></i>
                            <div>
                                <div class="font-medium text-gray-900">Reçu électronique</div>
                                <div class="text-sm text-gray-600">Preuve de paiement immédiate</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Processus de paiement -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Processus de paiement</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Paiement en ligne</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-700">
                        <li>Sélectionnez vos produits</li>
                        <li>Allez au panier</li>
                        <li>Choisissez votre mode de paiement</li>
                        <li>Remplissez les informations requises</li>
                        <li>Confirmez votre paiement</li>
                        <li>Recevez une confirmation</li>
                    </ol>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Paiement à la livraison</h3>
                    <ol class="list-decimal list-inside space-y-3 text-gray-700">
                        <li>Passez votre commande</li>
                        <li>Sélectionnez "Paiement à la livraison"</li>
                        <li>Préparez le montant exact</li>
                        <li>Vérifiez le produit à la livraison</li>
                        <li>Payez le livreur</li>
                        <li>Recevez votre reçu</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Informations importantes -->
        <div class="bg-gradient-to-r from-yellow-500 to-orange-600 rounded-2xl p-8 mb-8">
            <h2 class="text-2xl font-bold text-white mb-6">Informations importantes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-exclamation-triangle text-yellow-300 mt-1"></i>
                        <div>
                            <div class="font-semibold text-white">Paiement à la livraison</div>
                            <div class="text-yellow-100 text-sm">Préparez le montant exact, le livreur ne peut pas faire de monnaie</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-clock text-yellow-300 mt-1"></i>
                        <div>
                            <div class="font-semibold text-white">Confirmation</div>
                            <div class="text-yellow-100 text-sm">Vous recevrez une confirmation par SMS/email</div>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-shield-alt text-yellow-300 mt-1"></i>
                        <div>
                            <div class="font-semibold text-white">Sécurité</div>
                            <div class="text-yellow-100 text-sm">Ne partagez jamais vos codes de paiement</div>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-phone text-yellow-300 mt-1"></i>
                        <div>
                            <div class="font-semibold text-white">Support</div>
                            <div class="text-yellow-100 text-sm">Contactez-nous en cas de problème</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact support -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-8 text-white">
            <h2 class="text-2xl font-bold mb-4">Questions sur les paiements ?</h2>
            <p class="text-green-100 mb-6">Notre équipe est là pour vous aider</p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="https://wa.me/221786309581" target="_blank" class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 transform hover:scale-105">
                    <i class="fab fa-whatsapp mr-2"></i>
                    WhatsApp
                </a>
                <a href="tel:+221786309581" class="inline-flex items-center px-6 py-3 bg-white text-green-600 rounded-lg hover:bg-gray-100 transition duration-200 transform hover:scale-105">
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