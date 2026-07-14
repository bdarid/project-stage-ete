<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="Détails de la Catégorie" subtitle="Informations, hiérarchie et produits rattachés à cette catégorie.">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold transition shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour aux catégories
            </a>
        </x-erp.page-header>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-6xl mx-auto space-y-6 md:space-y-0 md:grid md:grid-cols-3 gap-6">

            {{-- Colonne de gauche : Informations de base --}}
            <div class="md:col-span-1">
                <div class="bg-slate-800 rounded-2xl border border-slate-700 shadow-xl p-6 flex flex-col h-full">
                    <h3 class="text-2xl font-bold text-white mb-6">{{ $categorie->nom_categorie }}</h3>

                    <div class="mb-6">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-2">Hiérarchie</span>
                        @if($categorie->parent)
                            <p class="text-slate-300 text-sm">
                                Sous-catégorie de : 
                                <a href="{{ route('categories.show', $categorie->parent->id) }}" class="font-semibold text-blue-400 hover:text-blue-300 transition">
                                    {{ $categorie->parent->nom_categorie }}
                                </a>
                            </p>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-700/50 text-slate-400 border border-slate-600">
                                Catégorie Principale
                            </span>
                        @endif
                    </div>

                    <div class="mb-8 flex-grow">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-2">Description</span>
                        <p class="text-slate-300 text-sm leading-relaxed bg-slate-900/30 p-4 rounded-xl border border-slate-700/50">
                            {{ $categorie->description_categorie ?? 'Aucune description n\'a été fournie pour cette catégorie.' }}
                        </p>
                    </div>

                    <div class="pt-6 border-t border-slate-700/50 mt-auto">
                        <a href="{{ route('categories.edit', $categorie->id) }}" class="flex items-center justify-center gap-2 w-full bg-amber-600 hover:bg-amber-700 text-white px-4 py-3 rounded-xl font-semibold transition shadow-lg shadow-amber-600/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            Modifier la catégorie
                        </a>
                    </div>
                </div>
            </div>

            {{-- Colonne de droite : Relations (Sous-catégories & Produits) --}}
            <div class="md:col-span-2 space-y-6">

                {{-- Bloc Sous-catégories --}}
                <div class="bg-slate-800 rounded-2xl border border-slate-700 shadow-xl overflow-hidden">
                    <div class="bg-slate-900/50 px-6 py-4 border-b border-slate-700 flex justify-between items-center">
                        <h4 class="font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            Sous-catégories
                        </h4>
                        <span class="bg-blue-500/20 text-blue-400 text-xs font-bold px-3 py-1 rounded-full border border-blue-500/30">
                            {{ $categorie->sousCategories->count() }}
                        </span>
                    </div>
                    
                    <div class="p-6">
                        @if($categorie->sousCategories->count() > 0)
                            <div class="flex flex-wrap gap-3">
                                @foreach($categorie->sousCategories as $sousCat)
                                    <a href="{{ route('categories.show', $sousCat->id) }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-blue-600/20 text-slate-300 hover:text-blue-400 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-700 hover:border-blue-500/50 transition-all shadow-sm">
                                        {{ $sousCat->nom_categorie }}
                                        <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6">
                                <p class="text-slate-500 text-sm italic">Cette catégorie ne contient aucune sous-catégorie.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Bloc Produits --}}
                <div class="bg-slate-800 rounded-2xl border border-slate-700 shadow-xl overflow-hidden">
                    <div class="bg-slate-900/50 px-6 py-4 border-b border-slate-700 flex justify-between items-center">
                        <h4 class="font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            Produits dans cette catégorie
                        </h4>
                        <span class="bg-emerald-500/20 text-emerald-400 text-xs font-bold px-3 py-1 rounded-full border border-emerald-500/30">
                            {{ $categorie->produits->count() }}
                        </span>
                    </div>
                    
                    <div>
                        @if($categorie->produits->count() > 0)
                            <ul class="divide-y divide-slate-700/50">
                                @foreach($categorie->produits as $produit)
                                    <li class="px-6 py-4 hover:bg-slate-700/30 flex justify-between items-center transition-colors">
                                        <span class="text-sm font-medium text-slate-200">
                                            {{ $produit->nom_produit }}
                                        </span>
                                        <span class="text-xs bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-1.5 rounded-full font-medium shadow-sm">
                                            Stock: {{ $produit->stock_actuel ?? 0 }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="p-12 text-center">
                                <svg class="w-12 h-12 text-slate-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                <p class="text-slate-400 text-sm">Aucun produit n'est actuellement rattaché à cette catégorie.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>