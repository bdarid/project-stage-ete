<x-app-layout>

    <x-slot name="header">
        <x-erp.page-header
            title="Détails de l'Achat #{{ $achat->id }}"
            subtitle="Consultez toutes les informations relatives à cet achat."
        />
    </x-slot>

    <div class="space-y-6 pb-12">

        <x-erp.alert />

        <div class="max-w-7xl mx-auto">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Colonne de gauche : Informations générales --}}
                <div class="lg:col-span-1 space-y-6">

                    <x-erp.card>
                        <div class="p-6">
                            {{-- En-tête de la carte info --}}
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-16 h-16 rounded-full bg-slate-700 flex items-center justify-center text-blue-400 text-2xl font-bold shadow-inner">
                                    {{ strtoupper(substr($achat->produit->nom_produit ?? 'P', 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white leading-tight">
                                        {{ $achat->produit->nom_produit ?? 'Produit inconnu' }}
                                    </h3>
                                    <p class="text-slate-400 text-sm mt-1">
                                        Achat #{{ $achat->id }}
                                    </p>
                                </div>
                            </div>

                            {{-- Liste des détails --}}
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-t border-slate-700/50">
                                    <span class="text-slate-400 text-sm">Catégorie</span>
                                    <span class="text-white font-medium text-right">
                                        {{ $achat->categorie->nom_categorie ?? '-' }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center py-3 border-t border-slate-700/50">
                                    <span class="text-slate-400 text-sm">Fournisseur</span>
                                    <span class="text-white font-medium text-right">
                                        {{ $achat->nom_fournisseur }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center py-3 border-t border-slate-700/50">
                                    <span class="text-slate-400 text-sm">Utilisateur</span>
                                    <span class="text-white font-medium text-right">
                                        {{ $achat->users->name_users ?? '-' }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center py-3 border-t border-slate-700/50">
                                    <span class="text-slate-400 text-sm">Date d'achat</span>
                                    <span class="text-white font-medium">
                                        {{ \Carbon\Carbon::parse($achat->date_achat)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </x-erp.card>

                    {{-- Commentaire repensé pour s'intégrer harmonieusement sous les infos --}}
                    <x-erp.card>
                        <div class="p-6">
                            <h4 class="text-slate-300 font-semibold mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                                Commentaire
                            </h4>
                            <div class="text-slate-400 text-sm leading-relaxed bg-slate-900/50 rounded-lg p-4 border border-slate-700/50 min-h-[80px]">
                                {{ $achat->commentaire ?: 'Aucun commentaire renseigné pour cet achat.' }}
                            </div>
                        </div>
                    </x-erp.card>

                </div>

                {{-- Colonne de droite : Détails financiers --}}
                <div class="lg:col-span-2">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- LIGNE 1 : PRIX UNITAIRES --}}
                        {{-- Prix d'achat unitaire --}}
                        <div class="rounded-2xl border border-slate-700 bg-slate-800 p-5 flex flex-col justify-between hover:border-slate-600 transition duration-200">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-slate-400 text-sm font-medium">Prix d'achat unitaire</p>
                                <div class="p-2 bg-red-500/10 rounded-lg text-red-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-red-400">
                                {{ number_format($achat->prix_achat, 2) }} <span class="text-sm font-medium text-red-400/70">DH</span>
                            </p>
                        </div>

                        {{-- Prix de vente unitaire --}}
                        <div class="rounded-2xl border border-slate-700 bg-slate-800 p-5 flex flex-col justify-between hover:border-slate-600 transition duration-200">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-slate-400 text-sm font-medium">Prix de vente unitaire</p>
                                <div class="p-2 bg-green-500/10 rounded-lg text-green-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-green-400">
                                {{ number_format($achat->prix_vente, 2) }} <span class="text-sm font-medium text-green-400/70">DH</span>
                            </p>
                        </div>

                        {{-- LIGNE 2 : TOTAUX --}}
                        {{-- Valeur totale d'achat --}}
                        <div class="rounded-2xl border border-slate-700 bg-slate-800 p-5 flex flex-col justify-between hover:border-slate-600 transition duration-200">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-slate-400 text-sm font-medium">Valeur totale (Achat)</p>
                            </div>
                            <p class="text-2xl font-bold text-red-500">
                                {{ number_format($achat->prix_achat * $achat->quantite, 2) }} <span class="text-sm font-medium text-red-500/70">DH</span>
                            </p>
                        </div>

                        {{-- Valeur totale de vente --}}
                        <div class="rounded-2xl border border-slate-700 bg-slate-800 p-5 flex flex-col justify-between hover:border-slate-600 transition duration-200">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-slate-400 text-sm font-medium">Valeur totale (Vente)</p>
                            </div>
                            <p class="text-2xl font-bold text-green-500">
                                {{ number_format($achat->prix_vente * $achat->quantite, 2) }} <span class="text-sm font-medium text-green-500/70">DH</span>
                            </p>
                        </div>

                        {{-- LIGNE 3 : QUANTITÉ ET BÉNÉFICE UNITAIRE (Pleine largeur) --}}
                        <div class="md:col-span-2 rounded-2xl border border-slate-700 bg-slate-800 p-1 flex flex-col sm:flex-row shadow-sm">
                            <div class="flex-1 p-4 flex justify-between items-center">
                                <div>
                                    <p class="text-slate-400 text-sm font-medium">Quantité achetée</p>
                                    <p class="mt-1 text-2xl font-bold text-white">{{ $achat->quantite }}</p>
                                </div>
                                <div class="hidden sm:flex items-center justify-center w-10 h-10 rounded-full bg-slate-700/50 text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                            </div>
                            
                            <div class="w-full sm:w-px h-px sm:h-auto bg-slate-700"></div>
                            
                            <div class="flex-1 p-4 flex justify-between items-center sm:text-right flex-row-reverse sm:flex-row">
                                <div class="hidden sm:flex items-center justify-center w-10 h-10 rounded-full bg-blue-500/10 text-blue-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                </div>
                                <div>
                                    <p class="text-slate-400 text-sm font-medium">Bénéfice unitaire</p>
                                    <p class="mt-1 text-xl font-bold text-blue-400">
                                        {{ number_format($achat->prix_vente - $achat->prix_achat, 2) }} <span class="text-sm font-medium text-blue-400/70">DH</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- LIGNE 4 : BÉNÉFICE POTENTIEL TOTAL (Mise en évidence) --}}
                        <div class="md:col-span-2 rounded-2xl border border-blue-500/30 bg-gradient-to-r from-blue-500/10 to-blue-600/5 p-6 flex justify-between items-center shadow-lg shadow-blue-900/20">
                            <div>
                                <p class="text-blue-400 text-sm font-semibold tracking-wide uppercase mb-1">Bénéfice potentiel total</p>
                                <p class="text-3xl font-bold text-blue-500 drop-shadow-sm">
                                    {{ number_format(($achat->prix_vente - $achat->prix_achat) * $achat->quantite, 2) }} <span class="text-xl font-semibold text-blue-500/80">DH</span>
                                </p>
                            </div>
                            <div class="w-14 h-14 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 shadow-inner">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>

                    </div>

                    {{-- Boutons d'action unifiés --}}
                    <div class="flex justify-end gap-3 mt-8">
                        <a href="{{ route('achats.index') }}"
                           class="px-6 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-medium transition shadow-sm">
                            Retour
                        </a>

                        <a href="{{ route('achats.edit', $achat->id) }}"
                           class="px-6 py-2.5 rounded-xl bg-yellow-600 hover:bg-yellow-500 text-white font-medium transition shadow-sm">
                            Modifier
                        </a>

                        <form action="{{ route('achats.destroy', $achat->id) }}"
                              method="POST"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet achat ? Cette action est irréversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-6 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-medium transition shadow-sm">
                                Supprimer
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>