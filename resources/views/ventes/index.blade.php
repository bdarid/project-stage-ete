<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header
            title="Gestion des Ventes"
            subtitle="Consultez et gérez toutes les ventes enregistrées."
        >

           

        </x-erp.page-header>

    </x-slot>
     <a
                href="{{ route('ventes.create') }}"
                class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 rounded-xl font-semibold text-white transition">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4"/>

                </svg>

                Nouvelle Vente

            </a>

    <div class="space-y-6">

        <x-erp.alert />

        <x-erp.card
            title="Liste des Ventes"
            subtitle="Toutes les ventes enregistrées."
            :count="$ventes->total()"
            label="Ventes"
        >

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-slate-900/40 border-b border-slate-700">

                        <tr class="text-slate-400 uppercase text-xs tracking-wider">

                            <th class="px-6 py-4 text-left">
                                N° Vente
                            </th>

                            <th class="px-6 py-4 text-left">
                                Client
                            </th>

                            <th class="px-6 py-4 text-left">
                                Catégorie
                            </th>

                            <th class="px-6 py-4 text-center">
                                Paiement
                            </th>

                            <th class="px-6 py-4 text-center">
                                Date
                            </th>

                            <th class="px-6 py-4 text-center">
                                Total
                            </th>

                            <th class="px-6 py-4 text-right">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-700">
                                            @forelse($ventes as $vente)

                            @php
                                $total = $vente->venteitems->sum(function ($item) {
                                    return $item->quantite * $item->prix_unitaire;
                                });
                            @endphp

                            <tr class="hover:bg-slate-700/30 transition">

                                {{-- Numéro de vente --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        <div class="w-11 h-11 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">
                                            {{ strtoupper(substr($vente->numero_vente,0,1)) }}
                                        </div>

                                        <div>

                                            <p class="font-semibold text-white">
                                                {{ $vente->numero_vente }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                Vente
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                {{-- Client --}}
                                <td class="px-6 py-5 text-slate-300">

                                    {{ $vente->info_clients ?? 'Client Comptoir' }}

                                </td>

                                {{-- Catégorie --}}
                                <td class="px-6 py-5">

                                    @if($vente->categorie)

                                        <span class="inline-flex px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-semibold">

                                            {{ $vente->categorie->nom_categorie }}

                                        </span>

                                    @else

                                        <span class="text-slate-500">
                                            Aucune
                                        </span>

                                    @endif

                                </td>

                                {{-- Paiement --}}
                                <td class="px-6 py-5 text-center">

                                    <span class="inline-flex px-3 py-1 rounded-full bg-purple-500/10 text-purple-400 text-xs font-semibold">

                                        {{ $vente->mode_payment }}

                                    </span>

                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-5 text-center text-slate-300">

                                    {{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}

                                </td>

                                {{-- Total --}}
                                <td class="px-6 py-5 text-center">

                                    <span class="text-lg font-bold text-emerald-400">

                                        {{ number_format($total,2) }} DH

                                    </span>

                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-2">

                                        <a
                                            href="{{ route('ventes.show',$vente->id) }}"
                                            class="px-3 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">

                                            Voir

                                        </a>

                                        <a
                                            href="{{ route('ventes.edit',$vente->id) }}"
                                            class="px-3 py-2 rounded-lg bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium transition">

                                            Modifier

                                        </a>

                                        <form
                                            action="{{ route('ventes.destroy',$vente->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Supprimer cette vente ?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
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

                                    <svg
                                        class="mx-auto w-12 h-12 mb-3 opacity-50"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>

                                    </svg>

                                    <p class="text-lg">

                                        Aucune vente enregistrée.

                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            @if(method_exists($ventes,'links'))

                <div class="px-6 py-5 border-t border-slate-700 flex items-center justify-between">

                    <div class="text-sm text-slate-400">

                        Affichage de

                        <span class="font-semibold text-white">

                            {{ $ventes->firstItem() }}

                        </span>

                        à

                        <span class="font-semibold text-white">

                            {{ $ventes->lastItem() }}

                        </span>

                        sur

                        <span class="font-semibold text-white">

                            {{ $ventes->total() }}

                        </span>

                        ventes

                    </div>

                    <div>

                        {{ $ventes->links() }}

                    </div>

                </div>

            @endif

        </x-erp.card>

    </div>

</x-app-layout>
