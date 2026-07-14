<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="Gestion des Catégories" subtitle="Consultez et organisez vos différentes catégories de produits.">
            
        </x-erp.page-header>
    </x-slot>
    <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg shadow-blue-500/30 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouvelle Catégorie
            </a>

    <div class="space-y-6 pb-12">
        
        {{-- Alertes de succès ou d'erreur adaptées au thème sombre --}}
        @if(session('success'))
            <div class="rounded-2xl border border-green-500/40 bg-green-500/10 p-4 flex items-center gap-3 text-green-400 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-2xl border border-red-500/40 bg-red-500/10 p-4 flex items-center gap-3 text-red-400 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Tableau des catégories --}}
        <div class="bg-slate-800 rounded-2xl border border-slate-700 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-900/50 border-b border-slate-700">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Nom de la Catégorie</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Catégorie Parente</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @forelse($categories as $categorie)
                            <tr class="hover:bg-slate-700/30 transition duration-150">
                                
                                <td class="px-6 py-4 font-medium text-white">
                                    {{ $categorie->nom_categorie }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    @if($categorie->parent)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                            {{ $categorie->parent->nom_categorie }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-700/50 text-slate-400 border border-slate-600">
                                            Catégorie Principale
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 text-slate-400 text-sm truncate max-w-xs">
                                    {{ $categorie->description_categorie ?? '-' }}
                                </td>
                                
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('categories.show', $categorie->id) }}" class="text-slate-300 hover:text-white bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded-lg text-sm transition-colors">
                                            Voir
                                        </a>
                                        <a href="{{ route('categories.edit', $categorie->id) }}" class="text-yellow-500 hover:text-yellow-400 bg-yellow-500/10 hover:bg-yellow-500/20 px-3 py-1.5 rounded-lg text-sm transition-colors">
                                            Éditer
                                        </a>
                                        <form method="POST" action="{{ route('categories.destroy', $categorie->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400 bg-red-500/10 hover:bg-red-500/20 px-3 py-1.5 rounded-lg text-sm transition-colors">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-12 text-slate-400 bg-slate-900/20">
                                    Aucune catégorie n'est enregistrée pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination (s'affiche uniquement s'il y a plusieurs pages) --}}
            @if($categories->hasPages())
                <div class="p-5 border-t border-slate-700 bg-slate-900/50">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>