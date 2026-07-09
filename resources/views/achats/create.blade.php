<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white">
                Nouvel Achat
            </h2>

            <a href="{{ route('achats.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-8 text-black">
        <div class="max-w-5xl mx-auto">

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-lg p-4">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-xl p-8">

                <form action="{{ route('achats.store') }}" method="POST">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Produit --}}
                        <div>
                            <label class="block font-semibold text-gray-700">
                                Produit
                            </label>

                            <select
                                id="produit"
                                name="produits_id"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm text-black"
                                required>

                                <option value="">-- Choisir un produit --</option>

                                @foreach($produits as $produit)

                                    <option
                                        value="{{ $produit->id }}"
                                        data-categorie="{{ $produit->categorie_id }}"
                                        data-nomcategorie="{{ $produit->categorie->nom_categorie }}"
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

                        {{-- Catégorie --}}
                        <div>

                            <label class="block font-semibold text-gray-700">
                                Catégorie
                            </label>

                            <input
                                id="categorie_nom"
                                class="w-full mt-2 rounded-lg border-gray-300 bg-gray-100 shadow-sm "
                                readonly>

                            <input
                                type="hidden"
                                id="categorie_id"
                                name="categorie_id">

                        </div>

                        {{-- Référence --}}
                        <div>

                            <label class="block font-semibold text-gray-700">
                                Référence
                            </label>

                            <input
                                id="reference"
                                class="w-full mt-2 rounded-lg border-gray-300 bg-gray-100 shadow-sm"
                                readonly>

                        </div>

                        {{-- Stock actuel --}}
                        <div>

                            <label class="block font-semibold text-gray-700">
                                Stock actuel
                            </label>

                            <input
                                id="stock"
                                class="w-full mt-2 rounded-lg border-gray-300 bg-gray-100 shadow-sm"
                                readonly>

                        </div>

                        {{-- Date d'expiration --}}
                        <div>

                            <label class="block font-semibold text-gray-700">
                                Date d'expiration
                            </label>

                            <input
                                id="expiration"
                                class="w-full mt-2 rounded-lg border-gray-300 bg-gray-100 shadow-sm"
                                readonly>

                        </div>

                        {{-- Prix Achat --}}
                        <div>

                            <label class="block font-semibold text-gray-700">
                                Prix d'achat (DH)
                            </label>

                            <input
                                id="prix_achat"
                                type="number"
                                step="0.01"
                                name="prix_achat"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>

                        </div>

                        {{-- Prix Vente --}}
                        <div>

                            <label class="block font-semibold text-gray-700">
                                Prix de vente (DH)
                            </label>

                            <input
                                id="prix_vente"
                                type="number"
                                step="0.01"
                                name="prix_vente"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>

                        </div>
                                                {{-- Quantité --}}
                        <div>

                            <label class="block font-semibold text-gray-700">
                                Quantité
                            </label>

                            <input
                                type="number"
                                name="quantite"
                                min="1"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>

                        </div>

                        {{-- Fournisseur --}}
                        <div>

                            <label class="block font-semibold text-gray-700">
                                Fournisseur
                            </label>

                            <input
                                type="text"
                                name="nom_fournisseur"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                placeholder="Nom du fournisseur"
                                required>

                        </div>

                        {{-- Date d'achat --}}
                        <div>

                            <label class="block font-semibold text-gray-700">
                                Date d'achat
                            </label>

                            <input
                                type="date"
                                name="date_achat"
                                value="{{ date('Y-m-d') }}"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>

                        </div>

                        {{-- Utilisateur --}}
                        <div>

                            <label class="block font-semibold text-gray-700">
                                Utilisateur
                            </label>

                            <select
                                name="users_id"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>

                                @foreach($users as $user)

                                    <option value="{{ $user->id }}">

                                        {{ $user->name_users }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    {{-- Commentaire --}}
                    <div class="mt-6">

                        <label class="block font-semibold text-gray-700">
                            Commentaire
                        </label>

                        <textarea
                            name="commentaire"
                            rows="5"
                            class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                            placeholder="Ajouter un commentaire (optionnel)"></textarea>

                    </div>

                    {{-- Boutons --}}
                    <div class="mt-8 flex justify-end gap-4">

                        <a href="{{ route('achats.index') }}"
                           class="px-6 py-2 rounded-lg bg-gray-500 text-white hover:bg-gray-600">

                            Annuler

                        </a>

                        <button
                            type="submit"
                            class="px-6 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">

                            Enregistrer l'achat

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>

        const produit = document.getElementById('produit');

        produit.addEventListener('change', function () {

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

            document.getElementById('categorie_nom').value =
                option.dataset.nomcategorie;

            document.getElementById('categorie_id').value =
                option.dataset.categorie;

            document.getElementById('reference').value =
                option.dataset.reference;

            document.getElementById('stock').value =
                option.dataset.stock;

            document.getElementById('expiration').value =
                option.dataset.expiration;

            document.getElementById('prix_achat').value =
                option.dataset.prixachat;

            document.getElementById('prix_vente').value =
                option.dataset.prixvente;

        });

    </script>

</x-app-layout>
