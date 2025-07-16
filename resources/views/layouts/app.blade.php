<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-overlay { background-color: rgba(0, 0, 0, 0.5); }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .category-tab.active { border-bottom: 3px solid #3b82f6; color: #3b82f6; }
        .whatsapp-btn:hover { background-color: #25D366; color: white; }
        .cart-btn:hover { background-color: #3b82f6; color: white; }
        .nav-icon { transition: all 0.3s ease; }
        .nav-icon:hover { transform: scale(1.1); }

        /* Styles pour les favoris */
        .favorite-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255,255,255,0.95);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10;
            font-size: 1.2rem;
        }
        .favorite-btn:hover {
            background: #ef4444;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }
        .favorite-btn.favorited {
            background: #ef4444;
            color: white;
            animation: heartBeat 0.6s ease-in-out;
        }
        @keyframes heartBeat {
            0% { transform: scale(1); }
            14% { transform: scale(1.3); }
            28% { transform: scale(1); }
            42% { transform: scale(1.3); }
            70% { transform: scale(1); }
        }

        /* Styles pour les notifications */
        .notification {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            transform: translateX(100%);
        }
        .notification.show {
            transform: translateX(0);
        }
        .notification.success {
            background-color: #10b981;
            color: white;
        }
        .notification.error {
            background-color: #ef4444;
            color: white;
        }
        .notification.info {
            background-color: #3b82f6;
            color: white;
        }
    </style>
    <title>@yield('title', 'ADI - Votre boutique en ligne')</title>
    <meta name="description" content="@yield('meta_description', 'ADI, votre boutique en ligne de confiance pour tous vos besoins. Découvrez notre sélection de produits de qualité.')">
    <meta name="keywords" content="@yield('meta_keywords', 'ADI, boutique en ligne, e-commerce, produits')">
    <meta name="author" content="ADI Store">
    <meta name="robots" content="index, follow">
    <meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'ADI - Votre boutique en ligne')">
    <meta property="og:description" content="@yield('meta_description', 'ADI, votre boutique en ligne de confiance pour tous vos besoins.')">
    <meta property="og:image" content="@yield('og_image', asset('images/adi-logo.png'))">
    <meta property="og:site_name" content="ADI Store">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'ADI - Votre boutique en ligne')">
    <meta property="twitter:description" content="@yield('meta_description', 'ADI, votre boutique en ligne de confiance pour tous vos besoins.')">
    <meta property="twitter:image" content="@yield('og_image', asset('images/adi-logo.png'))">

    <!-- Additional SEO meta tags -->
    <meta name="theme-color" content="#2563eb">
    <meta name="msapplication-TileColor" content="#2563eb">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="ADI Store">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Structured Data -->
    @yield('structured_data')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div id="app">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="container mx-auto px-4 py-3">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <div>
                                <img src="{{ asset('images/logo.png') }}" alt="ADI Logo" class="h-10 mr-10">
                                <p class="text-xs text-gray-600">Informatique</p>
                            </div>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="hidden md:flex space-x-6">
                        <a href="{{ route('home') }}" class="text-gray-800 hover:text-blue-600 font-medium transition">Accueil</a>
                        <a href="{{ route('products.index') }}" class="text-gray-800 hover:text-blue-600 font-medium transition">Produits</a>
                        <a href="{{ route('categories.index') }}" class="text-gray-800 hover:text-blue-600 font-medium transition">Catégories</a>
                        <a href="#" class="text-gray-800 hover:text-blue-600 font-medium transition">Promotions</a>
                        <a href="#footer-contact" class="text-gray-800 hover:text-blue-600 font-medium transition">Contact</a>
                    </nav>

                    <!-- Search Bar -->
                    <form action="{{ route('products.index') }}" method="GET" class="hidden md:flex flex-1 max-w-md mx-8">
                        <div class="relative w-full">
                            <input type="text"
                                   name="search"
                                   placeholder="Rechercher un produit..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </form>

                    <!-- Right Icons -->
                    <div class="flex items-center space-x-6">
                        <!-- Help -->
                        <div class="relative group">
                            <a href="#" class="flex flex-col items-center text-gray-600 hover:text-blue-600 transition">
                                <i class="fas fa-question-circle text-xl mb-1 nav-icon"></i>
                                <span class="text-xs font-medium">Aide</span>
                            </a>
                            <!-- Help Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="py-2">
                                    <div class="px-4 py-2 border-b border-gray-100">
                                        <h4 class="font-semibold text-gray-900 text-sm">Centre d'aide</h4>
                                    </div>
                                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        <div class="flex items-center">
                                            <i class="fas fa-shopping-cart text-blue-600 mr-3"></i>
                                            <div>
                                                <div class="font-medium">Comment commander</div>
                                                <div class="text-xs text-gray-500">Guide étape par étape</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        <div class="flex items-center">
                                            <i class="fas fa-truck text-green-600 mr-3"></i>
                                            <div>
                                                <div class="font-medium">Suivre ma commande</div>
                                                <div class="text-xs text-gray-500">Localiser votre colis</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        <div class="flex items-center">
                                            <i class="fas fa-undo text-orange-600 mr-3"></i>
                                            <div>
                                                <div class="font-medium">Retours & Échanges</div>
                                                <div class="text-xs text-gray-500">Politique de retour</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        <div class="flex items-center">
                                            <i class="fas fa-credit-card text-purple-600 mr-3"></i>
                                            <div>
                                                <div class="font-medium">Modes de paiement</div>
                                                <div class="text-xs text-gray-500">Paiement sécurisé</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        <div class="flex items-center">
                                            <i class="fas fa-headset text-blue-600 mr-3"></i>
                                            <div>
                                                <div class="font-medium">Contact support</div>
                                                <div class="text-xs text-gray-500">Assistance 24/7</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Favorites -->
                        <a href="{{ route('favorites.index') }}" class="flex flex-col items-center text-gray-600 hover:text-red-500 transition group relative">
                            <i class="fas fa-heart text-xl mb-1 nav-icon"></i>
                            <span class="text-xs font-medium">Favoris</span>
                            @auth
                                @php
                                    $favoritesCount = auth()->user()->favorites()->count();
                                @endphp
                                @if($favoritesCount > 0)
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">{{ $favoritesCount }}</span>
                                @endif
                            @endauth
                        </a>

                        <!-- Cart -->
                        <div class="relative group">
                            <a href="{{ route('cart.index') }}" class="flex flex-col items-center text-gray-600 hover:text-blue-600 transition relative">
                                <i class="fas fa-shopping-cart text-xl mb-1 nav-icon"></i>
                                <span class="text-xs font-medium">Panier</span>
                                @auth
                                    @php
                                        $cartCount = auth()->user()->cartItems()->sum('quantity');
                                    @endphp
                                    @if($cartCount > 0)
                                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">{{ $cartCount }}</span>
                                    @endif
                                @else
                                    @if(session('cart_count', 0) > 0)
                                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">{{ session('cart_count', 0) }}</span>
                                    @endif
                                @endauth
                            </a>
                            <!-- Cart Dropdown Preview -->
                            @if(session('cart_count', 0) > 0)
                            <div class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="font-semibold text-gray-900">Votre panier</h4>
                                        <span class="text-sm text-gray-500">{{ session('cart_count', 0) }} article(s)</span>
                                    </div>
                                    <div class="space-y-2 mb-3">
                                        <!-- Cart items preview would go here -->
                                        <div class="text-sm text-gray-600">Produits dans votre panier</div>
                                    </div>
                                    <div class="border-t border-gray-100 pt-3">
                                        <a href="{{ route('cart.index') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg font-medium transition">
                                            Voir le panier
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- User Account -->
                        @guest
                            <a href="{{ route('login') }}" class="flex flex-col items-center text-gray-600 hover:text-blue-600 transition group">
                                <i class="fas fa-user-circle text-xl mb-1 nav-icon"></i>
                                <span class="text-xs font-medium">Connexion</span>
                            </a>
                        @else
                            <div class="relative group">
                                <a href="{{ route('profile') }}" class="flex flex-col items-center text-gray-600 hover:text-blue-600 transition">
                                    <i class="fas fa-user-circle text-xl mb-1 nav-icon"></i>
                                    <span class="text-xs font-medium">Mon Compte</span>
                                </a>
                                <!-- Dropdown Menu -->
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                    <div class="py-2">
                                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-user mr-2"></i> Mon Profil
                                        </a>
                                        <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-shopping-bag mr-2"></i> Mes Commandes
                                        </a>
                                        <a href="{{ route('favorites.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-heart mr-2"></i> Mes Favoris
                                        </a>
                                        @if(auth()->user()->hasRole(['admin', 'super-admin']))
                                            <hr class="my-1">
                                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-tachometer-alt mr-2"></i> Tableau de bord
                                            </a>
                                        @endif
                                        <hr class="my-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>

                    <!-- Mobile menu button -->
                    <button class="md:hidden text-gray-600 ml-4">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>

                <!-- Mobile Search Bar -->
                <form action="{{ route('products.index') }}" method="GET" class="flex md:hidden mt-3">
                    <div class="relative w-full">
                        <input type="text"
                               name="search"
                               placeholder="Rechercher un produit..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </form>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer id="footer-contact" class="bg-gray-900 text-white pt-12 pb-6">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/logo.png') }}" alt="ADI Logo" class="h-10 mr-3">
                            <span class="text-xl font-bold">ADI Informatique</span>
                        </div>
                        <p class="text-gray-400 mb-4">Votre fournisseur de matériel informatique et accessoires au Sénégal.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-4">Liens utiles</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Accueil</a></li>
                            <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white">Produits</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Promotions</a></li>
                            <li><a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-white">Catégories</a></li>
                            <li><a href="#footer-contact" class="text-gray-400 hover:text-white">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-4">Mon compte</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white">Connexion</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Créer un compte</a></li>
                            <li><a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-white">Mon panier</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-4">Contact</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li class="flex items-start"><i class="fas fa-map-marker-alt mt-1 mr-3"></i><span>Dakar, Sénégal</span></li>
                            <li class="flex items-center"><i class="fas fa-phone-alt mr-3"></i><span>+221 77 123 45 67</span></li>
                            <li class="flex items-center"><i class="fas fa-envelope mr-3"></i><span>contact@adi.sn</span></li>
                            <li class="flex items-center"><i class="fab fa-whatsapp mr-3"></i><span>+221 77 123 45 67</span></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2024 ADI Informatique. Tous droits réservés.</p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white text-sm">Mentions légales</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm">CGV</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm">Politique de confidentialité</a>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Scripts globaux pour les favoris -->
    <script>
        // Fonction pour gérer les favoris
        function toggleFavorite(productId, button) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const icon = button.querySelector('i');
            const isFavorited = button.classList.contains('favorited');

            fetch('/favorites/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.favorited) {
                        button.classList.add('favorited');
                        icon.style.color = 'white';
                        showNotification('Produit ajouté aux favoris !', 'success');
                    } else {
                        button.classList.remove('favorited');
                        icon.style.color = '';
                        showNotification('Produit retiré des favoris', 'info');
                    }
                } else {
                    showNotification('Erreur lors de la gestion des favoris', 'error');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showNotification('Erreur lors de la gestion des favoris', 'error');
            });
        }

        // Fonction pour vérifier l'état des favoris au chargement
        function checkFavoritesOnLoad() {
            const favoriteButtons = document.querySelectorAll('.favorite-btn');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            favoriteButtons.forEach(button => {
                const productId = button.getAttribute('data-product-id');

                fetch(`/favorites/check?product_id=${productId}`, {
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.favorited) {
                        button.classList.add('favorited');
                        const icon = button.querySelector('i');
                        icon.style.color = 'white';
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la vérification des favoris:', error);
                });
            });
        }

        // Vérifier les favoris au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            checkFavoritesOnLoad();
        });

        // Fonction pour afficher les notifications
        function showNotification(message, type = 'info') {
            // Créer l'élément de notification
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
                type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                'bg-blue-500 text-white'
            }`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-2"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            // Ajouter au DOM
            document.body.appendChild(notification);

            // Animer l'entrée
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Supprimer automatiquement après 3 secondes
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }, 3000);
        }
    </script>
</body>
</html>
