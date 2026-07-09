<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white">
                Gestion des Stocks
            </h2>

            <a href="{{ route('stocks.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                + Nouveau Mouvement
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-5 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-xl overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-100 text-black">
                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                Produit
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                Catégorie
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                Mouvement
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                Type
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                Utilisateur
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                Date
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                Actions
                            </th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-black">

                    @forelse($stocks as $stock)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-800">
                                    {{ $stock->produit->nom_produit ?? '-' }}
                                </div>

                            </td>

                            <td class="px-6 py-4">

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs">

                                    {{ $stock->categorie->nom_categorie ?? '-' }}

                                </span>

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($stock->mouvement_stock > 0)

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">

                                        +{{ $stock->mouvement_stock }}

                                    </span>

                                @elseif($stock->mouvement_stock < 0)

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full font-semibold">

                                        {{ $stock->mouvement_stock }}

                                    </span>

                                @else

                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">

                                        0

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-center">

                                @if($stock->achat_id)

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">

                                        Achat

                                    </span>

                                @elseif($stock->vente_id)

                                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs">

                                        Vente

                                    </span>

                                @else

                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs">

                                        Manuel

                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ $stock->users->name_users ?? '-' }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ $stock->created_at->format('d/m/Y H:i') }}

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('stocks.show',$stock->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg">
                                        Voir
                                    </a>

                                    <a href="{{ route('stocks.edit',$stock->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">
                                        Modifier
                                    </a>

                                    <form action="{{ route('stocks.destroy',$stock->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Supprimer ce mouvement ?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">

                                            Supprimer

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-10 text-gray-500">

                                Aucun mouvement de stock enregistré.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

                <div class="p-5">

                    {{ $stocks->links() }}

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
