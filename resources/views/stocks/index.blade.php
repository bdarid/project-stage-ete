<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="Gestion des Stocks" subtitle="Suivi complet des mouvements, entrées et sorties de votre inventaire.">
            
        </x-erp.page-header>
    </x-slot>
    <a href="{{ route('stocks.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg shadow-blue-500/30 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nouveau Mouvement
            </a>

    <div class="pb-12">
        
        {{-- Alertes --}}
        @if(session('success'))
            <div class="rounded-2xl border border-green-500/40 bg-green-500/10 p-4 mb-6 flex items-center gap-3 text-green-400 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Tableau des stocks --}}
        <div class="bg-slate-800 rounded-2xl border border-slate-700 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-900/50 border-b border-slate-700">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Produit</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Mouvement</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Utilisateur</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @forelse($stocks as $stock)
                            <tr class="hover:bg-slate-700/30 transition duration-150">
                                <td class="px-6 py-4 font-medium text-white">{{ $stock->produit->nom_produit ?? '-' }}</td>
                                
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                        {{ $stock->categorie->nom_categorie ?? '-' }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 text-center">
                                    @if($stock->mouvement_stock > 0)
                                        <span class="text-green-400 font-bold">+{{ $stock->mouvement_stock }}</span>
                                    @elseif($stock->mouvement_stock < 0)
                                        <span class="text-red-400 font-bold">{{ $stock->mouvement_stock }}</span>
                                    @else
                                        <span class="text-slate-500 font-bold">0</span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $typeClass = $stock->achat_id ? 'bg-green-500/10 text-green-400 border-green-500/20' : 
                                                    ($stock->vente_id ? 'bg-amber-500/10 text-amber-400 border-amber-500/20' : 
                                                    'bg-slate-500/10 text-slate-400 border-slate-500/20');
                                        $typeLabel = $stock->achat_id ? 'Achat' : ($stock->vente_id ? 'Vente' : 'Manuel');
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $typeClass }}">
                                        {{ $typeLabel }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 text-center text-slate-300 text-sm">
                                    {{ $stock->users->name_users ?? '-' }}
                                </td>
                                
                                <td class="px-6 py-4 text-center text-slate-400 text-sm">
                                    {{ $stock->created_at->format('d/m/Y H:i') }}
                                </td>
                                
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('stocks.show',$stock->id) }}" class="text-slate-300 hover:text-white bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded-lg text-xs transition">Voir</a>
                                        <a href="{{ route('stocks.edit',$stock->id) }}" class="text-yellow-500 hover:text-yellow-400 bg-yellow-500/10 hover:bg-yellow-500/20 px-3 py-1.5 rounded-lg text-xs transition">Modifier</a>
                                        <form action="{{ route('stocks.destroy',$stock->id) }}" method="POST" onsubmit="return confirm('Supprimer ce mouvement ?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-500 hover:text-red-400 bg-red-500/10 hover:bg-red-500/20 px-3 py-1.5 rounded-lg text-xs transition">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-12 text-slate-400 bg-slate-900/20">
                                    Aucun mouvement de stock enregistré.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-5 border-t border-slate-700 bg-slate-900/50">
                {{ $stocks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>