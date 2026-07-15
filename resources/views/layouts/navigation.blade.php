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
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                </svg>
                                Dashboard
                            </a>
                            <a href="{{ route('pointage.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Pointer l'Heure
                            </a>
                            <a href="{{ route('conges') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Demande Congé
                            </a>
                        </div>

                        @role('Admin|Manager')
                        <div class="py-2">
                            <div class="px-4 py-1 text-[10px] font-black text-slate-500 uppercase tracking-wider">RH & Équipe</div>
                            <a href="{{ route('users.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/>
                                </svg>
                                Liste des Employés
                            </a>
                            <a href="{{ route('users.create') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-blue-400 font-medium hover:bg-slate-700 hover:text-blue-300 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Ajouter un Employé
                            </a>
                        </div>
                        <div class="py-2">
                            <div class="px-4 py-1 text-[10px] font-black text-slate-500 uppercase tracking-wider">Logistique & Ventes</div>
                            <a href="{{ route('produits.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                Gérer les Produits
                            </a>
                            <a href="{{ route('ventes.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Gérer les Ventes
                            </a>
                            <a href="{{ route('achats.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-300 hover:bg-slate-700 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Gérer les Achats
                            </a>
                        </div>
                        @endrole
                    </div>
                </div>
                <div class="relative">

    <a href="{{ route('notifications.index') }}"
       class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-slate-900 border border-slate-700 hover:border-blue-500 transition">

        <svg class="w-5 h-5 text-slate-300"
             fill="none"
             stroke="currentColor"
             viewBox="0 0 24 24">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0h6z"/>
        </svg>

        @if($nbNotifications > 0)
            <span class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-red-500 text-white text-xs flex items-center justify-center">
                {{ $nbNotifications }}
            </span>
        @endif

    </a>

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

<!-- SCRIPT JS (Logique intacte, icônes emoji remplacées par des SVG) -->
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
            // Petit helper pour générer une icône SVG (remplace les emojis)
            const icon = (path) => `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${path}"/></svg>`;

            const modules = [
                { name: 'Tableau de bord', url: '{{ route("dashboard") }}', icon: icon('M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z') },
                { name: 'Gestion des Employés', url: '{{ route("users.index") }}', icon: icon('M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4') },
                { name: 'Départements', url: '{{ route("departements.index") }}', icon: icon('M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2M5 21h2m0 0h10M7 21v-4a1 1 0 011-1h2a1 1 0 011 1v4M9 7h1m-1 4h1m4-4h1m-1 4h1') },
                { name: 'Pointages', url: '{{ route("pointage.adminindex") }}', icon: icon('M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z') },
                { name: 'Congés', url: '{{ route("conges") }}', icon: icon('M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z') },
                { name: 'Produits', url: '{{ route("produits.index") }}', icon: icon('M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4') },
                { name: 'Stocks', url: '{{ route("stocks.index") }}', icon: icon('M5 8h14M5 8a2 2 0 01-2-2V4a2 2 0 012-2h14a2 2 0 012 2v2a2 2 0 01-2 2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4') },
                { name: 'Ventes', url: '{{ route("ventes.index") }}', icon: icon('M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z') },
                { name: 'Achats', url: '{{ route("achats.index") }}', icon: icon('M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z') },
                { name: 'Catégories', url: '{{ route("categories.index") }}', icon: icon('M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z') },
                { name: 'Tâches', url: '{{ route("taches.employe") }}', icon: icon('M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z') },
                { name: 'Objectifs', url: '{{ route("objectifs.index") }}', icon: icon('M3 3v18M3 4h13l-2 4 2 4H3') },
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
                            // Icônes SVG adaptées au thème foncé (currentColor hérite du span parent)
                            li.innerHTML = `
                            <a href="${item.url}" class="px-4 py-3 hover:bg-slate-700 cursor-pointer flex items-center gap-3 transition-colors border-b border-slate-700/50 last:border-0">
                                <span class="flex-shrink-0 text-blue-500">${item.icon}</span>
                                <span class="font-medium text-slate-200">${item.name}</span>
                            </a>`;
                            searchList.appendChild(li);
                        });
                    } else {
                        // Message aucun résultat
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