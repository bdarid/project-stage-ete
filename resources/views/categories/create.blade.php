<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white">Ajouter une Catégorie</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 text-black">
                @csrf

                <div class="grid grid-cols-1 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la Catégorie <span class="text-red-500">*</span></label>
                        <input type="text" name="nom_categorie" value="{{ old('nom_categorie') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie Parente (Optionnel)</label>
                        <select name="parent_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Aucune (Créer comme catégorie principale) --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nom_categorie }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-400 mt-1">Laissez vide si c'est une catégorie principale.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description_categorie" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description_categorie') }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <a href="{{ route('categories.index') }}" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg mr-3 hover:bg-gray-300 transition-colors">Annuler</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg font-bold shadow-sm transition-colors">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
