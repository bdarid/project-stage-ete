<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white">
                Détails du Mouvement de Stock
            </h2>

            <div class="flex gap-2">
                <a href="{{ route('stocks.edit', $stock->id) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                    Modifier
                </a>

                <a href="{{ route('stocks.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow-xl rounded-xl p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- Produit --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Produit
                        </label>

                        <div class="bg-gray-100 rounded-lg p-3 text-black">
                            {{ $stock->produit->nom_produit ?? 'Non défini' }}
                        </div>
                    </div>

                    {{-- Catégorie --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Catégorie
                        </label>

                        <div class="bg-gray-100 rounded-lg p-3 text-black">
                            {{ $stock->categorie->nom_categorie ?? 'Non définie' }}
                        </div>
                    </div>

                    {{-- Mouvement --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Mouvement
                        </label>

                        <div class="bg-gray-100 rounded-lg p-3">

                            @if($stock->mouvement_stock > 0)

                                <span class="text-green-600 font-bold text-lg">
                                    +{{ $stock->mouvement_stock }}
                                </span>

                            @elseif($stock->mouvement_stock < 0)

                                <span class="text-red-600 font-bold text-lg">
                                    {{ $stock->mouvement_stock }}
                                </span>

                            @else

                                <span class="font-bold">
                                    0
                                </span>

                            @endif

                        </div>
                    </div>

                    {{-- Type --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Type de mouvement
                        </label>

                        <div class="bg-gray-100 rounded-lg p-3 text-black">

                            @if($stock->achat_id)

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                    Achat
                                </span>

                            @elseif($stock->vente_id)

                                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full">
                                    Vente
                                </span>

                            @else

                                <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">
                                    Manuel
                                </span>

                            @endif

                        </div>
                    </div>

                    {{-- Achat --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Achat associé
                        </label>

                        <div class="bg-gray-100 rounded-lg p-3 text-black">

                            @if($stock->achat)

                                Achat #{{ $stock->achat->id }}

                            @else

                                Aucun

                            @endif

                        </div>
                    </div>

                    {{-- Vente --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Vente associée
                        </label>

                        <div class="bg-gray-100 rounded-lg p-3 text-black">

                            @if($stock->vente)

                                Vente #{{ $stock->vente->id }}

                            @else

                                Aucune

                            @endif

                        </div>
                    </div>

                    {{-- Utilisateur --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Utilisateur
                        </label>

                        <div class="bg-gray-100 rounded-lg p-3 text-black">
                            {{ $stock->users->name_users ?? 'Inconnu' }}
                        </div>
                    </div>

                    {{-- Date --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">
                            Date de création
                        </label>

                        <div class="bg-gray-100 rounded-lg p-3 text-black">
                            {{ $stock->created_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>

                </div>

                <div class="mt-10 flex justify-end gap-3">

                    <a href="{{ route('stocks.edit', $stock->id) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg">
                        Modifier
                    </a>

                    <form action="{{ route('stocks.destroy', $stock->id) }}"
                          method="POST"
                          onsubmit="return confirm('Voulez-vous vraiment supprimer ce mouvement ?')">

                        @csrf
                        @method('DELETE')

                        <button
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg">
                            Supprimer
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
