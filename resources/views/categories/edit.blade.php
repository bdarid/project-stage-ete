<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="Modifier la Catégorie" subtitle="Mise à jour des informations pour : {{ $categorie->nom_categorie }}">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Retour
            </a>
        </x-erp.page-header>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-4xl mx-auto">
            
            {{-- Affichage des erreurs --}}
            @if($errors->any())
                <div class="rounded-2xl border border-red-500/40 bg-red-500/10 p-5 mb-6">
                    <h3 class="font-semibold text-red-400 mb-3">Erreurs de validation :</h3>
                    <ul class="list-disc ml-6 space-y-1 text-red-300 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categories.update', $categorie->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <x-erp.card title="Détails de la catégorie" subtitle="Modifiez les champs ci-dessous pour mettre à jour la catégorie.">
                    <div class="grid grid-cols-1 gap-6">
                        
                        {{-- Nom --}}
                        <div>
                            <label for="nom_categorie" class="block text-sm font-semibold text-slate-300 mb-2">Nom de la Catégorie <span class="text-red-400">*</span></label>
                            <input type="text" name="nom_categorie" id="nom_categorie" value="{{ old('nom_categorie', $categorie->nom_categorie) }}" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                        </div>

                        {{-- Parent --}}
                        <div>
                            <label for="parent_id" class="block text-sm font-semibold text-slate-300 mb-2">Catégorie Parente</label>
                            <select name="parent_id" id="parent_id" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                                <option value="">-- Aucune (Catégorie principale) --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ (old('parent_id', $categorie->parent_id) == $cat->id) ? 'selected' : '' }}>
                                        {{ $cat->nom_categorie }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Description --}}
                        <div>
                            <label for="description_categorie" class="block text-sm font-semibold text-slate-300 mb-2">Description</label>
                            <textarea name="description_categorie" id="description_categorie" rows="4" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">{{ old('description_categorie', $categorie->description_categorie) }}</textarea>
                        </div>

                    </div>
                </x-erp.card>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row justify-end gap-4">
                    <a href="{{ route('categories.index') }}" class="px-6 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold text-center transition">
                        Annuler
                    </a>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-semibold shadow-lg shadow-amber-600/30 transition">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>