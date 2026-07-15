<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="Ajouter un nouveau Produit" subtitle="Création d'une nouvelle fiche produit pour votre catalogue.">
            <a href="{{ route('produits.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Retour
            </a>
        </x-erp.page-header>
    </x-slot>

    <div class="space-y-6 pb-12">
        <x-erp.alert />

        {{-- Affichage global des erreurs de validation --}}
        @if($errors->any())
            <div class="rounded-2xl border border-red-500/40 bg-red-500/10 p-5">
                <h3 class="font-semibold text-red-400 mb-3">Veuillez corriger les erreurs suivantes :</h3>
                <ul class="list-disc ml-6 space-y-1 text-red-300 text-sm">
                    @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produits.store') }}" method="POST" class="space-y-6">
            @csrf

            <x-erp.card title="Informations du produit" subtitle="Renseignez les détails du nouveau produit à ajouter au stock.">
                
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    
                    {{-- Référence --}}
                    <div>
                        <label for="reference" class="block text-sm font-semibold text-slate-300 mb-2">Référence du produit</label>
                        <input type="text" name="reference" id="reference" value="{{ old('reference') }}" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                    </div>

                    {{-- Nom du Produit --}}
                    <div class="md:col-span-1 xl:col-span-2">
                        <label for="nom_produit" class="block text-sm font-semibold text-slate-300 mb-2">Nom du Produit</label>
                        <input type="text" name="nom_produit" id="nom_produit" value="{{ old('nom_produit') }}" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                    </div>

                    {{-- Prix Achat --}}
                    <div>
                        <label for="prix_achat_moy" class="block text-sm font-semibold text-slate-300 mb-2">Prix d'Achat (MAD)</label>
                        <input type="number" step="0.01" name="prix_achat_moy" id="prix_achat_moy" value="{{ old('prix_achat_moy') }}" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                    </div>

                    {{-- Prix Vente --}}
                    <div>
                        <label for="prix_vente_moy" class="block text-sm font-semibold text-slate-300 mb-2">Prix de Vente (MAD)</label>
                        <input type="number" step="0.01" name="prix_vente_moy" id="prix_vente_moy" value="{{ old('prix_vente_moy') }}" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                    </div>

                    {{-- Quantité Initiale --}}
                    <div>
                        <label for="quantite_produit" class="block text-sm font-semibold text-slate-300 mb-2">Quantité Initiale</label>
                        <input type="number" name="quantite_produit" id="quantite_produit" value="{{ old('quantite_produit') }}" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                    </div>

                    {{-- Date Expiration --}}
                    <div>
                        <label for="date_expiration" class="block text-sm font-semibold text-slate-300 mb-2">Date d'Expiration</label>
                        <input type="date" name="date_expiration" id="date_expiration" value="{{ old('date_expiration') }}" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                    </div>

                    {{-- Catégorie ID --}}
                    <div>
                        <div>
    <label for="categorie_id" class="block text-sm font-semibold text-slate-300 mb-2">
        Catégorie
    </label>

    <select
        name="categorie_id"
        id="categorie_id"
        class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
        required>

        <option value="">Sélectionnez une catégorie</option>

        @foreach($categories as $categorie)
            <option
                value="{{ $categorie->id }}"
                {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                {{ $categorie->nom_categorie }}
            </option>
        @endforeach

    </select>
</div>
                    </div>
                </div>

            </x-erp.card>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row justify-end gap-4 mt-6">
                <a href="{{ route('produits.index') }}" class="px-6 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold text-center transition">
                    Annuler
                </a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg shadow-blue-500/30 transition">
                    Enregistrer le produit
                </button>
            </div>

        </form>
    </div>
</x-app-layout>