<x-app-layout>

    <x-slot name="header">
        <x-erp.page-header
            title="Modifier l'Achat #{{ $achat->id }}"
            subtitle="Modifiez les informations et les détails financiers relatifs à cet achat."
        />
    </x-slot>

    <div class="space-y-6 pb-12">

        <x-erp.alert />

        <div class="max-w-5xl mx-auto">

            <x-erp.card
                title="Informations de l'achat"
                subtitle="Mettre à jour les données ci-dessous."
            >

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300">
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('achats.update', $achat->id) }}" method="POST" class="space-y-8 p-2">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Sélecteur de Produit --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-300 mb-2" for="produit">
                                Produit
                            </label>
                            <select
                                id="produit"
                                name="produits_id"
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                required>
                                @foreach($produits as $produit)
                                    <option
                                        value="{{ $produit->id }}"
                                        data-categorie="{{ $produit->categorie_id }}"
                                        data-nomcategorie="{{ $produit->categorie->nom_categorie }}"
                                        data-prixachat="{{ $produit->prix_achat_moy }}"
                                        data-prixvente="{{ $produit->prix_vente_moy }}"
                                        data-stock="{{ $produit->stock_actuel }}"
                                        data-reference="{{ $produit->reference }}"
                                        data-expiration="{{ $produit->date_expiration }}"
                                        {{ $achat->produits_id == $produit->id ? 'selected' : '' }}>
                                        {{ $produit->nom_produit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- BLOC : Informations générées automatiquement (Lecture seule) --}}
                        <div class="md:col-span-2 mt-2">
                            <h4 class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-700/50 pb-2">
                                Données du produit (Auto-rempli)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                {{-- Catégorie --}}
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 mb-2">Catégorie</label>
                                    <input id="categorie_nom" value="{{ $achat->categorie->nom_categorie }}" class="w-full rounded-lg border-slate-700/50 bg-slate-800/50 text-slate-500 shadow-inner cursor-not-allowed text-sm focus:ring-0" readonly>
                                    <input type="hidden" id="categorie_id" name="categorie_id" value="{{ $achat->categorie_id }}">
                                </div>

                                {{-- Référence --}}
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 mb-2">Référence</label>
                                    <input id="reference" value="{{ $achat->produit->reference }}" class="w-full rounded-lg border-slate-700/50 bg-slate-800/50 text-slate-500 shadow-inner cursor-not-allowed text-sm focus:ring-0" readonly>
                                </div>

                                {{-- Stock actuel --}}
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 mb-2">Stock actuel</label>
                                    <input id="stock" value="{{ $achat->produit->stock_actuel }}" class="w-full rounded-lg border-slate-700/50 bg-slate-800/50 text-slate-500 shadow-inner cursor-not-allowed text-sm focus:ring-0" readonly>
                                </div>

                                {{-- Date d'expiration --}}
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 mb-2">Date d'expiration</label>
                                    <input id="expiration" value="{{ $achat->produit->date_expiration }}" class="w-full rounded-lg border-slate-700/50 bg-slate-800/50 text-slate-500 shadow-inner cursor-not-allowed text-sm focus:ring-0" readonly>
                                </div>
                            </div>
                        </div>

                        {{-- BLOC : Détails de la transaction --}}
                        <div class="md:col-span-2 mt-4">
                            <h4 class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-700/50 pb-2">
                                Détails de la transaction
                            </h4>
                        </div>

                        {{-- Fournisseur --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Fournisseur</label>
                            <input type="text" name="nom_fournisseur" value="{{ $achat->nom_fournisseur }}" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm" required>
                        </div>

                        {{-- Utilisateur --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Utilisateur (Acheteur)</label>
                            <select name="users_id" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $achat->users_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name_users ?? $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Date Achat --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Date d'achat</label>
                            <input type="date" name="date_achat" value="{{ $achat->date_achat }}" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm" required>
                        </div>

                        {{-- Quantité --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Quantité</label>
                            <input type="number" name="quantite" min="1" value="{{ $achat->quantite }}" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm" required>
                        </div>

                        {{-- Prix Achat --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Prix d'achat unitaire (DH)</label>
                            <input type="number" step="0.01" id="prix_achat" name="prix_achat" value="{{ $achat->prix_achat }}" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm" required>
                        </div>

                        {{-- Prix Vente --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Prix de vente unitaire (DH)</label>
                            <input type="number" step="0.01" id="prix_vente" name="prix_vente" value="{{ $achat->prix_vente }}" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm" required>
                        </div>

                        {{-- Commentaire --}}
                        <div class="md:col-span-2 mt-4">
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Commentaire (Optionnel)</label>
                            <textarea name="commentaire" rows="4" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm placeholder-slate-600" placeholder="Ajouter une note ou un commentaire...">{{ $achat->commentaire }}</textarea>
                        </div>

                    </div>

                    {{-- Boutons d'action --}}
                    <div class="flex justify-end gap-3 border-t border-slate-700 pt-6 mt-8">
                        <a href="{{ route('achats.index') }}"
                           class="px-5 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition shadow-sm">
                            Annuler
                        </a>

                        <button type="submit"
                            class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold transition shadow-sm">
                            Mettre à jour l'achat
                        </button>
                    </div>

                </form>

            </x-erp.card>

        </div>

    </div>

    {{-- Script pour la mise à jour automatique des champs --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const produitSelect = document.getElementById('produit');

            function majProduit() {
                let option = produitSelect.options[produitSelect.selectedIndex];

                document.getElementById('categorie_nom').value = option.dataset.nomcategorie || '-';
                document.getElementById('categorie_id').value = option.dataset.categorie || '';
                document.getElementById('reference').value = option.dataset.reference || '-';
                document.getElementById('stock').value = option.dataset.stock || '0';
                document.getElementById('expiration').value = option.dataset.expiration || '-';
                
                // Ne remplit les prix que s'ils ne sont pas déjà définis (pour éviter d'écraser les modifications de l'utilisateur)
                // Décommentez ces lignes si vous souhaitez forcer la mise à jour des prix au changement de produit
                /*
                document.getElementById('prix_achat').value = option.dataset.prixachat || '0';
                document.getElementById('prix_vente').value = option.dataset.prixvente || '0';
                */
            }

            produitSelect.addEventListener('change', majProduit);
            
            // On n'appelle pas majProduit() au chargement pour éviter d'écraser 
            // les prix_achat et prix_vente de $achat récupérés depuis la base de données.
        });
    </script>

</x-app-layout>