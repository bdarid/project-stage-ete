<x-app-layout>

    <x-slot name="header">
        <x-erp.page-header
            title="Nouvelle Vente"
            subtitle="Enregistrez une nouvelle vente et mettez à jour votre stock."
        />
    </x-slot>

    <div class="space-y-6">

        <x-erp.alert />

        <div class="max-w-6xl mx-auto">

            <x-erp.card
                title="Informations de la Vente"
                subtitle="Complétez les détails de la transaction et les articles vendus ci-dessous."
            >

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('ventes.store') }}" method="POST" class="space-y-8">
                    @csrf

                    {{-- Informations générales --}}
                    <div>
                        <h4 class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-700/50 pb-2">
                            Informations générales
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                            {{-- Numéro de Vente --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    Numéro de Vente
                                </label>
                                <input type="text" name="numero_vente" value="VT-{{ date('Ymd-His') }}" required
                                    class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                            </div>

                            {{-- Date --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    Date
                                </label>
                                <input type="date" name="date_vente" value="{{ date('Y-m-d') }}" required
                                    class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm [color-scheme:dark]">
                            </div>

                            {{-- Infos Client --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    Infos Client (Optionnel)
                                </label>
                                <input type="text" name="info_clients" placeholder="Nom, Téléphone..."
                                    class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                            </div>

                            {{-- Paiement --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    Paiement
                                </label>
                                <select name="mode_payment" required
                                    class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                                    <option value="Espèces">Espèces</option>
                                    <option value="Carte Bancaire">Carte Bancaire</option>
                                    <option value="Chèque">Chèque</option>
                                    <option value="Virement">Virement</option>
                                </select>
                            </div>

                            {{-- Catégorie de la Vente --}}
                            <div class="md:col-span-2 lg:col-span-4">
                                <label class="block text-sm font-semibold text-slate-300 mb-2">
                                    Catégorie de la Vente
                                </label>
                                <select name="categorie_id" required
                                    class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    {{-- Articles vendus --}}
                    <div>
                        <div class="flex justify-between items-center border-b border-slate-700/50 pb-2 mb-4">
                            <h4 class="text-sm font-medium text-slate-400 uppercase tracking-wider">
                                Articles Vendus
                            </h4>
                            <button type="button" onclick="ajouterLigne()"
                                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Ajouter une ligne
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-slate-900/40 border-b border-slate-700">
                                    <tr class="text-slate-400 uppercase text-xs tracking-wider">
                                        <th class="px-4 py-3 text-left w-1/2">Produit (issu de l'achat)</th>
                                        <th class="px-4 py-3 text-left w-1/6">Quantité</th>
                                        <th class="px-4 py-3 text-left w-1/4">Prix Unitaire (DH)</th>
                                        <th class="px-4 py-3 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="lignes-articles" class="divide-y divide-slate-700/50">
                                    <tr class="article-row">
                                        <td class="px-4 py-3">
                                            <select name="items[0][achat_id]" required
                                                class="w-full rounded-lg border-slate-700 bg-slate-900 text-white text-sm focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                                                <option value="">Sélectionner un produit...</option>
                                                @foreach($achats as $achat)
                                                    <option value="{{ $achat->id }}">
                                                        Lot #{{ $achat->id }} - {{ $achat->produit->nom_produit ?? 'Produit Inconnu' }}
                                                        (Stock dispo: {{ $achat->produit->stock_actuel ?? 0 }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-4 py-3">
                                            <input type="number" name="items[0][quantite]" min="1" value="1" required
                                                class="w-full rounded-lg border-slate-700 bg-slate-900 text-white text-sm focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                                        </td>
                                        <td class="px-4 py-3">
                                            <input type="number" step="0.01" name="items[0][prix_unitaire]" placeholder="Ex: 150.00" required
                                                class="w-full rounded-lg border-slate-700 bg-slate-900 text-white text-sm focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <button type="button" onclick="supprimerLigne(this)"
                                                class="p-2 rounded-lg text-red-400 hover:text-red-300 hover:bg-red-500/10 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Boutons d'action --}}
                    <div class="flex justify-end gap-3 border-t border-slate-700 pt-6">
                        <a href="{{ route('ventes.index') }}"
                           class="px-5 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                            Valider la Vente
                        </button>
                    </div>

                </form>

            </x-erp.card>

        </div>

    </div>

    {{-- Script de gestion dynamique des lignes d'articles --}}
    <script>
        let indexLigne = 1;
        function ajouterLigne() {
            const tbody = document.getElementById('lignes-articles');
            const premiereLigne = tbody.querySelector('.article-row');
            const nouvelleLigne = premiereLigne.cloneNode(true);

            // Mise à jour des index dans les attributs name (ex: items[0][quantite] devient items[1][quantite])
            nouvelleLigne.querySelectorAll('input, select').forEach(element => {
                element.name = element.name.replace(/\[0\]/, `[${indexLigne}]`);
                if (element.tagName === 'INPUT') element.value = '';
                if (element.name.includes('quantite')) element.value = '1';
            });

            tbody.appendChild(nouvelleLigne);
            indexLigne++;
        }

        function supprimerLigne(bouton) {
            const tbody = document.getElementById('lignes-articles');
            if (tbody.children.length > 1) {
                bouton.closest('tr').remove();
            } else {
                alert("Vous devez garder au moins une ligne d'article.");
            }
        }
    </script>

</x-app-layout>