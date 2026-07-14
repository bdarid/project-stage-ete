<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header
            title="Gestion des Produits"
            subtitle="Consultez et gérez le catalogue des produits."
        >

            

        </x-erp.page-header>

    </x-slot>
    <a href="{{ route('produits.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                + Nouveau Produit

            </a>

    <div class="space-y-6">

        <x-erp.alert />

        <x-erp.card
            title="Catalogue Produits"
            subtitle="Tous les produits enregistrés."
            :count="$produits->count()"
            label="Produits"
        >

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-slate-900/40 border-b border-slate-700">

                        <tr class="text-slate-400 uppercase text-xs tracking-wider">

                            <th class="px-6 py-4 text-left">Produit</th>

                            <th class="px-6 py-4 text-center">Prix Vente</th>

                            <th class="px-6 py-4 text-center">Prix Achat</th>

                            <th class="px-6 py-4 text-center">Stock</th>

                            <th class="px-6 py-4 text-center">Expiration</th>

                            <th class="px-6 py-4 text-center">Statut</th>

                            <th class="px-6 py-4 text-right">Actions</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-700">

                        @forelse($produits as $produit)

                            <tr class="hover:bg-slate-700/30 transition">

                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        <div class="w-11 h-11 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">

                                            {{ strtoupper(substr($produit->nom_produit,0,1)) }}

                                        </div>

                                        <div>

                                            <p class="font-semibold text-white">

                                                {{ $produit->nom_produit }}

                                            </p>

                                            <p class="text-xs text-slate-500">

                                                Réf : {{ $produit->reference }}

                                            </p>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-6 py-5 text-center text-white">

                                    {{ number_format($produit->prix_vente_moy,2) }} DH

                                </td>

                                <td class="px-6 py-5 text-center text-white">

                                    {{ number_format($produit->prix_achat_moy,2) }} DH

                                </td>

                                <td class="px-6 py-5 text-center">

                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 font-semibold">

                                        {{ $produit->quantite_produit }}

                                    </span>

                                </td>

                                <td class="px-6 py-5 text-center text-slate-300">

                                    {{ $produit->date_expiration }}

                                </td>

                                <td class="px-6 py-5 text-center">

                                    @if($produit->quantite_produit == 0)

                                        <span class="inline-flex px-3 py-1 rounded-full bg-red-500/10 text-red-400 font-semibold">

                                            Rupture

                                        </span>

                                    @elseif($produit->quantite_produit <= 5)

                                        <span class="inline-flex px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-400 font-semibold">

                                            Stock faible

                                        </span>

                                    @else

                                        <span class="inline-flex px-3 py-1 rounded-full bg-green-500/10 text-green-400 font-semibold">

                                            En stock

                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-2">

                                        <a href="{{ route('produits.edit',$produit->id) }}"
                                           class="px-3 py-2 rounded-lg bg-yellow-600 hover:bg-yellow-700 text-white text-sm">

                                            Modifier

                                        </a>

                                        <form
                                            action="{{ route('produits.destroy',$produit->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Supprimer ce produit ?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm">

                                                Supprimer

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="py-14 text-center text-slate-500">

                                    <svg class="mx-auto w-12 h-12 mb-3 opacity-50"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5"/>

                                    </svg>

                                    Aucun produit enregistré.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </x-erp.card>

    </div>

</x-app-layout>