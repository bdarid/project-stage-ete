<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="Modifier le Mouvement" subtitle="Mettez à jour les informations du mouvement de stock sélectionné.">
            <a href="{{ route('stocks.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold transition">
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
                    <h3 class="font-semibold text-red-400 mb-3">Veuillez corriger les erreurs suivantes :</h3>
                    <ul class="list-disc ml-6 space-y-1 text-red-300 text-sm">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
                @csrf
                @method('PUT')

                <x-erp.card title="Édition du mouvement" subtitle="Modifiez les paramètres du mouvement ci-dessous.">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Produit --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Produit <span class="text-red-400">*</span></label>
                            <select name="produits_id" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                                @foreach($produits as $produit)
                                    <option value="{{ $produit->id }}" {{ old('produits_id', $stock->produits_id) == $produit->id ? 'selected' : '' }}>
                                        {{ $produit->nom_produit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Catégorie --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Catégorie <span class="text-red-400">*</span></label>
                            <select name="categorie_id" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('categorie_id', $stock->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->nom_categorie }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Mouvement --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Quantité de mouvement <span class="text-red-400">*</span></label>
                            <input type="number" name="mouvement_stock" value="{{ old('mouvement_stock', $stock->mouvement_stock) }}" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                            <p class="text-xs text-slate-500 mt-2">Positif (+) pour entrée, Négatif (-) pour sortie.</p>
                        </div>

                        {{-- Utilisateur --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Utilisateur <span class="text-red-400">*</span></label>
                            <select name="users_id" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('users_id', $stock->users_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name_users }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Achat associé --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Achat associé</label>
                            <select name="achat_id" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                                <option value="">-- Aucun --</option>
                                @foreach($achats as $achat)
                                    <option value="{{ $achat->id }}" {{ old('achat_id', $stock->achat_id) == $achat->id ? 'selected' : '' }}>Achat #{{ $achat->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Vente associée --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Vente associée</label>
                            <select name="vente_id" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                                <option value="">-- Aucune --</option>
                                @foreach($ventes as $vente)
                                    <option value="{{ $vente->id }}" {{ old('vente_id', $stock->vente_id) == $vente->id ? 'selected' : '' }}>Vente #{{ $vente->id }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </x-erp.card>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row justify-end gap-4 mt-6">
                    <a href="{{ route('stocks.index') }}" class="px-6 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold text-center transition">
                        Annuler
                    </a>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold shadow-lg shadow-green-600/20 transition">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>