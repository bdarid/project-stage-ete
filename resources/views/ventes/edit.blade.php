<x-app-layout>

    <x-slot name="header">
        <x-erp.page-header
            title="Modifier la Vente : {{ $vente->numero_vente }}"
            subtitle="Modifiez les informations générales de cette vente."
        />
    </x-slot>

    <div class="space-y-6 pb-12">

        <x-erp.alert />

        <div class="max-w-6xl mx-auto">

            <x-erp.card
                title="Informations de la Vente"
                subtitle="Mettre à jour les données ci-dessous."
            >

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300">
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('ventes.update', $vente->id) }}" method="POST" class="space-y-8 p-2">
                    @csrf
                    @method('PUT')

                    {{-- Informations générales --}}
                    <div>
                        <h4 class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-700/50 pb-2">
                            Informations générales
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                            {{-- Numéro de Vente (lecture seule) --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    Numéro de Vente (Non modifiable)
                                </label>
                                <input type="text" value="{{ $vente->numero_vente }}" readonly
                                    class="w-full rounded-lg border-slate-700/50 bg-slate-800/50 text-slate-500 shadow-inner cursor-not-allowed text-sm focus:ring-0">
                            </div>

                            {{-- Date de la Vente --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    Date de la Vente
                                </label>
                                <input type="date" name="date_vente"
                                    value="{{ old('date_vente', \Carbon\Carbon::parse($vente->date_vente)->format('Y-m-d')) }}" required
                                    class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm [color-scheme:dark]">
                            </div>

                            {{-- Infos Client --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    Infos Client
                                </label>
                                <input type="text" name="info_clients" value="{{ old('info_clients', $vente->info_clients) }}"
                                    placeholder="Nom, Téléphone..."
                                    class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                            </div>

                            {{-- Mode de Paiement --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    Mode de Paiement
                                </label>
                                <select name="mode_payment" required
                                    class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                                    <option value="Espèces" {{ $vente->mode_payment == 'Espèces' ? 'selected' : '' }}>Espèces</option>
                                    <option value="Carte Bancaire" {{ $vente->mode_payment == 'Carte Bancaire' ? 'selected' : '' }}>Carte Bancaire</option>
                                    <option value="Chèque" {{ $vente->mode_payment == 'Chèque' ? 'selected' : '' }}>Chèque</option>
                                    <option value="Virement" {{ $vente->mode_payment == 'Virement' ? 'selected' : '' }}>Virement</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    {{-- Articles rattachés à cette vente --}}
                    <div>
                        <div class="border-b border-slate-700/50 pb-2 mb-4">
                            <h4 class="text-sm font-medium text-slate-400 uppercase tracking-wider">
                                Articles rattachés à cette vente
                            </h4>
                            <p class="text-xs text-slate-500 mt-1">
                                Pour des raisons de cohérence de stock et de facturation, les articles d'une vente validée ne peuvent pas être modifiés directement d'ici.
                            </p>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-slate-900/40 border-b border-slate-700">
                                    <tr class="text-slate-400 uppercase text-xs tracking-wider">
                                        <th class="px-4 py-3 text-left">Produit</th>
                                        <th class="px-4 py-3 text-center">Quantité Vendue</th>
                                        <th class="px-4 py-3 text-right">Prix Unitaire</th>
                                        <th class="px-4 py-3 text-right">Sous-total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700">
                                    @php $totalGlobal = 0; @endphp
                                    @foreach($vente->venteitems as $item)
                                        @php
                                            $sousTotal = $item->quantite * $item->prix_unitaire;
                                            $totalGlobal += $sousTotal;
                                        @endphp
                                        <tr class="hover:bg-slate-700/30 transition">
                                            <td class="px-4 py-3">
                                                <span class="text-slate-200">{{ $item->achat->produit->nom_produit ?? 'Produit Inconnu' }}</span>
                                                <span class="text-xs text-slate-500 block">Lot Achat #{{ $item->achat_id }}</span>
                                            </td>
                                            <td class="px-4 py-3 text-center font-medium text-slate-300">{{ $item->quantite }}</td>
                                            <td class="px-4 py-3 text-right text-slate-300">{{ number_format($item->prix_unitaire, 2) }} DH</td>
                                            <td class="px-4 py-3 text-right font-bold text-white">{{ number_format($sousTotal, 2) }} DH</td>
                                        </tr>
                                    @endforeach
                                    <tr class="bg-slate-900/40 font-bold">
                                        <td colspan="3" class="px-4 py-4 text-right text-slate-300 uppercase text-xs tracking-wider">Total Actuel :</td>
                                        <td class="px-4 py-4 text-right text-blue-400 text-base">{{ number_format($totalGlobal, 2) }} DH</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Boutons d'action --}}
                    <div class="flex justify-end gap-3 border-t border-slate-700 pt-6 mt-8">
                        <a href="{{ route('ventes.index') }}"
                           class="px-5 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition shadow-sm">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold transition shadow-sm">
                            Mettre à jour la Vente
                        </button>
                    </div>

                </form>

            </x-erp.card>

        </div>

    </div>

</x-app-layout>