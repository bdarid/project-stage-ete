<x-app-layout>

    <x-slot name="header">
        <x-erp.page-header
            title="Gestion des Achats"
            subtitle="Consultez et gérez tous les achats de l'entreprise."
        >
        </x-erp.page-header>
    </x-slot>

    {{-- Bouton Nouvel Achat --}}
    <div class="mb-6">
        <a href="{{ route('achats.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 rounded-xl font-semibold text-white transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouvel Achat
        </a>
    </div>

    <div class="space-y-6">

        {{-- Remplace ton ancien bloc @if(session('success')) --}}
        <x-erp.alert />

        <x-erp.card
            title="Liste des Achats"
            subtitle="Tous les achats enregistrés."
            :count="$achats->total()"
            label="Achats"
        >

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-900/40 border-b border-slate-700">
                        <tr class="text-slate-400 uppercase text-xs tracking-wider">
                            <th class="px-6 py-4 text-left">Produit & Catégorie</th>
                            <th class="px-6 py-4 text-center">Qté</th>
                            <th class="px-6 py-4 text-center">Prix Achat</th>
                            <th class="px-6 py-4 text-center">Prix Vente</th>
                            <th class="px-6 py-4 text-center">Fournisseur</th>
                            <th class="px-6 py-4 text-center">Date</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-700">
                        @forelse($achats as $achat)
                            <tr class="hover:bg-slate-700/30 transition">

                                {{-- Produit et Catégorie fusionnés pour le design --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-11 h-11 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">
                                            {{ strtoupper(substr($achat->produit->nom_produit ?? 'P', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-white">
                                                {{ $achat->produit->nom_produit ?? '-' }}
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                {{ $achat->categorie->nom_categorie ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Quantité --}}
                                <td class="px-6 py-5 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-semibold">
                                        {{ $achat->quantite }}
                                    </span>
                                </td>

                                {{-- Prix Achat --}}
                                <td class="px-6 py-5 text-center font-medium text-slate-300">
                                    {{ number_format($achat->prix_achat, 2) }} DH
                                </td>

                                {{-- Prix Vente --}}
                                <td class="px-6 py-5 text-center font-medium text-slate-300">
                                    {{ number_format($achat->prix_vente, 2) }} DH
                                </td>

                                {{-- Fournisseur --}}
                                <td class="px-6 py-5 text-center text-slate-400">
                                    {{ $achat->nom_fournisseur }}
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-5 text-center text-slate-400">
                                    {{ \Carbon\Carbon::parse($achat->date_achat)->format('d/m/Y') }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-5">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('achats.show', $achat->id) }}"
                                           class="px-3 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">
                                            Voir
                                        </a>

                                        <a href="{{ route('achats.edit', $achat->id) }}"
                                           class="px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">
                                            Modifier
                                        </a>

                                        <form action="{{ route('achats.destroy', $achat->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer cet achat ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-14 text-center">
                                    <div class="text-slate-500">
                                        <svg class="mx-auto w-12 h-12 mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                                        </svg>
                                        <p class="text-lg">Aucun achat enregistré.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination customisée --}}
            @if(method_exists($achats, 'links'))
                <div class="px-6 py-5 border-t border-slate-700 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-slate-400">
                        Affichage de
                        <span class="font-semibold text-white">{{ $achats->firstItem() ?? 0 }}</span>
                        à
                        <span class="font-semibold text-white">{{ $achats->lastItem() ?? 0 }}</span>
                        sur
                        <span class="font-semibold text-white">{{ $achats->total() ?? 0 }}</span>
                        achats
                    </div>
                    <div>
                        {{ $achats->links() }}
                    </div>
                </div>
            @endif

        </x-erp.card>

    </div>

</x-app-layout>