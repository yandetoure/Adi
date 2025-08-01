@extends('layouts.app')

@section('title', 'Support client - Centre d\'aide ADI Informatique')
@section('meta_description', 'Contactez notre équipe support ADI Informatique - Nous sommes là pour vous aider')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header moderne -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-headset text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Support client</h1>
                        <p class="text-gray-600">Notre équipe est là pour vous aider</p>
                    </div>
                </div>
                <a href="{{ route('help.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à l'aide
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Méthodes de contact -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- WhatsApp -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fab fa-whatsapp text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">WhatsApp</h3>
                <p class="text-gray-600 mb-6">Contactez-nous directement sur WhatsApp pour une réponse rapide</p>
                <div class="space-y-3">
                    <a href="https://wa.me/221786309581" target="_blank" class="block w-full bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-600 transition duration-200 transform hover:scale-105">
                        <i class="fab fa-whatsapp mr-2"></i>
                        +221 78 630 95 81
                    </a>
                    <a href="https://wa.me/221770456425" target="_blank" class="block w-full bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-600 transition duration-200 transform hover:scale-105">
                        <i class="fab fa-whatsapp mr-2"></i>
                        +221 77 045 64 25
                    </a>
                </div>
            </div>

            <!-- Téléphone -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-phone text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Téléphone</h3>
                <p class="text-gray-600 mb-6">Appelez-nous directement pour parler à un conseiller</p>
                <div class="space-y-3">
                    <a href="tel:+221786309581" class="block w-full bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-200 transform hover:scale-105">
                        <i class="fas fa-phone mr-2"></i>
                        +221 78 630 95 81
                    </a>
                    <a href="tel:+221770456425" class="block w-full bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-200 transform hover:scale-105">
                        <i class="fas fa-phone mr-2"></i>
                        +221 77 045 64 25
                    </a>
                </div>
            </div>

            <!-- Email -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-envelope text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Email</h3>
                <p class="text-gray-600 mb-6">Envoyez-nous un email pour des questions détaillées</p>
                <a href="mailto:contact@aditechnologie.com" class="block w-full bg-purple-500 text-white py-3 px-6 rounded-lg hover:bg-purple-600 transition duration-200 transform hover:scale-105">
                    <i class="fas fa-envelope mr-2"></i>
                    contact@aditechnologie.com
                </a>
            </div>
        </div>

        <!-- Horaires et informations -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Horaires d'ouverture -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Horaires d'ouverture</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-blue-600 mr-3"></i>
                            <span class="font-medium">Lundi - Vendredi</span>
                        </div>
                        <span class="text-green-600 font-semibold">8h00 - 18h00</span>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-blue-600 mr-3"></i>
                            <span class="font-medium">Samedi</span>
                        </div>
                        <span class="text-green-600 font-semibold">9h00 - 16h00</span>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-red-600 mr-3"></i>
                            <span class="font-medium">Dimanche</span>
                        </div>
                        <span class="text-red-600 font-semibold">Fermé</span>
                    </div>
                </div>
            </div>

            <!-- Informations de contact -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Informations de contact</h2>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt text-red-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900">Adresse</h4>
                            <p class="text-gray-600">Dakar, Sénégal</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-clock text-blue-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900">Temps de réponse</h4>
                            <p class="text-gray-600">WhatsApp : Immédiat<br>Email : 24h maximum</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-globe text-green-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900">Langues</h4>
                            <p class="text-gray-600">Français, Wolof, Anglais</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ rapide -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Questions fréquentes</h2>
            <div class="space-y-4">
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Comment puis-je suivre ma commande ?</h3>
                    <p class="text-gray-600">Connectez-vous à votre compte et allez dans "Mes Commandes" pour suivre l'état de votre commande en temps réel.</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Quels sont les délais de livraison ?</h3>
                    <p class="text-gray-600">Les délais varient selon votre localisation : Dakar (24-48h), autres villes (2-5 jours), zones rurales (3-7 jours).</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Comment retourner un produit ?</h3>
                    <p class="text-gray-600">Vous avez 14 jours pour retourner un produit. Contactez-nous pour initier le processus de retour.</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Quels sont les moyens de paiement acceptés ?</h3>
                    <p class="text-gray-600">Nous acceptons les cartes bancaires, Orange Money, Wave, et les paiements en espèces à la livraison.</p>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Actions rapides</h2>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('help.faq') }}" class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 transform hover:scale-105">
                    <i class="fas fa-question-circle mr-2"></i>
                    Voir la FAQ complète
                </a>
                <a href="{{ route('help.how-to-order') }}" class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 transform hover:scale-105">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Comment commander
                </a>
                <a href="{{ route('help.track-order') }}" class="inline-flex items-center px-6 py-3 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition duration-200 transform hover:scale-105">
                    <i class="fas fa-truck mr-2"></i>
                    Suivre ma commande
                </a>
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
    
    .hover\:scale-105:hover {
        transform: scale(1.05);
    }
</style>
@endsection 