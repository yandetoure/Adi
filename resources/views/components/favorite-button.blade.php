@props(['product'])

<button class="favorite-btn" 
        onclick="toggleFavorite({{ $product->id }}, this)"
        data-product-id="{{ $product->id }}"
        title="Ajouter aux favoris">
    <i class="fas fa-heart"></i>
</button> 