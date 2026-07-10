<aside class="w-full lg:w-72 bg-slate-800 rounded-2xl shadow-lg border border-slate-700 p-6 shrink-0 h-fit">

    <nav class="space-y-1 mb-8">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-2.5 bg-blue-600/10 text-blue-400 border border-blue-500/20 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Mon Tableau de Bord
        </a>
    </nav>

    <div class="mb-4 border-b border-slate-700 pb-2">
        <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">
            Mon Profil RH
        </h3>
    </div>

    <nav class="space-y-1 mb-8">

        <a href="{{ route('pointage.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pointer Entrée / Sortie
        </a>

        <a href="{{ route('conges') }}"
           class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Mes Demandes de Congés
        </a>

    </nav>

    <div class="mb-4 border-b border-slate-700 pb-2">
        <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">
            Mon Travail
        </h3>
    </div>

    <nav class="space-y-1 mb-8">

        <a href="{{ route('taches.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            Mes Tâches
        </a>

        <a href="{{ route('produits.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5M4 11v10l8 4"/>
            </svg>
            Consulter les Produits
        </a>

    </nav>

    <div class="mb-4 border-b border-slate-700 pb-2">
        <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">
            Consultation
        </h3>
    </div>

    <nav class="space-y-1">

        <a href="{{ route('objectifs.index') }}"
           class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Objectifs de l'Entreprise
        </a>

    </nav>

</aside>