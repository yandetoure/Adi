@props(['product' => null, 'message' => null])

@php
    $whatsappNumber = '221786309581';
    $defaultMessage = 'Bonjour, je suis intéressé par vos produits. Pouvez-vous me donner plus d\'informations ?';
    
    if ($product) {
        $productMessage = "Bonjour, je suis intéressé par le produit {$product->name} (Prix: {$product->price} FCFA) - " . url()->current();
    } else {
        $productMessage = $message ?? $defaultMessage;
    }
    
    $whatsappUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($productMessage);
@endphp

<div class="fixed bottom-6 left-6 z-50">
    <a href="{{ $whatsappUrl }}" target="_blank" 
       class="flex items-center px-4 py-3 bg-green-500 text-white rounded-full shadow-lg hover:bg-green-600 transition duration-300 transform hover:scale-105">
        <i class="fab fa-whatsapp mr-2 text-xl"></i>
        <span class="hidden sm:inline font-medium">Demander sur WhatsApp</span>
    </a>
</div> 