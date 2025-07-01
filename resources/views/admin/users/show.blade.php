@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Détails de l'Utilisateur</h1>
                    <p class="text-gray-600">
                        @if(auth()->user()->hasRole('assistant'))
                            Assistant - Consultation de l'utilisateur
                        @else
                            Administration - Détails de l'utilisateur
                        @endif
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ auth()->user()->hasRole('assistant') ? route('assistant.users.index') : route('admin.users.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                        Retour à la liste
                    </a>
                    @if(auth()->user()->hasRole(['admin', 'super-admin']))
                        <a href="{{ route('admin.users.edit', $user) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                            <i class="fas fa-edit mr-2"></i>Modifier
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- User Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations de l'utilisateur</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->phone ?? 'Non renseigné' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rôles</label>
                        <div class="mt-1 flex flex-wrap gap-2">
                            @foreach($user->roles as $role)
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($role->name === 'admin') bg-red-100 text-red-800
                                    @elseif($role->name === 'assistant') bg-blue-100 text-blue-800
                                    @elseif($role->name === 'super-admin') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @endforeach
                            @if($user->roles->count() === 0)
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                    Client
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email vérifié</label>
                        <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->email_verified_at ? 'Oui' : 'Non' }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date d'inscription</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dernière connexion</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- User Orders -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Commandes de l'utilisateur</h2>
                
                @if($user->orders->count() > 0)
                    <div class="space-y-3">
                        @foreach($user->orders->take(10) as $order)
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-900">Commande #{{ $order->id }}</p>
                                    <p class="text-sm text-gray-500">{{ number_format($order->total, 0, ',', ' ') }} FCFA</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                        @elseif($order->status === 'completed') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <a href="{{ auth()->user()->hasRole('assistant') ? route('assistant.orders.show', $order) : route('admin.orders.show', $order) }}" 
                                       class="text-blue-600 hover:text-blue-900 text-xs">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($user->orders->count() > 10)
                            <div class="text-center pt-4">
                                <p class="text-sm text-gray-500">
                                    Et {{ $user->orders->count() - 10 }} autres commandes...
                                </p>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-shopping-cart text-3xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500">Aucune commande pour cet utilisateur</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 