<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Ajouter un nouveau Produit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('produits.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="reference" class="block text-gray-700 font-bold mb-2">Référence</label>
                                <input type="text" name="reference" id="reference" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div>
                                <label for="nom_produit" class="block text-gray-700 font-bold mb-2">Nom du Produit</label>
                                <input type="text" name="nom_produit" id="nom_produit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="prix_achat_moy" class="block text-gray-700 font-bold mb-2">Prix d'Achat (MAD)</label>
                                <input type="number" step="0.01" name="prix_achat_moy" id="prix_achat_moy" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div>
                                <label for="prix_vente_moy" class="block text-gray-700 font-bold mb-2">Prix de Vente (MAD)</label>
                                <input type="number" step="0.01" name="prix_vente_moy" id="prix_vente_moy" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div>
                                <label for="quantite_produit" class="block text-gray-700 font-bold mb-2">Quantité Initiale</label>
                                <input type="number" name="quantite_produit" id="quantite_produit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div>
                                <label for="date_expiration" class="block text-gray-700 font-bold mb-2">Date d'Expiration</label>
                                <input type="date" name="date_expiration" id="date_expiration" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div>
                                <label for="categorie_id" class="block text-gray-700 font-bold mb-2">ID Catégorie</label>
                                <input type="number" name="categorie_id" id="categorie_id" placeholder="Ex: 1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-8">
                            <a href="{{ route('produits.index') }}" class="text-gray-500 hover:text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Annuler
                            </a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                                Enregistrer le produit
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
