@extends('layouts.app')

@section('title', 'Contact - ADI INFORMATIQUE | Dakar, Sénégal')
@section('meta_description', 'Contactez ADI INFORMATIQUE à Dakar. Papeterie, bureautique, informatique et fournitures scolaires. Téléphone: +221 78 630 95 81, +221 77 045 64 25. Adresse: Medina Rue 15 angle Blaise Diagne.')
@section('meta_keywords', 'contact ADI INFORMATIQUE, Dakar, Sénégal, papeterie, bureautique, informatique, fournitures scolaires, téléphone, adresse')

@section('content')
<!-- Page Header -->
<div class="page-header py-16">
    <div class="container mx-auto px-4">
        <div class="page-header-content text-center">
            <div class="page-header-card">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Contactez-nous</h1>
                <p class="text-xl text-white opacity-90">Nous sommes là pour vous accompagner dans tous vos projets</p>
            </div>
        </div>
    </div>
</div>

<!-- Contact Information Section -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Contact Details -->
            <div class="space-y-8">
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">ADI INFORMATIQUE</h2>
                    <p class="text-lg text-gray-600 mb-8">Votre partenaire de confiance pour tous vos besoins en informatique, papeterie et fournitures de bureau.</p>
                </div>

                <!-- Contact Cards -->
                <div class="space-y-6">
                    <!-- Address -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-600">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Adresse</h3>
                                <p class="text-gray-600">Medina Rue 15 angle Blaise Diagne<br>Dakar - Sénégal</p>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Numbers -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-phone-alt text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Téléphones</h3>
                                <div class="space-y-2">
                                    <p class="text-gray-600">
                                        <i class="fas fa-mobile-alt mr-2 text-green-500"></i>
                                        <a href="tel:+221786309581" class="hover:text-green-600 transition">+221 78 630 95 81</a>
                                    </p>
                                    <p class="text-gray-600">
                                        <i class="fas fa-mobile-alt mr-2 text-green-500"></i>
                                        <a href="tel:+221770456425" class="hover:text-green-600 transition">+221 77 045 64 25</a>
                                    </p>
                                    <p class="text-gray-600">
                                        <i class="fas fa-phone mr-2 text-blue-500"></i>
                                        <a href="tel:+221338217287" class="hover:text-blue-600 transition">33 821 72 87</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fab fa-whatsapp text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">WhatsApp</h3>
                                <div class="space-y-2">
                                    <a href="https://wa.me/221786309581" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                        <i class="fab fa-whatsapp mr-2"></i>
                                        +221 78 630 95 81
                                    </a>
                                    <a href="https://wa.me/221770456425" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition ml-2">
                                        <i class="fab fa-whatsapp mr-2"></i>
                                        +221 77 045 64 25
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-600">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-envelope text-red-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                                <a href="mailto:adinformatique88@gmail.com" class="text-gray-600 hover:text-red-600 transition">adinformatique88@gmail.com</a>
                            </div>
                        </div>
                    </div>

                    <!-- Services -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-600">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-cogs text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Nos Services</h3>
                                <div class="grid grid-cols-2 gap-2 text-sm text-gray-600">
                                    <span><i class="fas fa-check text-green-500 mr-1"></i>Papeterie</span>
                                    <span><i class="fas fa-check text-green-500 mr-1"></i>Bureautique</span>
                                    <span><i class="fas fa-check text-green-500 mr-1"></i>Informatique</span>
                                    <span><i class="fas fa-check text-green-500 mr-1"></i>Scolaire</span>
                                    <span><i class="fas fa-check text-green-500 mr-1"></i>Prestation de Services</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Envoyez-nous un message</h3>
                
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                            <input type="text" id="first_name" name="first_name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                            <input type="text" id="last_name" name="last_name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                        <input type="tel" id="phone" name="phone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
                        <select id="subject" name="subject" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Sélectionnez un sujet</option>
                            <option value="commande">Commande de produits</option>
                            <option value="devis">Demande de devis</option>
                            <option value="support">Support technique</option>
                            <option value="partnership">Partenariat</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Business Information Section -->
<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Informations de l'entreprise</h2>
            <p class="text-lg text-gray-600">ADI INFORMATIQUE - Votre partenaire de confiance depuis 2017</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Business Registration -->
            <div class="bg-gray-50 rounded-xl p-6 text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">NINE</h3>
                <p class="text-gray-600">006626777 2A2</p>
            </div>

            <!-- RC Number -->
            <div class="bg-gray-50 rounded-xl p-6 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-contract text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">RC</h3>
                <p class="text-gray-600">SN DKR-2017A30625</p>
            </div>

            <!-- Bank Accounts -->
            <div class="bg-gray-50 rounded-xl p-6 text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-university text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Comptes Bancaires</h3>
                <div class="text-sm text-gray-600 space-y-1">
                    <p><strong>BSIC:</strong> SN111 01007 00400088207 79</p>
                    <p><strong>Banque Islamique:</strong> 0790111725107416300235</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Social Media Section -->
<div class="py-16 bg-gray-900 text-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Suivez-nous sur les réseaux sociaux</h2>
            <p class="text-lg text-gray-300">Restez connectés avec ADI INFORMATIQUE</p>
        </div>

        <div class="flex justify-center space-x-8">
            <!-- Facebook -->
            <a href="https://www.facebook.com/share/1BAMFAU833/?mibextid=wwXIfr" target="_blank" 
               class="flex flex-col items-center p-6 bg-blue-600 rounded-xl hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                <i class="fab fa-facebook-f text-3xl mb-2"></i>
                <span class="font-semibold">Facebook</span>
            </a>

            <!-- WhatsApp -->
            <a href="https://wa.me/221786309581" target="_blank" 
               class="flex flex-col items-center p-6 bg-green-600 rounded-xl hover:bg-green-700 transition duration-300 transform hover:scale-105">
                <i class="fab fa-whatsapp text-3xl mb-2"></i>
                <span class="font-semibold">WhatsApp</span>
            </a>

            <!-- Instagram -->
            <a href="#" target="_blank" 
               class="flex flex-col items-center p-6 bg-pink-600 rounded-xl hover:bg-pink-700 transition duration-300 transform hover:scale-105">
                <i class="fab fa-instagram text-3xl mb-2"></i>
                <span class="font-semibold">Instagram</span>
            </a>

            <!-- LinkedIn -->
            <a href="#" target="_blank" 
               class="flex flex-col items-center p-6 bg-blue-700 rounded-xl hover:bg-blue-800 transition duration-300 transform hover:scale-105">
                <i class="fab fa-linkedin-in text-3xl mb-2"></i>
                <span class="font-semibold">LinkedIn</span>
            </a>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre localisation</h2>
            <p class="text-lg text-gray-600">Venez nous rendre visite à notre boutique</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="aspect-w-16 aspect-h-9">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.5!2d-17.4677!3d14.7167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTTCsDQzJzAwLjAiTiAxN8KwMjgnMDMuNyJX!5e0!3m2!1sfr!2ssn!4v1234567890"
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Adresse complète</h3>
                <p class="text-gray-600">Medina Rue 15 angle Blaise Diagne<br>Dakar - Sénégal</p>
            </div>
        </div>
    </div>
</div>



@endsection 