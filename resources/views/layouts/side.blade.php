<aside class="w-full lg:w-72 bg-slate-800 rounded-2xl shadow-lg border border-slate-700 p-6 shrink-0 h-fit">

    <nav class="space-y-1 mb-8">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 bg-red-500/10 text-red-400 border border-red-500/20 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
            Dashboard Principal
        </a>
    </nav>

    <div class="mb-4 border-b border-slate-700 pb-2">
        <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Ressources Humaines</h3>
    </div>
    <nav class="space-y-1 mb-8">
        <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            Gestion des Employés
        </a>
        <details class="group">

    <summary class="flex items-center justify-between px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium cursor-pointer list-none">

        <div class="flex items-center gap-3">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/>
            </svg>

            <span>Pointages</span>

        </div>

        <svg class="w-4 h-4 transition-transform group-open:rotate-180"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 9l-7 7-7-7"/>
        </svg>

    </summary>

    <div class="mt-2 ml-8 space-y-2">

        <a href="{{ route('pointage.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-slate-400 hover:bg-slate-700/50 hover:text-white">

            <span class="w-2 h-2 rounded-full bg-blue-500"></span>

            Effectuer un Pointage

        </a>

        <a href="{{ route('pointage.adminindex') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-slate-400 hover:bg-slate-700/50 hover:text-white">

            <span class="w-2 h-2 rounded-full bg-purple-500"></span>

            Supervision des Pointages

        </a>

    </div>

</details>
        <a href="{{ route('objectifs.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    Objectifs
</a>
        <a href="{{ route('conges') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Validation des Congés
        </a>
        <a href="{{ route('departements.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m9-7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            Départements
        </a>
    </nav>

    <div class="mb-4 border-b border-slate-700 pb-2">
        <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Commercial & Finance</h3>
    </div>
    <nav class="space-y-1 mb-8">
        <a href="{{ route('achats.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Achats & Fournisseurs
        </a>
        <a href="{{ route('ventes.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"></path></svg>
            Ventes & Facturation
        </a>
    </nav>

    <div class="mb-4 border-b border-slate-700 pb-2">
        <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Logistique & Catalogue</h3>
    </div>
    <nav class="space-y-1 mb-8">
        <a href="{{ route('produits.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5M4 11v10l8 4"></path></svg>
            Catalogue Produits
        </a>
        <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            Catégories
        </a>
        <a href="{{ route('stocks.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
            Mouvements de Stock
        </a>
    </nav>

    <div class="mb-4 border-b border-slate-700 pb-2">
        <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Opérations</h3>
    </div>
    <nav class="space-y-1">
        <a href="{{ route('taches.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            Suivi des Tâches
        </a>
        <a href="{{ route('taches.create') }}" class="flex items-center gap-3 px-4 py-2.5 text-blue-400 hover:bg-blue-500/10 hover:text-blue-300 rounded-xl font-semibold transition-colors mt-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Assigner une Tâche
        </a>
        <a href="{{ route('objectifs.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors mt-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            Objectifs Globaux
        </a>
    </nav>
</aside>