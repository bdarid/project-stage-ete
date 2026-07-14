<x-app-layout>

    <x-slot name="header">
        <x-erp.page-header
            title="Nouvel Achat"
            subtitle="Enregistrez un nouvel achat dans le système et mettez à jour votre stock."
        />
    </x-slot>

    <div class="space-y-6">

        <x-erp.alert />

        <div class="max-w-5xl mx-auto">

            <x-erp.card
                title="Informations de l'Achat"
                subtitle="Complétez les détails du produit et du fournisseur ci-dessous."
            >

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('achats.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Produit --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Produit
                            </label>
                            <select id="produit" name="produits_id" required
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                                <option value="">-- Choisir un produit --</option>
                                @foreach($produits as $produit)
                                    <option value="{{ $produit->id }}"
                                        data-categorie="{{ $produit->categorie_id }}"
                                        data-nomcategorie="{{ $produit->categorie->nom_categorie ?? '' }}"
                                        data-prixachat="{{ $produit->prix_achat_moy }}"
                                        data-prixvente="{{ $produit->prix_vente_moy }}"
                                        data-stock="{{ $produit->stock_actuel }}"
                                        data-reference="{{ $produit->reference }}"
                                        data-expiration="{{ $produit->date_expiration }}">
                                        {{ $produit->nom_produit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Catégorie (Lecture seule) --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Catégorie
                            </label>
                            <input id="categorie_nom" type="text" readonly
                                class="w-full rounded-xl border-slate-700 bg-slate-800 text-slate-400 shadow-sm cursor-not-allowed">
                            <input type="hidden" id="categorie_id" name="categorie_id">
                        </div>

                        {{-- Référence (Lecture seule) --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Référence
                            </label>
                            <input id="reference" type="text" readonly
                                class="w-full rounded-xl border-slate-700 bg-slate-800 text-slate-400 shadow-sm cursor-not-allowed">
                        </div>

                        {{-- Stock actuel (Lecture seule) --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Stock actuel
                            </label>
                            <input id="stock" type="text" readonly
                                class="w-full rounded-xl border-slate-700 bg-slate-800 text-slate-400 shadow-sm cursor-not-allowed">
                        </div>

                        {{-- Date d'expiration (Lecture seule) --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Date d'expiration
                            </label>
                            <input id="expiration" type="text" readonly
                                class="w-full rounded-xl border-slate-700 bg-slate-800 text-slate-400 shadow-sm cursor-not-allowed">
                        </div>

                        {{-- Utilisateur --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Utilisateur
                            </label>
                            <select name="users_id" required
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name_users ?? $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2 border-t border-slate-700 my-2"></div>

                        {{-- Prix Achat --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Prix d'achat (DH)
                            </label>
                            <input id="prix_achat" type="number" step="0.01" name="prix_achat" required
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                        </div>

                        {{-- Prix Vente --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Prix de vente (DH)
                            </label>
                            <input id="prix_vente" type="number" step="0.01" name="prix_vente" required
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                        </div>

                        {{-- Quantité --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Quantité
                            </label>
                            <input type="number" name="quantite" min="1" required
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                        </div>

                        {{-- Date d'achat --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Date d'achat
                            </label>
                            <input type="date" name="date_achat" value="{{ date('Y-m-d') }}" required
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm [color-scheme:dark]">
                        </div>

                        {{-- Fournisseur --}}
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Fournisseur
                            </label>
                            <input type="text" name="nom_fournisseur" placeholder="Nom du fournisseur" required
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                        </div>

                        {{-- Commentaire --}}
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Commentaire
                            </label>
                            <textarea name="commentaire" rows="4" placeholder="Ajouter un commentaire (optionnel)"
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm"></textarea>
                        </div>

                    </div>

                    {{-- Boutons d'action --}}
                    <div class="flex justify-end gap-3 border-t border-slate-700 pt-6">
                        <a href="{{ route('achats.index') }}"
                           class="px-5 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                            Enregistrer l'achat
                        </button>
                    </div>

                </form>

            </x-erp.card>

        </div>

    </div>

    {{-- Script de remplissage automatique des champs --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const produitSelect = document.getElementById('produit');

            produitSelect.addEventListener('change', function () {
                let option = this.options[this.selectedIndex];

                if(option.value === ''){
                    document.getElementById('categorie_nom').value = '';
                    document.getElementById('categorie_id').value = '';
                    document.getElementById('reference').value = '';
                    document.getElementById('stock').value = '';
                    document.getElementById('expiration').value = '';
                    document.getElementById('prix_achat').value = '';
                    document.getElementById('prix_vente').value = '';
                    return;
                }

                document.getElementById('categorie_nom').value = option.dataset.nomcategorie || '';
                document.getElementById('categorie_id').value = option.dataset.categorie || '';
                document.getElementById('reference').value = option.dataset.reference || '';
                document.getElementById('stock').value = option.dataset.stock || '0';
                document.getElementById('expiration').value = option.dataset.expiration || '';
                document.getElementById('prix_achat').value = option.dataset.prixachat || '';
                document.getElementById('prix_vente').value = option.dataset.prixvente || '';
            });
        });
    </script>

</x-app-layout>