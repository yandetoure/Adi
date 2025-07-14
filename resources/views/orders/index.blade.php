@extends('layouts.app')

@section('title', 'Mes Commandes - ADI Store')
@section('meta_description', 'Consultez l\'historique de vos commandes et suivez leur statut.')
@section('meta_keywords', 'commandes, historique, suivi, ADI Store')

@section('content')
<!-- Styles spécifiques à la page des commandes -->
<style>
    .hero-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .order-card { 
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 20px; 
        overflow: hidden; 
        box-shadow: 0 8px 25px rgba(0,0,0,0.1); 
        transition: all 0.3s ease;
        border: 2px solid transparent;
        margin-bottom: 2rem;
    }
    .order-card:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        border-color: #3b82f6;
    }
    .order-header { 
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 1.5rem; 
        border-bottom: 1px solid #e5e7eb;
    }
    .order-content { 
        padding: 1.5rem; 
    }
    .order-item { 
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 15px; 
        padding: 1rem; 
        margin-bottom: 1rem;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    .order-item:hover { 
        transform: translateX(5px); 
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .product-image { 
        width: 80px; 
        height: 80px; 
        object-fit: cover; 
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .status-badge { 
        padding: 0.5rem 1rem; 
        border-radius: 25px; 
        font-size: 0.875rem; 
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .status-pending { 
        background: linear-gradient(45deg, #fef3c7, #fde68a); 
        color: #92400e;
    }
    .status-processing { 
        background: linear-gradient(45deg, #dbeafe, #bfdbfe); 
        color: #1e40af;
    }
    .status-shipped { 
        background: linear-gradient(45deg, #e0e7ff, #c7d2fe); 
        color: #3730a3;
    }
    .status-delivered { 
        background: linear-gradient(45deg, #d1fae5, #a7f3d0); 
        color: #065f46;
    }
    .status-cancelled { 
        background: linear-gradient(45deg, #fee2e2, #fecaca); 
        color: #991b1b;
    }
    .empty-state {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }
    .stat-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        border-color: #3b82f6;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
    }
    .stat-total { background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #1e40af; }
    .stat-pending { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e; }
    .stat-delivered { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; }
    .stat-cancelled { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b; }
</style>

<!-- Hero Section -->
<section class="hero-gradient text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Mes <span class="text-yellow-300">Commandes</span>
            </h1>
            <p class="text-xl text-gray-100 max-w-3xl mx-auto">
                Consultez l'historique de vos commandes et suivez leur statut en temps réel.
            </p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon stat-total">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $orders->total() }}</h3>
                <p class="text-gray-600">Total des commandes</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-pending">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $orders->where('status', 'pending')->count() }}</h3>
                <p class="text-gray-600">En attente</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-delivered">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $orders->where('status', 'delivered')->count() }}</h3>
                <p class="text-gray-600">Livrées</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-cancelled">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $orders->where('status', 'cancelled')->count() }}</h3>
                <p class="text-gray-600">Annulées</p>
            </div>
        </div>
    </div>
</section>

<!-- Orders Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Historique des commandes</h2>
                <p class="text-gray-600">Retrouvez toutes vos commandes passées</p>
            </div>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                <i class="fas fa-shopping-cart mr-2"></i>
                Continuer les achats
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6 flex items-center">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="mb-4 md:mb-0">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                                        Commande #{{ $order->id }}
                                    </h3>
                                    <p class="text-gray-600">
                                        <i class="fas fa-calendar mr-2"></i>
                                        {{ $order->created_at->format('d/m/Y à H:i') }}
                                    </p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="status-badge 
                                        @if($order->status === 'pending') status-pending
                                        @elseif($order->status === 'processing') status-processing
                                        @elseif($order->status === 'shipped') status-shipped
                                        @elseif($order->status === 'delivered') status-delivered
                                        @elseif($order->status === 'cancelled') status-cancelled
                                        @endif">
                                        @switch($order->status)
                                            @case('pending')
                                                <i class="fas fa-clock mr-2"></i>En attente
                                                @break
                                            @case('processing')
                                                <i class="fas fa-cog mr-2"></i>En cours de traitement
                                                @break
                                            @case('shipped')
                                                <i class="fas fa-shipping-fast mr-2"></i>Expédiée
                                                @break
                                            @case('delivered')
                                                <i class="fas fa-check mr-2"></i>Livrée
                                                @break
                                            @case('cancelled')
                                                <i class="fas fa-times mr-2"></i>Annulée
                                                @break
                                            @default
                                                {{ ucfirst($order->status) }}
                                        @endswitch
                                    </span>
                                    <a href="{{ route('orders.show', $order) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-eye mr-2"></i>
                                        Détails
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="order-content">
                            <div class="space-y-4">
                                @foreach($order->orderItems as $item)
                                    <div class="order-item">
                                        <div class="flex items-center space-x-4">
                                            <!-- Product Image -->
                                            <div class="flex-shrink-0">
                                                @if($item->product->getFirstMediaUrl('images') && $item->product->getFirstMediaUrl('images') !== '')
                                                    <img src="{{ $item->product->getFirstMediaUrl('images') }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="product-image">
                                                @else
                                                    <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <i class="fas fa-image text-2xl text-gray-400"></i>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Product Info -->
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-900 mb-1">{{ $item->product->name }}</h4>
                                                <p class="text-sm text-gray-600 mb-2">{{ $item->product->category->name }}</p>
                                                <div class="flex items-center space-x-4">
                                                    <span class="text-sm text-gray-500">
                                                        <i class="fas fa-hashtag mr-1"></i>
                                                        Quantité: {{ $item->quantity }}
                                                    </span>
                                                    <span class="text-sm text-gray-500">
                                                        <i class="fas fa-tag mr-1"></i>
                                                        Prix unitaire: {{ number_format($item->unit_price, 0, ',', ' ') }} FCFA
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Price -->
                                            <div class="text-right">
                                                <p class="font-bold text-lg text-gray-900">
                                                    {{ number_format($item->total_price, 0, ',', ' ') }} FCFA
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div class="mb-4 md:mb-0">
                                        <div class="flex items-center space-x-4">
                                            <div>
                                                <p class="text-2xl font-bold text-gray-900">
                                                    Total: {{ number_format($order->total_amount, 0, ',', ' ') }} FCFA
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    {{ $order->orderItems->count() }} article(s)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-3">
                                        <a href="{{ route('orders.show', $order) }}" 
                                           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                                            <i class="fas fa-eye mr-2"></i>
                                            Voir les détails
                                        </a>
                                        @if($order->status === 'delivered')
                                            <button class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300">
                                                <i class="fas fa-star mr-2"></i>
                                                Évaluer
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    {{ $orders->links() }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="mb-8">
                    <i class="fas fa-shopping-bag text-8xl text-gray-400 mb-6"></i>
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Aucune commande</h3>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">
                        Vous n'avez pas encore passé de commande. Découvrez notre sélection de produits 
                        et commencez votre expérience d'achat dès maintenant !
                    </p>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                        <i class="fas fa-shopping-cart mr-3"></i>
                        Découvrir nos produits
                    </a>
                    <a href="{{ route('categories.index') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-300 transform hover:scale-105">
                        <i class="fas fa-th-large mr-3"></i>
                        Parcourir les catégories
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/221771234567" class="fixed bottom-8 right-8 bg-green-500 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl shadow-lg hover:bg-green-600 transition duration-300 z-50" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>
@endsection 