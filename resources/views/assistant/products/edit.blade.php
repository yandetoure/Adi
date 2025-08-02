@extends('layouts.app')

@section('title', 'Modifier le Produit - Assistant')
@section('meta_description', 'Modifiez les informations du produit')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('assistant.products.index') }}" class="text-gray-700 hover:text-green-600">
                        Produits
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500 md:ml-2">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Modifier le produit</h1>
        </div>

        <form method="POST" action="{{ route('assistant.products.update', $product) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Informations de base -->
                <div class="space-y-6">
                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Informations de base</h3>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom du produit *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug *</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('slug')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Description courte</label>
                        <textarea id="short_description" name="short_description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('short_description', $product->short_description) }}</textarea>
                        @error('short_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description complète</label>
                        <textarea id="description" name="description" rows="6"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Prix et stock -->
                <div class="space-y-6">
                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Prix et stock</h3>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Prix *</label>
                        <div class="relative">
                            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required
                                   class="w-full pl-12 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                   placeholder="0.00">
                            <span class="absolute left-3 top-2 text-gray-500 text-sm">FCFA</span>
                        </div>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
                        <input type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('stock_quantity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Catégorie *</label>
                        <select id="category_id" name="category_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">Produit actif</label>
                    </div>
                </div>
            </div>

            <!-- Images existantes -->
            @if($product->media->count() > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2 mb-4">Images existantes</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach($product->media as $media)
                            <div class="relative group">
                                <img src="{{ $media->getUrl() }}" alt="{{ $product->name }}" class="w-full h-24 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                    <label class="flex items-center text-white text-sm cursor-pointer">
                                        <input type="checkbox" name="remove_images[]" value="{{ $media->id }}" class="mr-2">
                                        Supprimer
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Nouvelles images -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2 mb-4">Ajouter de nouvelles images</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden" onchange="previewImages(this)">
                        <label for="images" class="cursor-pointer">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-1 text-sm text-gray-600">Cliquez pour ajouter des images</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 2MB</p>
                        </label>
                    </div>
                    <div id="image-preview" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>
                </div>
                @error('images.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SEO -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2 mb-4">Optimisation SEO</h3>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">Titre SEO</label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}" maxlength="60"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <p class="text-xs text-gray-500 mt-1">Maximum 60 caractères</p>
                        @error('meta_title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">Mots-clés</label>
                        <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="mot-clé1, mot-clé2, mot-clé3">
                        <p class="text-xs text-gray-500 mt-1">Séparés par des virgules</p>
                        @error('meta_keywords')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Description SEO</label>
                    <textarea id="meta_description" name="meta_description" rows="6" maxlength="160"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('meta_description', $product->meta_description) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Maximum 160 caractères</p>
                    @error('meta_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('assistant.products.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Annuler
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImages(input) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';

    if (input.files) {
        Array.from(input.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                    <button type="button" onclick="removeImage(${index})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">
                        ×
                    </button>
                `;
                preview.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }
}

function removeImage(index) {
    const input = document.getElementById('images');
    const dt = new DataTransfer();

    Array.from(input.files).forEach((file, i) => {
        if (i !== index) {
            dt.items.add(file);
        }
    });

    input.files = dt.files;
    previewImages(input);
}

// Auto-génération du slug
document.getElementById('name').addEventListener('input', function() {
    const slug = this.value
        .toLowerCase()
        .replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
});
</script>
@endsection
