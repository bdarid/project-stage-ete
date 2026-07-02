<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Stocks & Produits') }}
            </h2>
            <a href="{{ route('produits.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                + Nouveau Produit
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border-b py-3 px-4 font-semibold text-sm">Référence</th>
                            <th class="border-b py-3 px-4 font-semibold text-sm">Nom du produit</th>
                            <th class="border-b py-3 px-4 font-semibold text-sm">Prix de vente</th>
                            <th class="border-b py-3 px-4 font-semibold text-sm">Prix d'achat</th>
                            <th class="border-b py-3 px-4 font-semibold text-sm">Quantité</th>
                            <th class="border-b py-3 px-4 font-semibold text-sm">Date d'expiration</th>
                            <th class="border-b py-3 px-4 font-semibold text-sm">Statut / Alerte</th>
                            <th class="border-b py-3 px-4 font-semibold text-sm">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produits as $produit)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border-b py-3 px-4">{{ $produit->reference }}</td>
                                <td class="border-b py-3 px-4 font-medium">{{ $produit->nom_produit }}</td>
                                <td class="border-b py-3 px-4">{{ number_format($produit->prix_vente_moy, 2) }} MAD</td>
                                <td class="border-b py-3 px-4">{{ number_format($produit->prix_achat_moy, 2) }} MAD</td>
                                <td class="border-b py-3 px-4">{{ $produit->quantite_produit }}</td>
                                <td class="border-b py-3 px-4">{{ $produit->date_expiration }}</td>
                                <td class="border-b py-3 px-4">
                                    @if($produit->quantite_produit == 0)
                                        <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded">Rupture</span>
                                    @elseif($produit->quantite_produit <= 5)
                                        <span class="bg-orange-100 text-orange-800 text-xs font-bold px-2 py-1 rounded">Alerte (Bas)</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">En Stock</span>
                                    @endif
                                <td class="border-b py-3 px-4">
                                    <div class="flex items-center gap-4">

                                        <a href="{{ route('produits.edit', $produit->id) }}" class="text-yellow-600 hover:text-yellow-800 font-semibold bg-yellow-100 hover:bg-yellow-200 px-3 py-1 rounded transition duration-200">
                                            Modifier
                                        </a>

                                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Es-tu sûr de vouloir supprimer définitivement ce produit ?');" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold bg-red-100 hover:bg-red-200 px-3 py-1 rounded transition duration-200">
                                                Supprimer
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($produits->isEmpty())
                        <div class="text-center py-6 text-gray-500">
                            Aucun produit en stock pour le moment.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
