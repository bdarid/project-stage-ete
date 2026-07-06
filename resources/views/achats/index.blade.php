<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Gestion des Achats
            </h2>

            <a href="{{ route('achats.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                + Nouvel Achat
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3 text-left">Produit</th>

                        <th class="px-6 py-3 text-left">Catégorie</th>

                        <th class="px-6 py-3 text-center">Qté</th>

                        <th class="px-6 py-3 text-center">Prix Achat</th>

                        <th class="px-6 py-3 text-center">Prix Vente</th>

                        <th class="px-6 py-3 text-center">Fournisseur</th>

                        <th class="px-6 py-3 text-center">Date</th>

                        <th class="px-6 py-3 text-center">Actions</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($achats as $achat)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                {{ $achat->produit->nom_produit ?? '-' }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $achat->categorie->nom_categorie ?? '-' }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                                    {{ $achat->quantite }}

                                </span>

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ number_format($achat->prix_achat,2) }} DH

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ number_format($achat->prix_vente,2) }} DH

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ $achat->nom_fournisseur }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ \Carbon\Carbon::parse($achat->date_achat)->format('d/m/Y') }}

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('achats.show',$achat->id) }}"
                                       class="bg-blue-500 text-white px-3 py-2 rounded-lg">
                                        Voir
                                    </a>

                                    <a href="{{ route('achats.edit',$achat->id) }}"
                                       class="bg-yellow-500 text-white px-3 py-2 rounded-lg">
                                        Modifier
                                    </a>

                                    <form method="POST"
                                          action="{{ route('achats.destroy',$achat->id) }}"
                                          onsubmit="return confirm('Supprimer cet achat ?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-red-600 text-white px-3 py-2 rounded-lg">

                                            Supprimer

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-10">

                                Aucun achat enregistré.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

                <div class="p-5">

                    {{ $achats->links() }}

                </div>

            </div>

        </div>
    </div>

</x-app-layout>