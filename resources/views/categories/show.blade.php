<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('categories.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-2xl text-white">
                Détails de la Catégorie
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $categorie->nom_categorie }}</h3>

                    <div class="mb-4">
                        <span class="text-xs font-semibold text-gray-500 uppercase">Hiérarchie</span>
                        <p class="mt-1">
                            @if($categorie->parent)
                                Sous-catégorie de : <span class="font-medium text-blue-600">{{ $categorie->parent->nom_categorie }}</span>
                            @else
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Catégorie Principale</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-6">
                        <span class="text-xs font-semibold text-gray-500 uppercase">Description</span>
                        <p class="mt-1 text-gray-700 text-sm">
                            {{ $categorie->description_categorie ?? 'Aucune description fournie.' }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <a href="{{ route('categories.edit', $categorie->id) }}" class="block text-center w-full bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Modifier cette catégorie
                        </a>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 space-y-6">

                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h4 class="font-bold text-gray-700">Sous-catégories ({{ $categorie->sousCategories->count() }})</h4>
                    </div>
                    <div class="p-6">
                        @if($categorie->sousCategories->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($categorie->sousCategories as $sousCat)
                                    <a href="{{ route('categories.show', $sousCat->id) }}" class="bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-2 rounded-lg text-sm font-medium border border-blue-200 transition-colors">
                                        {{ $sousCat->nom_categorie }}
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm italic">Cette catégorie ne contient aucune sous-catégorie.</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h4 class="font-bold text-gray-700">Produits dans cette catégorie ({{ $categorie->produits->count() }})</h4>
                    </div>
                    <div class="p-0">
                        @if($categorie->produits->count() > 0)
                            <ul class="divide-y divide-gray-100">
                                @foreach($categorie->produits as $produit)
                                    <li class="px-6 py-3 hover:bg-gray-50 flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-800">{{ $produit->nom_produit }}</span>
                                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Stock: {{ $produit->stock_actuel ?? 0 }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="p-6 text-gray-500 text-sm italic">
                                Aucun produit n'est actuellement rattaché à cette catégorie.
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
