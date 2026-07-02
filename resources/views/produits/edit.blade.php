<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le Produit : ') }} {{ $produit->nom_produit }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="reference" class="block text-gray-700 font-bold mb-2">Référence du produit</label>
                                <input type="text" name="reference" id="reference" value="{{ $produit->reference }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div>
                                <label for="nom_produit" class="block text-gray-700 font-bold mb-2">Nom du Produit</label>
                                <input type="text" name="nom_produit" id="nom_produit" value="{{ $produit->nom_produit }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="prix_achat_moy" class="block text-gray-700 font-bold mb-2">Prix d'Achat Moyen (MAD)</label>
                                <input type="number" step="0.01" name="prix_achat_moy" id="prix_achat_moy" value="{{ $produit->prix_achat_moy }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div>
                                <label for="prix_vente_moy" class="block text-gray-700 font-bold mb-2">Prix de Vente Moyen (MAD)</label>
                                <input type="number" step="0.01" name="prix_vente_moy" id="prix_vente_moy" value="{{ $produit->prix_vente_moy }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div>
                                <label for="quantite_produit" class="block text-gray-700 font-bold mb-2">Quantité globale</label>
                                <input type="number" name="quantite_produit" id="quantite_produit" value="{{ $produit->quantite_produit }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div>
                                <label for="date_expiration" class="block text-gray-700 font-bold mb-2">Date d'Expiration</label>
                                <input type="date" name="date_expiration" id="date_expiration" value="{{ $produit->date_expiration }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div>
                                <label for="categorie_id" class="block text-gray-700 font-bold mb-2">ID Catégorie</label>
                                <input type="number" name="categorie_id" id="categorie_id" value="{{ $produit->categorie_id }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="description_produit" class="block text-gray-700 font-bold mb-2">Description (Optionnelle)</label>
                            <textarea name="description_produit" id="description_produit" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $produit->description_produit }}</textarea>
                        </div>

                        <div class="flex items-center justify-between mt-8 pt-4 border-t border-gray-200">
                            <a href="{{ route('produits.index') }}" class="text-gray-500 hover:text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                                Annuler
                            </a>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-black font-bold json py-2 px-6 rounded shadow-md focus:outline-none focus:shadow-outline transition duration-200">
                                Enregistrer les modifications
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
