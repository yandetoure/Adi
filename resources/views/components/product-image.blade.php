@props(['product', 'class' => 'w-full h-48 object-cover', 'alt' => null])

@if($product->hasUploadedImages())
    <img src="{{ $product->getFirstMediaUrl('images') }}" 
         alt="{{ $alt ?? $product->name }}" 
         class="{{ $class }}">
@else
    <div class="{{ $class }} bg-gray-200 flex items-center justify-center">
        <i class="fas fa-image text-3xl text-gray-400"></i>
    </div>
@endif 