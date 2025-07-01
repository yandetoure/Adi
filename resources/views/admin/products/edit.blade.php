@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Modifier le Produit</h1>
                    <p class="text-gray-600">
                        @if(auth()->user()->hasRole('assistant'))
                            Assistant - Modification du produit
                        @else
                            Administration - Édition du produit
                        @endif
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ auth()->user()->hasRole('assistant') ? route('assistant.products.index') : route('admin.products.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ auth()->user()->hasRole('assistant') ? route('assistant.products.update', $product) : route('admin.products.update', $product) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations de base</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom du produit *</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $product->name) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug *</label>
                            <input type="text" 
                                   name="slug" 
                                   id="slug" 
                                   value="{{ old('slug', $product->slug) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie *</label>
                            <select name="category_id" 
                                    id="category_id" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="">Sélectionner une catégorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Prix (FCFA) *</label>
                            <input type="number" 
                                   name="price" 
                                   id="price" 
                                   value="{{ old('price', $product->price) }}" 
                                   step="0.01" 
                                   min="0"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock *</label>
                            <input type="number" 
                                   name="stock" 
                                   id="stock" 
                                   value="{{ old('stock', $product->stock) }}" 
                                   min="0"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="is_active" class="flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active" 
                                       value="1" 
                                       {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Produit actif</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Descriptions -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Descriptions</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="short_description" class="block text-sm font-medium text-gray-700">Description courte</label>
                            <textarea name="short_description" 
                                      id="short_description" 
                                      rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('short_description', $product->short_description) }}</textarea>
                            @error('short_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description complète</label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="6"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Images Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Images du produit</h2>
                
                <!-- Images existantes -->
                @if($product->media->count() > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Images actuelles</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            @foreach($product->media as $media)
                                <div class="relative group">
                                    <img src="{{ $media->getUrl() }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-32 object-cover rounded-lg border border-gray-200">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                        <form action="{{ route('admin.products.delete-media', ['product' => $product, 'media' => $media]) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg text-center">
                        <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">Aucune image pour ce produit</p>
                    </div>
                @endif

                <!-- Ajouter de nouvelles images -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Ajouter de nouvelles images</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700">Sélectionner des images</label>
                            <input type="file" 
                                   name="images[]" 
                                   id="images" 
                                   multiple 
                                   accept="image/*"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500">Vous pouvez sélectionner plusieurs images. Formats acceptés : JPG, PNG, GIF</p>
                            @error('images')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL d'image par défaut -->
                        <div>
                            <label for="default_image_url" class="block text-sm font-medium text-gray-700">URL d'image par défaut</label>
                            <input type="url" 
                                   name="default_image_url" 
                                   id="default_image_url" 
                                   value="{{ old('default_image_url', $product->default_image_url) }}" 
                                   placeholder="https://example.com/image.jpg"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500">URL d'une image externe si vous n'avez pas d'image à télécharger</p>
                            @error('default_image_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    Mettre à jour le produit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 