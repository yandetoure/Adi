@extends('layouts.app')

@section('title', 'Détails de la Commande - Assistant')
@section('meta_description', 'Consultez les détails de la commande')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50">
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Détails de la Commande #{{ $order->id }}</h1>
                    <p class="text-gray-600 mt-1">Assistant - Consultation de la commande</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('assistant.orders.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 shadow-sm">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour à la liste
                    </a>
                    <a href="{{ route('assistant.orders.edit', $order) }}"
                       class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Order Details -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-3 h-10 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full shadow-lg"></div>
                    <h2 class="text-xl font-bold text-gray-900">Informations de la commande</h2>
                </div>

                <div class="space-y-6">
                    <div class="p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Numéro de commande</label>
                        <p class="text-lg font-bold text-gray-900">#{{ $order->id }}</p>
                    </div>

                    <div class="p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Statut</label>
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full
                            @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                            @elseif($order->status === 'delivered') bg-green-100 text-green-800
                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $order->status_label }}
                        </span>
                    </div>

                    <div class="p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Montant total</label>
                        <p class="text-lg font-bold text-emerald-600">
                            {{ number_format($order->total_amount, 0, ',', ' ') }} FCFA
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Date de commande</label>
                            <p class="text-sm text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Dernière modification</label>
                            <p class="text-sm text-gray-900">{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    @if($order->notes)
                        <div class="p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Notes</label>
                            <p class="text-sm text-gray-900">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Customer Information -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-3 h-10 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-full shadow-lg"></div>
                    <h2 class="text-xl font-bold text-gray-900">Informations client</h2>
                </div>

                <div class="space-y-6">
                    <div class="p-4 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl border-2 border-cyan-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nom</label>
                        <p class="text-sm text-gray-900">{{ $order->user->name ?? 'Client inconnu' }}</p>
                    </div>

                    <div class="p-4 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl border-2 border-cyan-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <p class="text-sm text-gray-900">{{ $order->user->email ?? 'Email inconnu' }}</p>
                    </div>

                    <div class="p-4 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl border-2 border-cyan-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Téléphone</label>
                        <p class="text-sm text-gray-900">{{ $order->user->phone ?? 'Non renseigné' }}</p>
                    </div>

                    <div class="p-4 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl border-2 border-cyan-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Date d'inscription</label>
                        <p class="text-sm text-gray-900">
                            {{ $order->user->created_at ? $order->user->created_at->format('d/m/Y') : 'Non disponible' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-3 h-10 bg-gradient-to-b from-orange-400 to-red-500 rounded-full shadow-lg"></div>
                <h2 class="text-xl font-bold text-gray-900">Articles commandés</h2>
            </div>

            @if($order->orderItems->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-orange-50 to-red-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Produit
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Prix unitaire
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Quantité
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/50 divide-y divide-gray-200">
                            @foreach($order->orderItems as $item)
                                <tr class="hover:bg-orange-50/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12">
                                                @if($item->product->getFirstMediaUrl('images') && $item->product->getFirstMediaUrl('images') !== '')
                                                    <img class="h-12 w-12 rounded-xl object-cover border-2 border-gray-200"
                                                         src="{{ $item->product->getFirstMediaUrl('images') }}"
                                                         alt="{{ $item->product->name }}">
                                                @else
                                                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center border-2 border-gray-200">
                                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900">
                                                    {{ $item->product->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    SKU: {{ $item->product->sku }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ number_format($item->price, 0, ',', ' ') }} FCFA
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-emerald-600">
                                        {{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="flex flex-col items-center">
                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg font-semibold">Aucun article dans cette commande</p>
                        <p class="text-gray-400 text-sm">Cette commande ne contient aucun produit</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
