<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="Détails du Mouvement" subtitle="Visualisation des informations complètes du mouvement de stock.">
            <div class="flex gap-3">
                <a href="{{ route('stocks.edit', $stock->id) }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-semibold transition">
                    Modifier
                </a>
                <a href="{{ route('stocks.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold transition">
                    Retour
                </a>
            </div>
        </x-erp.page-header>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-5xl mx-auto">
            
            <x-erp.card title="Informations du mouvement" subtitle="Détails techniques et enregistrements associés.">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Produit --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Produit</label>
                        <div class="bg-slate-900 border border-slate-700/50 rounded-xl p-4 text-slate-200 font-medium">
                            {{ $stock->produit->nom_produit ?? 'Non défini' }}
                        </div>
                    </div>

                    {{-- Catégorie --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Catégorie</label>
                        <div class="bg-slate-900 border border-slate-700/50 rounded-xl p-4 text-slate-200 font-medium">
                            {{ $stock->categorie->nom_categorie ?? 'Non définie' }}
                        </div>
                    </div>

                    {{-- Mouvement --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Mouvement</label>
                        <div class="bg-slate-900 border border-slate-700/50 rounded-xl p-4">
                            @if($stock->mouvement_stock > 0)
                                <span class="text-green-400 font-bold text-lg">+{{ $stock->mouvement_stock }}</span>
                            @elseif($stock->mouvement_stock < 0)
                                <span class="text-red-400 font-bold text-lg">{{ $stock->mouvement_stock }}</span>
                            @else
                                <span class="text-slate-500 font-bold text-lg">0</span>
                            @endif
                        </div>
                    </div>

                    {{-- Type --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Type de mouvement</label>
                        <div class="flex items-center h-[54px] bg-slate-900 border border-slate-700/50 rounded-xl px-4">
                            @if($stock->achat_id)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500/10 text-green-400 border border-green-500/20">Achat</span>
                            @elseif($stock->vente_id)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">Vente</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-500/10 text-slate-400 border border-slate-500/20">Manuel</span>
                            @endif
                        </div>
                    </div>

                    {{-- Achat associé --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Achat associé</label>
                        <div class="bg-slate-900 border border-slate-700/50 rounded-xl p-4 text-slate-300">
                            {{ $stock->achat ? 'Achat #' . $stock->achat->id : 'Aucun' }}
                        </div>
                    </div>

                    {{-- Vente associée --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Vente associée</label>
                        <div class="bg-slate-900 border border-slate-700/50 rounded-xl p-4 text-slate-300">
                            {{ $stock->vente ? 'Vente #' . $stock->vente->id : 'Aucune' }}
                        </div>
                    </div>

                    {{-- Utilisateur --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Utilisateur</label>
                        <div class="bg-slate-900 border border-slate-700/50 rounded-xl p-4 text-slate-300">
                            {{ $stock->users->name_users ?? 'Inconnu' }}
                        </div>
                    </div>

                    {{-- Date --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Date de création</label>
                        <div class="bg-slate-900 border border-slate-700/50 rounded-xl p-4 text-slate-300">
                            {{ $stock->created_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>

                </div>

                {{-- Boutons d'action bas de page --}}
                <div class="mt-8 pt-6 border-t border-slate-700/50 flex justify-end gap-3">
                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce mouvement ?')">
                        @csrf @method('DELETE')
                        <button class="bg-red-500/10 hover:bg-red-500/20 text-red-400 px-6 py-2.5 rounded-xl font-semibold border border-red-500/20 transition">
                            Supprimer
                        </button>
                    </form>
                    <a href="{{ route('stocks.edit', $stock->id) }}" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-amber-600/20">
                        Modifier le mouvement
                    </a>
                </div>
            </x-erp.card>

        </div>
    </div>
</x-app-layout>