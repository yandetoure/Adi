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
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="images/logo.png" alt="ADI Logo" class="h-10 mr-3">
                    </a>
                    {{-- <span class="text-xl font-bold text-blue-600">ADI Informatique</span> --}}
                </div>
                <!-- Navigation Links -->
                <nav class="hidden md:flex space-x-8 ml-8">
                    <a href="{{ route('home') }}" class="text-gray-800 hover:text-blue-600 font-medium">Accueil</a>
                    <a href="{{ route('products.index') }}" class="text-gray-800 hover:text-blue-600 font-medium">Produits</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-800 hover:text-blue-600 font-medium">Catégories</a>
                </nav>
                <!-- Search Bar -->
                <form action="{{ route('products.index') }}" method="GET" class="hidden md:flex flex-1 mx-8 max-w-md">
                    <input type="text" name="search" placeholder="Rechercher un produit..." class="w-full px-4 py-2 rounded-l-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <!-- Icons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-blue-600 relative">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        @if(session('cart_count', 0) > 0)
                            <span class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ session('cart_count', 0) }}</span>
                        @endif
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">
                            <i class="fas fa-user text-lg"></i>
                        </a>
                    @else
                        <a href="{{ route('profile') }}" class="text-gray-600 hover:text-blue-600">
                            <i class="fas fa-user text-lg"></i>
                        </a>
                    @endguest
                </div>
                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-600 ml-4">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            <!-- Mobile Search Bar -->
            <form action="{{ route('products.index') }}" method="GET" class="flex md:hidden px-4 pb-2">
                <input type="text" name="search" placeholder="Rechercher un produit..." class="w-full px-4 py-2 rounded-l-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg">
                    <i class="fas fa-search"></i>
                </button>
            </form>
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
                            <img src="images/logo.png" alt="ADI Logo" class="h-10 mr-3">
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
</body>
</html> 