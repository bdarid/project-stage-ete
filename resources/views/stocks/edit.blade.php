<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Modifier un Mouvement de Stock
            </h2>

            <a href="{{ route('stocks.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-8">
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

            <div class="bg-white shadow-xl rounded-xl p-8">

                <form action="{{ route('stocks.update',$stock->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Produit --}}
                        <div>
                            <label class="font-semibold">
                                Produit
                            </label>

                            <select
                                name="produits_id"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>

                                @foreach($produits as $produit)

                                    <option
                                        value="{{ $produit->id }}"
                                        {{ old('produits_id',$stock->produits_id)==$produit->id ? 'selected' : '' }}>

                                        {{ $produit->nom_produit }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        {{-- Catégorie --}}
                        <div>
                            <label class="font-semibold">
                                Catégorie
                            </label>

                            <select
                                name="categorie_id"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>

                                @foreach($categories as $categorie)

                                    <option
                                        value="{{ $categorie->id }}"
                                        {{ old('categorie_id',$stock->categorie_id)==$categorie->id ? 'selected' : '' }}>

                                        {{ $categorie->nom_categorie }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        {{-- Mouvement --}}
                        <div>
                            <label class="font-semibold">
                                Mouvement du stock
                            </label>

                            <input
                                type="number"
                                name="mouvement_stock"
                                value="{{ old('mouvement_stock',$stock->mouvement_stock) }}"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>

                            <small class="text-gray-500">
                                Positif = Entrée &nbsp; | &nbsp; Négatif = Sortie
                            </small>
                        </div>

                        {{-- Utilisateur --}}
                        <div>
                            <label class="font-semibold">
                                Utilisateur
                            </label>

                            <select
                                name="users_id"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>

                                @foreach($users as $user)

                                    <option
                                        value="{{ $user->id }}"
                                        {{ old('users_id',$stock->users_id)==$user->id ? 'selected' : '' }}>

                                        {{ $user->name_users }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        {{-- Achat --}}
                        <div>
                            <label class="font-semibold">
                                Achat associé
                            </label>

                            <select
                                name="achat_id"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm">

                                <option value="">Aucun</option>

                                @foreach($achats as $achat)

                                    <option
                                        value="{{ $achat->id }}"
                                        {{ old('achat_id',$stock->achat_id)==$achat->id ? 'selected' : '' }}>

                                        Achat #{{ $achat->id }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        {{-- Vente --}}
                        <div>
                            <label class="font-semibold">
                                Vente associée
                            </label>

                            <select
                                name="vente_id"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm">

                                <option value="">Aucune</option>

                                @foreach($ventes as $vente)

                                    <option
                                        value="{{ $vente->id }}"
                                        {{ old('vente_id',$stock->vente_id)==$vente->id ? 'selected' : '' }}>

                                        Vente #{{ $vente->id }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end gap-3">

                        <a href="{{ route('stocks.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">

                            Annuler

                        </a>

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">

                            Enregistrer les modifications

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>