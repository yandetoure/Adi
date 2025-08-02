@extends('layouts.app')

@section('title', 'Modifier la Commande - Assistant')
@section('meta_description', 'Modifiez les détails de la commande')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50">
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Modifier la Commande #{{ $order->id }}</h1>
                    <p class="text-gray-600 mt-1">Assistant - Modification de la commande</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('assistant.orders.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 shadow-sm">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ route('assistant.orders.update', $order) }}"
              method="POST"
              class="space-y-8">
            @csrf
            @method('PUT')

            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-8">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-3 h-10 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full shadow-lg"></div>
                    <h2 class="text-xl font-bold text-gray-900">Informations de la commande</h2>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="status" class="block text-sm font-bold text-gray-700 mb-2">Statut de la commande *</label>
                        <select name="status"
                                id="status"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm"
                                required>
                            <option value="pending" {{ old('status', $order->status) === 'pending' ? 'selected' : '' }}>
                                En attente
                            </option>
                            <option value="processing" {{ old('status', $order->status) === 'processing' ? 'selected' : '' }}>
                                En cours de traitement
                            </option>
                            <option value="shipped" {{ old('status', $order->status) === 'shipped' ? 'selected' : '' }}>
                                Expédiée
                            </option>
                            <option value="delivered" {{ old('status', $order->status) === 'delivered' ? 'selected' : '' }}>
                                Livrée
                            </option>
                            <option value="cancelled" {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }}>
                                Annulée
                            </option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="tracking_number" class="block text-sm font-bold text-gray-700 mb-2">Numéro de suivi</label>
                        <input type="text"
                               name="tracking_number"
                               id="tracking_number"
                               value="{{ old('tracking_number', $order->tracking_number) }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm"
                               placeholder="Numéro de suivi de livraison">
                        @error('tracking_number')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-bold text-gray-700 mb-2">Notes internes</label>
                        <textarea name="notes"
                                  id="notes"
                                  rows="4"
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm resize-none"
                                  placeholder="Notes internes sur cette commande...">{{ old('notes', $order->notes) }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-3 h-10 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-full shadow-lg"></div>
                    <h2 class="text-xl font-bold text-gray-900">Résumé de la commande</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Client</label>
                        <p class="text-sm text-gray-900">{{ $order->user->name ?? 'Client inconnu' }}</p>
                    </div>

                    <div class="p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Montant total</label>
                        <p class="text-lg font-bold text-emerald-600">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</p>
                    </div>

                    <div class="p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Articles</label>
                        <p class="text-sm text-gray-900">{{ $order->orderItems->count() }} produit(s)</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold py-3 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Mettre à jour la commande
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
