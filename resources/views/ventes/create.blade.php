<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Enregistrer une Nouvelle Vente</h2>
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

            <form action="{{ route('ventes.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                @csrf
                
                <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Informations Générales</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Numéro de Vente</label>
                        <input type="text" name="numero_vente" value="VT-{{ date('Ymd-His') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="date_vente" value="{{ date('Y-m-d') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Infos Client (Optionnel)</label>
                        <input type="text" name="info_clients" placeholder="Nom, Téléphone..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Paiement</label>
                        <select name="mode_payment" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="Espèces">Espèces</option>
                            <option value="Carte Bancaire">Carte Bancaire</option>
                            <option value="Chèque">Chèque</option>
                            <option value="Virement">Virement</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 lg:col-span-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie de la Vente</label>
                        <select name="categorie_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-between items-center border-b pb-2 mb-4">
                    <h3 class="text-lg font-bold text-gray-700">Articles Vendus</h3>
                    <button type="button" onclick="ajouterLigne()" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded text-sm font-medium transition-colors">
                        + Ajouter une ligne
                    </button>
                </div>

                <table class="w-full mb-8">
                    <thead>
                        <tr class="text-left text-sm text-gray-600">
                            <th class="pb-2 w-1/2">Produit (issu de l'achat)</th>
                            <th class="pb-2 w-1/6">Quantité</th>
                            <th class="pb-2 w-1/4">Prix Unitaire (DH)</th>
                            <th class="pb-2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="lignes-articles">
                        <tr class="article-row">
                            <td class="pr-2 pb-3">
                                <select name="items[0][achat_id]" class="w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                                    <option value="">Sélectionner un produit...</option>
                                    @foreach($achats as $achat)
                                        <option value="{{ $achat->id }}">
                                            Lot #{{ $achat->id }} - {{ $achat->produit->nom_produit ?? 'Produit Inconnu' }} 
                                            (Stock dispo: {{ $achat->produit->stock_actuel ?? 0 }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="pr-2 pb-3">
                                <input type="number" name="items[0][quantite]" min="1" value="1" class="w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                            </td>
                            <td class="pr-2 pb-3">
                                <input type="number" step="0.01" name="items[0][prix_unitaire]" placeholder="Ex: 150.00" class="w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                            </td>
                            <td class="pb-3 text-center">
                                <button type="button" onclick="supprimerLigne(this)" class="text-red-500 hover:text-red-700 p-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <a href="{{ route('ventes.index') }}" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg mr-3 hover:bg-gray-300 transition-colors">Annuler</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg font-bold shadow-sm transition-colors">
                        Valider la Vente
                    </button>
                </div>
            </form>
        </div>
    </div>

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