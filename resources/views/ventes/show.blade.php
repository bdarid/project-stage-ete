<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('ventes.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-2xl text-gray-800">
                Détails de la Vente : {{ $vente->numero_vente }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                
                <div class="bg-gray-800 text-white p-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold mb-1">FACTURE VENTE</h3>
                            <p class="text-gray-400">Date : {{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}</p>
                            <p class="text-gray-400">Vendeur : {{ $vente->users->name ?? 'Système' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-lg">{{ $vente->info_clients ?? 'Client Comptoir' }}</p>
                            <p class="text-gray-400 text-sm mt-2">Paiement : <span class="text-white bg-gray-700 px-2 py-1 rounded">{{ $vente->mode_payment }}</span></p>
                            <p class="text-gray-400 text-sm mt-1">Catégorie : {{ $vente->categorie->nom_categorie ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-200">
                                <th class="pb-3 font-bold text-gray-700">Description (Produit)</th>
                                <th class="pb-3 font-bold text-gray-700 text-center">Qté</th>
                                <th class="pb-3 font-bold text-gray-700 text-right">Prix Unitaire</th>
                                <th class="pb-3 font-bold text-gray-700 text-right">Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalGlobal = 0; @endphp
                            @foreach($vente->venteitems as $item)
                                @php 
                                    $sousTotal = $item->quantite * $item->prix_unitaire;
                                    $totalGlobal += $sousTotal;
                                @endphp
                                <tr class="border-b border-gray-100">
                                    <td class="py-4 text-gray-800">
                                        {{ $item->achat->produit->nom_produit ?? 'Produit supprimé' }}
                                        <div class="text-xs text-gray-400">Réf Achat: Lot #{{ $item->achat_id }}</div>
                                    </td>
                                    <td class="py-4 text-center">{{ $item->quantite }}</td>
                                    <td class="py-4 text-right">{{ number_format($item->prix_unitaire, 2) }} DH</td>
                                    <td class="py-4 text-right font-semibold">{{ number_format($sousTotal, 2) }} DH</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex justify-end mt-8">
                        <div class="bg-gray-50 p-6 rounded-lg w-64 border border-gray-200">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Sous-total</span>
                                <span class="font-medium">{{ number_format($totalGlobal, 2) }} DH</span>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-600">TVA (0%)</span>
                                <span class="font-medium">0.00 DH</span>
                            </div>
                            <div class="flex justify-between items-center border-t border-gray-200 pt-3">
                                <span class="font-bold text-gray-800 text-lg">NET À PAYER</span>
                                <span class="font-bold text-blue-600 text-lg">{{ number_format($totalGlobal, 2) }} DH</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-10 text-center text-sm text-gray-500">
                        Merci de votre confiance.
                    </div>
                    
                    <div class="mt-6 flex justify-center no-print">
                        <button onclick="window.print()" class="flex items-center gap-2 bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Imprimer la facture
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background-color: white; }
            .bg-gray-800 { background-color: #f3f4f6 !important; color: black !important; -webkit-print-color-adjust: exact; }
            .text-white { color: black !important; }
        }
    </style>
</x-app-layout>