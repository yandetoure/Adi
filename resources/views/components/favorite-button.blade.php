@props(['product'])

@auth
    @php
        $isFavorite = auth()->user()->favoriteProducts()->where('product_id', $product->id)->exists();
    @endphp
    
    @if($isFavorite)
        <form action="{{ route('favorites.remove', $product) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="text-red-600 hover:text-red-800 transition-colors"
                    title="Retirer des favoris">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </button>
        </form>
    @else
        <form action="{{ route('favorites.add', $product) }}" method="POST" class="inline">
            @csrf
            <button type="submit" 
                    class="text-gray-400 hover:text-red-600 transition-colors"
                    title="Ajouter aux favoris">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>
        </form>
    @endif
@else
    <a href="{{ route('login') }}" 
       class="text-gray-400 hover:text-red-600 transition-colors"
       title="Connectez-vous pour ajouter aux favoris">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
        </svg>
    </a>
@endauth 