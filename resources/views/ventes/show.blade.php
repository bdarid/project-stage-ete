<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between print:hidden">
            <div class="flex items-center gap-4">
                <a href="{{ route('ventes.index') }}" class="text-slate-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-white">
                        Facture Vente #{{ $vente->numero_vente }}
                    </h2>
                    <p class="text-slate-400 text-sm mt-1">
                        Consultez et imprimez cette facture.
                    </p>
                </div>
            </div>

            <button onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-lg">
                🖨 Imprimer
            </button>
        </div>
    </x-slot>

    <div class="py-8 print:py-0">
        <div id="invoice" class="max-w-5xl mx-auto">
            
            {{-- Conteneur principal de la facture --}}
            <div class="bg-white rounded-2xl shadow-xl print:shadow-none print:rounded-none overflow-hidden">
                
                {{-- En-tête de la facture --}}
                <div class="bg-slate-900 text-white p-10 print:bg-slate-900 print:text-white">
                    <div class="flex justify-between">
                        <div>
                            <h1 class="text-4xl font-bold uppercase tracking-wider">Facture</h1>
                            <p class="mt-3 text-slate-300">
                                Vente N° <strong>{{ $vente->numero_vente }}</strong>
                            </p>
                            <p class="text-slate-300">
                                Date : {{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}
                            </p>
                            <p class="text-slate-300">
                                Vendeur : {{ $vente->users->name ?? 'Système' }}
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-xl font-semibold text-white">
                                {{ $vente->info_clients ?? 'Client Comptoir' }}
                            </div>
                            <div class="mt-4 text-sm text-slate-400 uppercase tracking-wide">
                                Paiement
                            </div>
                            <span class="inline-block mt-1 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                {{ $vente->mode_payment }}
                            </span>
                            <div class="mt-4 text-sm text-slate-400 uppercase tracking-wide">
                                Catégorie
                            </div>
                            <strong class="text-white block mt-1">
                                {{ $vente->categorie->nom_categorie ?? '-' }}
                            </strong>
                        </div>
                    </div>
                </div>

                {{-- Corps de la facture --}}
                <div class="p-10">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b-2 border-gray-200">
                                <th class="py-4 text-gray-600 font-semibold uppercase text-sm">Produit</th>
                                <th class="text-center text-gray-600 font-semibold uppercase text-sm">Qté</th>
                                <th class="text-right text-gray-600 font-semibold uppercase text-sm">Prix</th>
                                <th class="text-right text-gray-600 font-semibold uppercase text-sm">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalGlobal = 0;
                            @endphp

                            @foreach($vente->venteitems as $item)
                                @php
                                    $sousTotal = $item->quantite * $item->prix_unitaire;
                                    $totalGlobal += $sousTotal;
                                @endphp
                                <tr class="border-b border-gray-100">
                                    <td class="py-5">
                                        <div class="font-semibold text-gray-800">
                                            {{ $item->achat->produit->nom_produit ?? 'Produit supprimé' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            Lot #{{ $item->achat_id }}
                                        </div>
                                    </td>
                                    <td class="text-center text-gray-700">
                                        {{ $item->quantite }}
                                    </td>
                                    <td class="text-right text-gray-700">
                                        {{ number_format($item->prix_unitaire, 2, ',', ' ') }} DH
                                    </td>
                                    <td class="text-right font-bold text-gray-900">
                                        {{ number_format($sousTotal, 2, ',', ' ') }} DH
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Totaux --}}
                    <div class="flex justify-end mt-10">
                        <div class="w-full md:w-96">
                            <div class="border rounded-xl overflow-hidden">
                                <div class="flex justify-between px-6 py-4 border-b">
                                    <span class="text-gray-600">Sous-total</span>
                                    <span class="font-semibold text-gray-800">{{ number_format($totalGlobal, 2, ',', ' ') }} DH</span>
                                </div>
                                <div class="flex justify-between px-6 py-4 border-b">
                                    <span class="text-gray-600">TVA</span>
                                    <span class="text-gray-800">0.00 DH</span>
                                </div>
                                <div class="flex justify-between items-center bg-slate-900 text-white px-6 py-5 print:bg-slate-900 print:text-white">
                                    <span class="text-lg font-bold">NET À PAYER</span>
                                    <span class="text-2xl font-bold">{{ number_format($totalGlobal, 2, ',', ' ') }} DH</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 text-center text-gray-500 text-sm">
                        Merci pour votre confiance.
                    </div>
                </div>
            </div>

            {{-- Boutons bas de page (masqués à l'impression) --}}
            <div class="print:hidden mt-8 flex justify-between items-center">
                <a href="{{ route('ventes.index') }}" class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium transition">
                    ← Retour
                </a>
                <button onclick="window.print()" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-lg">
                    🖨 Imprimer la facture
                </button>
            </div>
        </div>
    </div>

    {{-- Style spécifique pour l'impression --}}
    <style>
        @media print {
            /* Force les navigateurs à imprimer les couleurs de fond (très important pour l'en-tête bleu/noir) */
            * {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Masque les éléments de navigation globaux du layout Laravel (sidebar, header global) */
            header, nav, aside {
                display: none !important;
            }

            /* Ajuste le corps pour prendre toute la page */
            body, main {
                background-color: white !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* Assure que la facture prend 100% de la largeur du papier */
            #invoice {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
            }

            /* Configuration de la page papier */
            @page {
                size: A4;
                margin: 1cm;
            }
        }
    </style>

</x-app-layout>