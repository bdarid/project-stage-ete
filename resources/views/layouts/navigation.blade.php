<nav x-data="{ open: false, actionsOpen: false }" class="bg-slate-800 border-b border-slate-700 relative z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 text-slate-200">

            <!-- LOGO -->
            <div class="flex items-center shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center border border-slate-700 shadow-inner">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <strong class="text-white text-xl tracking-widest font-black">ERP</strong>
                </a>
            </div>

            <!-- BARRE DE RECHERCHE -->
            <div class="hidden sm:flex flex-1 justify-center px-6 lg:px-12">
                <div class="w-full max-w-lg relative">
                    <div class="relative flex items-center">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input id="global-search" type="text" autocomplete="off"
                               class="block w-full pl-10 pr-3 py-2 border border-slate-700 rounded-xl leading-5 bg-slate-900 text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out shadow-inner"
                               placeholder="Recherche rapide (ex: Ventes, Stocks, Employés...)">
                    </div>

                    <!-- Résultats de recherche -->
                    <div id="search-results" class="hidden absolute z-50 mt-2 w-full bg-slate-800 shadow-2xl rounded-xl border border-slate-700 max-h-60 overflow-y-auto">
                        <ul id="search-list" class="py-1 text-sm text-slate-300">
                            <!-- Rempli par le JS -->
                        </ul>
                    </div>
                </div>
            </div>

            <!-- BOUTONS DROITE -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">

                <!-- MENU ACTIONS RAPIDES -->
                <div class="relative" id="menu-actions-wrapper">
                    <button id="btn-menu-actions" @click="actionsOpen = ! actionsOpen" @click.away="actionsOpen = false"
                            class="inline-flex items-center gap-1.5 px-3 py-2 border border-slate-700 text-sm leading-4 font-medium rounded-lg text-slate-300 bg-slate-900 hover:bg-slate-700 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span>Menu Actions</span>
                        <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu Actions -->
                    <div id="dropdown-menu-actions" x-show="actionsOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                         class="hidden absolute right-0 mt-2 w-56 rounded-xl shadow-2xl bg-slate-800 border border-slate-700 divide-y divide-slate-700 focus:outline-none z-50">

                        <div class="py-1">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                📊 Dashboard
                            </a>
                            <a href="{{ route('pointage.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                ⏱️ Pointer l'Heure
                            </a>
                            <a href="{{ route('conges') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                📅 Demande Congé
                            </a>
                        </div>

                        @role('Admin|Manager')
                        <div class="py-2">
                            <div class="px-4 py-1 text-[10px] font-black text-slate-500 uppercase tracking-wider">RH & Équipe</div>
                            <a href="{{ route('users.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                👥 Liste des Employés
                            </a>
                            <a href="{{ route('users.create') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-blue-400 font-medium hover:bg-slate-700 hover:text-blue-300 transition-colors">
                                ➕ Ajouter un Employé
                            </a>
                        </div>
                        <div class="py-2">
                            <div class="px-4 py-1 text-[10px] font-black text-slate-500 uppercase tracking-wider">Logistique & Ventes</div>
                            <a href="{{ route('produits.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                📦 Gérer les Produits
                            </a>
                            <a href="{{ route('ventes.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                💰 Gérer les Ventes
                            </a>
                            <a href="{{ route('achats.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                🛒 Gérer les Achats
                            </a>
                        </div>
                        @endrole
                    </div>
                </div>

                <!-- INFO UTILISATEUR & BADGE -->
                <div class="flex items-center gap-3 text-sm font-medium text-slate-200 border-l border-slate-700 pl-4">
                    <span class="font-bold">{{ Auth::user()->name_users ?? Auth::user()->name }}</span>

                    @if(Auth::user()->hasRole('Admin'))
                        <span class="bg-red-500/20 border border-red-500/30 text-red-400 text-xs font-bold px-2 py-0.5 rounded-md">Admin</span>
                    @elseif(Auth::user()->hasRole('Manager'))
                        <span class="bg-amber-500/20 border border-amber-500/30 text-amber-400 text-xs font-bold px-2 py-0.5 rounded-md">Manager</span>
                    @else
                        <span class="bg-green-500/20 border border-green-500/30 text-green-400 text-xs font-bold px-2 py-0.5 rounded-md">Employé</span>
                    @endif
                </div>

                <!-- BOUTON DÉCONNEXION -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 bg-red-500/10 hover:bg-red-500 border border-red-500/20 text-red-500 hover:text-white text-xs font-bold py-2 px-3 rounded-lg transition duration-200 ease-in-out">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>

            <!-- MENU HAMBURGER (MOBILE) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-700 focus:outline-none focus:bg-slate-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- RESPONSIVE NAVIGATION MENU (MOBILE) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-800 border-t border-slate-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-300 hover:text-white hover:bg-slate-700">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @role('Admin|Manager')
            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" class="text-slate-300 hover:text-white hover:bg-slate-700">
                {{ __('Employés') }}
            </x-responsive-nav-link>
            @endrole
        </div>

        <div class="pt-4 pb-1 border-t border-slate-700">
            <div class="px-4 flex justify-between items-center">
                <div>
                    <div class="font-medium text-base text-white">{{ Auth::user()->name_users ?? Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
                </div>
                <div>
                    @if(Auth::user()->hasRole('Admin'))
                        <span class="bg-red-500/20 border border-red-500/30 text-red-400 text-xs font-bold px-2 py-0.5 rounded-md">Admin</span>
                    @elseif(Auth::user()->hasRole('Manager'))
                        <span class="bg-amber-500/20 border border-amber-500/30 text-amber-400 text-xs font-bold px-2 py-0.5 rounded-md">Manager</span>
                    @else
                        <span class="bg-green-500/20 border border-green-500/30 text-green-400 text-xs font-bold px-2 py-0.5 rounded-md">Employé</span>
                    @endif
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-red-400 hover:text-red-300 font-bold py-2 text-sm">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- SCRIPT JS (Logique intacte, Couleurs Tailwind injectées mises à jour) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fix Menu Actions
        const btnActions = document.getElementById('btn-menu-actions');
        const dropdownActions = document.getElementById('dropdown-menu-actions');

        if (btnActions && dropdownActions) {
            dropdownActions.classList.add('hidden');

            btnActions.addEventListener('click', function(e) {
                e.stopPropagation();
                if (dropdownActions.classList.contains('hidden')) {
                    dropdownActions.classList.remove('hidden');
                } else {
                    dropdownActions.classList.add('hidden');
                }
            });

            document.addEventListener('click', function(e) {
                if (!document.getElementById('menu-actions-wrapper').contains(e.target)) {
                    dropdownActions.classList.add('hidden');
                }
            });
        }

        // Système de Recherche
        const searchInput = document.getElementById('global-search');
        const searchResults = document.getElementById('search-results');
        const searchList = document.getElementById('search-list');

        if (searchInput) {
            const modules = [
                { name: 'Tableau de bord', url: '{{ route("dashboard") }}', icon: '📊' },
                { name: 'Gestion des Employés', url: '{{ route("users.index") }}', icon: '👥' },
                { name: 'Départements', url: '{{ route("departements.index") }}', icon: '🏢' },
                { name: 'Pointages', url: '{{ route("pointage.adminindex") }}', icon: '⏱️' },
                { name: 'Congés', url: '{{ route("conges") }}', icon: '📅' },
                { name: 'Produits', url: '{{ route("produits.index") }}', icon: '📦' },
                { name: 'Stocks', url: '{{ route("stocks.index") }}', icon: '🏭' },
                { name: 'Ventes', url: '{{ route("ventes.index") }}', icon: '💰' },
                { name: 'Achats', url: '{{ route("achats.index") }}', icon: '🛒' },
                { name: 'Catégories', url: '{{ route("categories.index") }}', icon: '📑' },
                { name: 'Tâches', url: '{{ route("taches.index") }}', icon: '✅' },
                { name: 'Objectifs', url: '{{ route("objectifs.index") }}', icon: '🎯' },
            ];

            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();
                searchList.innerHTML = '';

                if (searchTerm.length > 0) {
                    const filtered = modules.filter(module =>
                        module.name.toLowerCase().includes(searchTerm)
                    );

                    if (filtered.length > 0) {
                        filtered.forEach(item => {
                            const li = document.createElement('li');
                            // MISE À JOUR ICI : Couleurs adaptées au thème foncé
                            li.innerHTML = `
                            <a href="${item.url}" class="px-4 py-3 hover:bg-slate-700 cursor-pointer flex items-center gap-3 transition-colors border-b border-slate-700/50 last:border-0">
                                <span class="text-xl">${item.icon}</span>
                                <span class="font-medium text-slate-200">${item.name}</span>
                            </a>`;
                            searchList.appendChild(li);
                        });
                    } else {
                        // MISE À JOUR ICI : Message aucun résultat
                        searchList.innerHTML = '<li class="px-4 py-4 text-slate-500 text-center text-sm italic">Aucun module trouvé</li>';
                    }
                    searchResults.classList.remove('hidden');
                } else {
                    searchResults.classList.add('hidden');
                }
            });

            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });
        }
    });
</script>
