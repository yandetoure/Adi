<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeShop - Boutique en ligne premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Animation personnalisée */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fadeIn {
            animation: fadeIn 1s ease-out forwards;
        }
        
        /* Effet de survol personnalisé pour les produits */
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .product-card {
            transition: all 0.3s ease;
        }
        
        /* Style personnalisé pour le carrousel */
        .carousel-item {
            min-width: 100%;
            transition: transform 0.5s ease;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Barre de navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="text-2xl font-bold text-indigo-600 flex items-center">
                <i class="fas fa-crown mr-2"></i> LuxeShop
            </a>
            
            <!-- Navigation pour desktop -->
            <div class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Accueil</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Boutique</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Nouveautés</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Collections</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium">Contact</a>
            </div>
            
            <!-- Icônes de navigation -->
            <div class="flex items-center space-x-4">
                <button class="text-gray-700 hover:text-indigo-600">
                    <i class="fas fa-search text-lg"></i>
                </button>
                <button class="text-gray-700 hover:text-indigo-600 relative">
                    <i class="fas fa-heart text-lg"></i>
                    <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
                <button class="text-gray-700 hover:text-indigo-600 relative">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">5</span>
                </button>
                <button class="md:hidden text-gray-700" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Menu mobile -->
        <div class="md:hidden hidden bg-white py-2 px-4" id="mobile-menu">
            <a href="#" class="block py-2 text-gray-700 hover:text-indigo-600">Accueil</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-indigo-600">Boutique</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-indigo-600">Nouveautés</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-indigo-600">Collections</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-indigo-600">Contact</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-20">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0 animate-fadeIn">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Découvrez notre collection exclusive</h1>
                <p class="text-xl mb-8">Des produits de qualité supérieure pour un style incomparable.</p>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <button class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Acheter maintenant
                    </button>
                    <button class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition duration-300">
                        Explorer
                    </button>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center animate-fadeIn" style="animation-delay: 0.3s;">
                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                     alt="Mode féminine" 
                     class="rounded-lg shadow-2xl max-w-full h-auto md:max-w-md">
            </div>
        </div>
    </section>

    <!-- Catégories -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Nos Catégories</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a href="#" class="category-card bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative pt-[100%]">
                        <img src="https://images.unsplash.com/photo-1551232864-3f0890e580d9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                             alt="Vêtements" 
                             class="absolute top-0 left-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                            <h3 class="text-white text-xl font-bold">Vêtements</h3>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="category-card bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative pt-[100%]">
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1399&q=80" 
                             alt="Accessoires" 
                             class="absolute top-0 left-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                            <h3 class="text-white text-xl font-bold">Accessoires</h3>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="category-card bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative pt-[100%]">
                        <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1412&q=80" 
                             alt="Chaussures" 
                             class="absolute top-0 left-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                            <h3 class="text-white text-xl font-bold">Chaussures</h3>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="category-card bg-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative pt-[100%]">
                        <img src="https://images.unsplash.com/photo-1592878904946-b3cd8ae243d0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Beauté" 
                             class="absolute top-0 left-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                            <h3 class="text-white text-xl font-bold">Beauté</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Produits populaires -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Produits populaires</h2>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">Voir tout <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Produit 1 -->
                <div class="product-card bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="relative pt-[100%]">
                        <img src="https://images.unsplash.com/photo-1585386959984-a4155224a1ad?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" 
                             alt="Montre de luxe" 
                             class="absolute top-0 left-0 w-full h-full object-cover">
                        <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            -20%
                        </div>
                        <button class="absolute bottom-3 right-3 bg-white rounded-full p-2 text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Montre Premium</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-500 text-sm ml-2">(42)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-gray-500 line-through mr-2">FCFA299</span>
                                <span class="font-bold text-indigo-600">FCFA239</span>
                            </div>
                            <button class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Produit 2 -->
                <div class="product-card bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="relative pt-[100%]">
                        <img src="https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1026&q=80" 
                             alt="Chaussures de sport" 
                             class="absolute top-0 left-0 w-full h-full object-cover">
                        <button class="absolute bottom-3 right-3 bg-white rounded-full p-2 text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Chaussures Sport</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-sm ml-2">(36)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-indigo-600">FCFA129</span>
                            <button class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Produit 3 -->
                <div class="product-card bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="relative pt-[100%]">
                        <img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" 
                             alt="Sac à main" 
                             class="absolute top-0 left-0 w-full h-full object-cover">
                        <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            Nouveau
                        </div>
                        <button class="absolute bottom-3 right-3 bg-white rounded-full p-2 text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Sac à main élégant</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-sm ml-2">(28)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-indigo-600">FCFA189</span>
                            <button class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Produit 4 -->
                <div class="product-card bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="relative pt-[100%]">
                        <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1436&q=80" 
                             alt="Casque audio" 
                             class="absolute top-0 left-0 w-full h-full object-cover">
                        <button class="absolute bottom-3 right-3 bg-white rounded-full p-2 text-gray-700 hover:text-indigo-600">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Casque Audio Pro</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-sm ml-2">(51)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-indigo-600">FCFA159</span>
                            <button class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bannière promotionnelle -->
    <section class="py-16 bg-indigo-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Économisez jusqu'à 50%</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Profitez de nos offres spéciales sur une sélection de produits. Offre valable jusqu'au 30 juin.</p>
            <button class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                Voir les offres
            </button>
        </div>
    </section>

    <!-- Nouveautés -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Nouveautés</h2>
                <div class="flex space-x-2">
                    <button class="carousel-prev bg-gray-200 p-2 rounded-full hover:bg-gray-300">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-next bg-gray-200 p-2 rounded-full hover:bg-gray-300">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            
            <div class="relative overflow-hidden">
                <div class="carousel-container flex transition-transform duration-300 ease-in-out" id="new-products-carousel">
                    <!-- Produit 5 -->
                    <div class="carousel-item w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-2">
                        <div class="product-card bg-white rounded-lg overflow-hidden shadow-md">
                            <div class="relative pt-[100%]">
                                <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                     alt="Appareil photo" 
                                     class="absolute top-0 left-0 w-full h-full object-cover">
                                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    -15%
                                </div>
                                <button class="absolute bottom-3 right-3 bg-white rounded-full p-2 text-gray-700 hover:text-indigo-600">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-1">Appareil Photo Vintage</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 text-sm ml-2">(19)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-gray-500 line-through mr-2">FCFA249</span>
                                        <span class="font-bold text-indigo-600">FCFA211</span>
                                    </div>
                                    <button class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit 6 -->
                    <div class="carousel-item w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-2">
                        <div class="product-card bg-white rounded-lg overflow-hidden shadow-md">
                            <div class="relative pt-[100%]">
                                <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1632&q=80" 
                                     alt="Montre connectée" 
                                     class="absolute top-0 left-0 w-full h-full object-cover">
                                <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    Nouveau
                                </div>
                                <button class="absolute bottom-3 right-3 bg-white rounded-full p-2 text-gray-700 hover:text-indigo-600">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-1">Montre Connectée</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="text-gray-500 text-sm ml-2">(47)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-indigo-600">FCFA179</span>
                                    <button class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit 7 -->
                    <div class="carousel-item w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-2">
                        <div class="product-card bg-white rounded-lg overflow-hidden shadow-md">
                            <div class="relative pt-[100%]">
                                <img src="https://images.unsplash.com/photo-1556905055-8f358a7a10b7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                     alt="Parfum" 
                                     class="absolute top-0 left-0 w-full h-full object-cover">
                                <button class="absolute bottom-3 right-3 bg-white rounded-full p-2 text-gray-700 hover:text-indigo-600">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-1">Parfum Élégance</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 text-sm ml-2">(23)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-indigo-600">FCFA89</span>
                                    <button class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit 8 -->
                    <div class="carousel-item w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-2">
                        <div class="product-card bg-white rounded-lg overflow-hidden shadow-md">
                            <div class="relative pt-[100%]">
                                <img src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80" 
                                     alt="Chaussures de course" 
                                     class="absolute top-0 left-0 w-full h-full object-cover">
                                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    -30%
                                </div>
                                <button class="absolute bottom-3 right-3 bg-white rounded-full p-2 text-gray-700 hover:text-indigo-600">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-1">Chaussures de Course</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 text-sm ml-2">(64)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-gray-500 line-through mr-2">FCFA149</span>
                                        <span class="font-bold text-indigo-600">FCFA104</span>
                                    </div>
                                    <button class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Produit 9 -->
                    <div class="carousel-item w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-2">
                        <div class="product-card bg-white rounded-lg overflow-hidden shadow-md">
                            <div class="relative pt-[100%]">
                                <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80" 
                                     alt="Écharpe en laine" 
                                     class="absolute top-0 left-0 w-full h-full object-cover">
                                <button class="absolute bottom-3 right-3 bg-white rounded-full p-2 text-gray-700 hover:text-indigo-600">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-1">Écharpe en Laine</h3>
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="text-gray-500 text-sm ml-2">(18)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-indigo-600">FCFA49</span>
                                    <button class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Témoignages -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Ce que disent nos clients</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Témoignage 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-gray-500 text-sm">5/5</span>
                    </div>
                    <p class="text-gray-700 mb-4">"Les produits sont de très haute qualité et le service client est exceptionnel. Je recommande vivement cette boutique!"</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/43.jpg" 
                             alt="Marie D." 
                             class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h4 class="font-semibold">Marie D.</h4>
                            <p class="text-gray-500 text-sm">Paris, France</p>
                        </div>
                    </div>
                </div>
                
                <!-- Témoignage 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-500 text-sm">4.5/5</span>
                    </div>
                    <p class="text-gray-700 mb-4">"Livraison rapide et emballage soigné. Les produits correspondent parfaitement à la description. Je suis très satisfait de mon achat."</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                             alt="Jean P." 
                             class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h4 class="font-semibold">Jean P.</h4>
                            <p class="text-gray-500 text-sm">Lyon, France</p>
                        </div>
                    </div>
                </div>
                
                <!-- Témoignage 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-gray-500 text-sm">5/5</span>
                    </div>
                    <p class="text-gray-700 mb-4">"J'ai commandé plusieurs fois et à chaque fois c'est parfait. Le rapport qualité-prix est excellent. Je reviendrai certainement!"</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" 
                             alt="Sophie L." 
                             class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h4 class="font-semibold">Sophie L.</h4>
                            <p class="text-gray-500 text-sm">Marseille, France</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-indigo-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Abonnez-vous à notre newsletter</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Recevez des offres exclusives, des conseils de style et des mises à jour sur nos nouveaux produits.</p>
            <div class="max-w-md mx-auto flex flex-col sm:flex-row gap-2">
                <input type="email" 
                       placeholder="Votre adresse email" 
                       class="flex-grow px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <button class="bg-indigo-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-800 transition duration-300 whitespace-nowrap">
                    S'abonner
                </button>
            </div>
        </div>
    </section>

    <!-- Pied de page -->
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Colonne 1 -->
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-crown mr-2"></i> LuxeShop
                    </h3>
                    <p class="text-gray-400 mb-4">Votre destination premium pour des produits de qualité exceptionnelle.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Colonne 2 -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Boutique</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Tous les produits</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Nouveautés</li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Meilleures ventes</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Offres spéciales</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Collections</a></li>
                    </ul>
                </div>
                
                <!-- Colonne 3 -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Informations</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">À propos de nous</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Carrières</a></li>
                    </ul>
                </div>
                
                <!-- Colonne 4 -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Service client</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Mon compte</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Suivi de commande</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Livraison & Retours</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Paiements sécurisés</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Conditions générales</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2023 LuxeShop. Tous droits réservés.</p>
                <div class="flex space-x-6">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Visa" class="h-8">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196561.png" alt="Mastercard" class="h-8">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196566.png" alt="PayPal" class="h-8">
                    <img src="https://cdn-icons-png.flaticon.com/512/196/196565.png" alt="Apple Pay" class="h-8">
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Menu mobile
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Carrousel des nouveautés
        const carousel = document.getElementById('new-products-carousel');
        const prevButton = document.querySelector('.carousel-prev');
        const nextButton = document.querySelector('.carousel-next');
        const items = document.querySelectorAll('.carousel-item');
        
        let currentIndex = 0;
        const itemWidth = items[0].clientWidth;
        const visibleItems = window.innerWidth >= 1024 ? 4 : window.innerWidth >= 768 ? 3 : window.innerWidth >= 640 ? 2 : 1;
        
        function updateCarousel() {
            const offset = -currentIndex * itemWidth;
            carousel.style.transform = `translateX(${offset}px)`;
        }
        
        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });
        
        nextButton.addEventListener('click', () => {
            if (currentIndex < items.length - visibleItems) {
                currentIndex++;
                updateCarousel();
            }
        });
        
        // Redimensionnement de la fenêtre
        window.addEventListener('resize', () => {
            const newVisibleItems = window.innerWidth >= 1024 ? 4 : window.innerWidth >= 768 ? 3 : window.innerWidth >= 640 ? 2 : 1;
            if (newVisibleItems !== visibleItems) {
                currentIndex = 0;
                updateCarousel();
            }
        });
        
        // Animation au défilement
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.animate-fadeIn');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementPosition < windowHeight - 100) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>
</html>