<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('ventes.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-2xl text-gray-800">
                Modifier la Vente : {{ $vente->numero_vente }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ventes.update', $vente->id) }}" method="POST" class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                @csrf
                @method('PUT')
                
                <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Informations Générales</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Numéro de Vente (Non modifiable)</label>
                        <input type="text" value="{{ $vente->numero_vente }}" class="w-full rounded-md border-gray-300 bg-gray-100 text-gray-500 shadow-sm cursor-not-allowed" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de la Vente</label>
                        <input type="date" name="date_vente" value="{{ old('date_vente', \Carbon\Carbon::parse($vente->date_vente)->format('Y-m-d')) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Infos Client</label>
                        <input type="text" name="info_clients" value="{{ old('info_clients', $vente->info_clients) }}" placeholder="Nom, Téléphone..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mode de Paiement</label>
                        <select name="mode_payment" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="Espèces" {{ $vente->mode_payment == 'Espèces' ? 'selected' : '' }}>Espèces</option>
                            <option value="Carte Bancaire" {{ $vente->mode_payment == 'Carte Bancaire' ? 'selected' : '' }}>Carte Bancaire</option>
                            <option value="Chèque" {{ $vente->mode_payment == 'Chèque' ? 'selected' : '' }}>Chèque</option>
                            <option value="Virement" {{ $vente->mode_payment == 'Virement' ? 'selected' : '' }}>Virement</option>
                        </select>
                    </div>
                </div>

                <div class="border-b pb-2 mb-4">
                    <h3 class="text-lg font-bold text-gray-700">Articles rattachés à cette vente</h3>
                    <p class="text-xs text-gray-400 mt-1">Pour des raisons de cohérence de stock et de facturation, les articles d'une vente validée ne peuvent pas être modifiés directement d'ici.</p>
                </div>

                <div class="overflow-x-auto mb-8">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-sm border-b border-gray-200">
                                <th class="p-3 font-semibold">Produit</th>
                                <th class="p-3 font-semibold text-center">Quantité Vendue</th>
                                <th class="p-3 font-semibold text-right">Prix Unitaire</th>
                                <th class="p-3 font-semibold text-right">Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalGlobal = 0; @endphp
                            @foreach($vente->venteitems as $item)
                                @php 
                                    $sousTotal = $item->quantite * $item->prix_unitaire;
                                    $totalGlobal += $sousTotal;
                                @endphp
                                <tr class="border-b border-gray-100 text-sm text-gray-700">
                                    <td class="p-3">
                                        {{ $item->achat->produit->nom_produit ?? 'Produit Inconnu' }}
                                        <span class="text-xs text-gray-400 block">Lot Achat #{{ $item->achat_id }}</span>
                                    </td>
                                    <td class="p-3 text-center font-medium">{{ $item->quantite }}</td>
                                    <td class="p-3 text-right">{{ number_format($item->prix_unitaire, 2) }} DH</td>
                                    <td class="p-3 text-right font-bold text-gray-800">{{ number_format($sousTotal, 2) }} DH</td>
                                </tr>
                            @endforeach
                            <tr class="bg-gray-50 font-bold">
                                <td colspan="3" class="p-3 text-right text-gray-700 uppercase">Total Actuel :</td>
                                <td class="p-3 text-right text-blue-600 text-base">{{ number_format($totalGlobal, 2) }} DH</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <a href="{{ route('ventes.index') }}" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg mr-3 hover:bg-gray-300 transition-colors">
                        Annuler
                    </a>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-2 rounded-lg font-bold shadow-sm transition-colors">
                        Mettre à jour la Vente
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>