@extends('layouts.app')

@section('title', 'Gestion des Commandes - Assistant')
@section('meta_description', 'Gérez les commandes en tant qu\'assistant')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50">
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Gestion des Commandes</h1>
                    <p class="text-gray-600 mt-1">Assistant - Gestion des commandes</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('assistant.dashboard') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 shadow-sm">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Retour au Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 text-green-700 px-6 py-4 rounded-xl mb-6 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-50 to-pink-50 border-2 border-red-200 text-red-700 px-6 py-4 rounded-xl mb-6 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Orders Table -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-teal-50">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-10 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full shadow-lg"></div>
                    <h2 class="text-xl font-bold text-gray-900">Liste des Commandes</h2>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-emerald-50 to-teal-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Commande
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Client
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Montant
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/50 divide-y divide-gray-200">
                        @forelse($orders as $order)
                            <tr class="hover:bg-emerald-50/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center shadow-sm">
                                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">
                                                #{{ $order->id }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $order->orderItems->count() }} articles
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $order->user->name ?? 'Client inconnu' }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->user->email ?? 'Email inconnu' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg font-bold text-emerald-600">
                                        {{ number_format($order->total_amount, 0, ',', ' ') }} FCFA
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('assistant.orders.show', $order) }}"
                                           class="text-emerald-600 hover:text-emerald-800 transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('assistant.orders.edit', $order) }}"
                                           class="text-teal-600 hover:text-teal-800 transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                        <p class="text-gray-500 text-lg font-semibold">Aucune commande trouvée</p>
                                        <p class="text-gray-400 text-sm">Les nouvelles commandes apparaîtront ici</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
