@extends('layouts.app')

@section('title', 'Ajouter un Produit - Assistant')
@section('meta_description', 'Ajoutez un nouveau produit à la boutique ADI')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header moderne -->
        <div class="mb-8">
            <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
                <a href="{{ route('assistant.products.index') }}" class="hover:text-emerald-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('assistant.products.index') }}" class="hover:text-emerald-600 transition-colors">Produits</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-900 font-medium">Nouveau produit</span>
            </nav>

            <div class="flex items-center space-x-4">
                <div class="p-4 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Ajouter un nouveau produit</h1>
                    <p class="text-gray-600 mt-1">Remplissez les informations ci-dessous pour créer votre produit</p>
                </div>
            </div>
        </div>

        <!-- Formulaire moderne -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
            <form method="POST" action="{{ route('assistant.products.store') }}" enctype="multipart/form-data" class="p-8">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Informations de base -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-3 h-10 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full shadow-lg"></div>
                            <h3 class="text-xl font-bold text-gray-900">Informations de base</h3>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nom du produit *</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-bold text-gray-700 mb-2">Slug *</label>
                                <input type="text" id="slug" name="slug" value="{{ old('slug') }}" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm">
                                @error('slug')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="short_description" class="block text-sm font-bold text-gray-700 mb-2">Description courte</label>
                                <textarea id="short_description" name="short_description" rows="3"
                                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm resize-none">{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description complète</label>
                                <textarea id="description" name="description" rows="6"
                                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm resize-none">{{ old('description') }}</textarea>
                                @error('description')
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

                    <!-- Prix et stock -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-3 h-10 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-full shadow-lg"></div>
                            <h3 class="text-xl font-bold text-gray-900">Prix et stock</h3>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label for="price" class="block text-sm font-bold text-gray-700 mb-2">Prix *</label>
                                <div class="relative">
                                    <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" required
                                           class="w-full pl-16 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm">
                                    <span class="absolute left-4 top-3 text-emerald-600 font-bold">FCFA</span>
                                </div>
                                @error('price')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="stock_quantity" class="block text-sm font-bold text-gray-700 mb-2">Stock *</label>
                                <input type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" min="0" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm">
                                @error('stock_quantity')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">Catégorie *</label>
                                <select id="category_id" name="category_id" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm">
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="flex items-center space-x-3 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-2 border-emerald-200 shadow-sm">
                                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="h-5 w-5 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                                <label for="is_active" class="text-sm font-bold text-gray-900">Produit actif</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Images -->
                <div class="mt-8 pt-6 border-t-2 border-gray-200">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-3 h-10 bg-gradient-to-b from-orange-400 to-red-500 rounded-full shadow-lg"></div>
                        <h3 class="text-xl font-bold text-gray-900">Images du produit</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Image principale -->
                        <div>
                            <label for="main_image" class="block text-sm font-bold text-gray-700 mb-2">Image principale *</label>
                            <div class="relative">
                                <input type="file" id="main_image" name="main_image" accept="image/*" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                <div class="mt-2 text-xs text-gray-500">Formats acceptés : JPG, PNG, WEBP. Taille max : 5MB</div>
                            </div>
                            @error('main_image')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Images supplémentaires -->
                        <div>
                            <label for="additional_images" class="block text-sm font-bold text-gray-700 mb-2">Images supplémentaires</label>
                            <div class="relative">
                                <input type="file" id="additional_images" name="additional_images[]" accept="image/*" multiple
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-300 transition-all duration-300 bg-white hover:bg-gray-50 shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                <div class="mt-2 text-xs text-gray-500">Vous pouvez sélectionner plusieurs images</div>
                            </div>
                            @error('additional_images')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Aperçu des images -->
                    <div id="image-preview" class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4 hidden">
                        <div class="relative group">
                            <img id="main-preview" class="w-full h-32 object-cover rounded-xl border-2 border-gray-200" alt="Aperçu image principale">
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                <span class="text-white text-sm font-bold">Image principale</span>
                            </div>
                        </div>
                        <div id="additional-previews" class="grid grid-cols-2 gap-2">
                            <!-- Les aperçus des images supplémentaires seront ajoutés ici -->
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 pt-6 border-t-2 border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('assistant.products.index') }}"
                           class="px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 font-bold shadow-sm">
                            Annuler
                        </a>
                        <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-xl hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Créer le produit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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

// Aperçu des images
document.getElementById('main_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('main-preview').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById('additional_images').addEventListener('change', function(e) {
    const files = e.target.files;
    const previewContainer = document.getElementById('additional-previews');
    previewContainer.innerHTML = '';

    Array.from(files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-full h-16 object-cover rounded-lg border border-gray-200';
            img.alt = `Image supplémentaire ${index + 1}`;
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });

    if (files.length > 0) {
        document.getElementById('image-preview').classList.remove('hidden');
    }
});
</script>
@endsection
