<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">
                    Gestion des Employés
                </h2>
                <p class="text-slate-400 mt-1">
                    Gérez les employés, leurs rôles et leurs informations.
                </p>
            </div>

            <a href="{{ route('users.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Ajouter un employé
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/20 rounded-2xl p-4 text-green-400">
                {{ session('success') }}
            </div>
        @endif

        {{-- Carte principale --}}
        <div class="bg-slate-800 border border-slate-700 rounded-2xl shadow-lg overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-700 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-white">
                        Liste du Personnel
                    </h3>
                    <p class="text-slate-400 text-sm mt-1">
                        Consultez et gérez tous les employés enregistrés.
                    </p>
                </div>

                <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-sm font-semibold">
                    {{ $users->total() }} Employés au total
                </span>
            </div>

            {{-- NOUVEAU : BARRE DE RECHERCHE ET FILTRES --}}
            <div class="px-6 py-4 bg-slate-800/50 border-b border-slate-700">
                <form action="{{ route('users.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
                    
                    {{-- Barre de recherche --}}
                    <div class="w-full md:w-1/3 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Rechercher par nom ou email ou CIN..." 
                               class="w-full pl-10 pr-4 py-2 bg-slate-900 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    {{-- Filtre par Rôle --}}
                    <div class="w-full md:w-1/4">
                        <select name="role" class="w-full px-4 py-2 bg-slate-900 border border-slate-700 rounded-lg text-white focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">Tous les rôles</option>
                            @if(isset($roles))
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- Filtre par Statut --}}
                    <div class="w-full md:w-1/4">
                        <select name="status" class="w-full px-4 py-2 bg-slate-900 border border-slate-700 rounded-lg text-white focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">Tous les statuts</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif</option>
                            <option value="desactive" {{ request('status') == 'desactive' ? 'selected' : '' }}>Désactivé</option>
                        </select>
                    </div>

                    {{-- Boutons d'action --}}
                    <div class="w-full md:w-auto flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition">
                            Filtrer
                        </button>
                        
                        {{-- Bouton réinitialiser (visible seulement si on a cherché quelque chose) --}}
                        @if(request()->anyFilled(['search', 'role', 'status']))
                            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg font-medium transition text-center">
                                Réinitialiser
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            {{-- FIN DE LA BARRE DE RECHERCHE --}}

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-900/40 border-b border-slate-700">
                    <tr class="text-slate-400 uppercase text-xs tracking-wider">
                        <th class="px-6 py-4 text-left">Employé</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Rôle</th>
                        <th class="px-6 py-4 text-left">Statut</th>
                        <th class="px-6 py-4 text-left">Naissance</th>
                        <th class="px-6 py-4 text-left">Embauche</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-700/30 transition">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-full bg-red-500/10 flex items-center justify-center text-red-400 font-bold text-lg">
                                        {{ strtoupper(substr($user->name_users ?? $user->name,0,1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">
                                            {{ $user->name_users ?? $user->name }}
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            ID #{{ $user->id }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-slate-300">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-5">
                                @if($user->getRoleNames()->isNotEmpty())
                                    @foreach($user->getRoleNames() as $role)
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $role=='Admin' ? 'bg-red-500/10 text-red-400' : ($role=='Manager' ? 'bg-yellow-500/10 text-yellow-400' : 'bg-green-500/10 text-green-400') }}">
                                            {{ $role }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="inline-flex px-3 py-1 rounded-full bg-slate-700 text-slate-300 text-xs">
                                        Aucun rôle
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5">
                                @if($user->statut === 'active')
                                    <span class="inline-flex px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-semibold">Actif</span>
                                @else
                                    <span class="inline-flex px-3 py-1 rounded-full bg-slate-500/10 text-slate-400 text-xs font-semibold">Désactivé</span>
                                @endif
                            </td>

                            <td class="px-6 py-5 text-slate-300">
                                {{ $user->date_naissance ? (is_string($user->date_naissance) ? \Carbon\Carbon::parse($user->date_naissance)->format('d/m/Y') : $user->date_naissance->format('d/m/Y')) : 'Non renseignée' }}
                            </td>

                            <td class="px-6 py-5 text-slate-300">
                                {{ $user->date_embauche ? (is_string($user->date_embauche) ? \Carbon\Carbon::parse($user->date_embauche)->format('d/m/Y') : $user->date_embauche->format('d/m/Y')) : ($user->created_at ? $user->created_at->format('d/m/Y') : 'Aujourd\'hui') }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    

                                    <a href="{{ route('users.edit',$user->id) }}" class="px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">
                                        Modifier
                                    </a>

                                    <form method="POST" action="{{ route('users.destroy',$user->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-14 text-center">
                                <div class="text-slate-500">
                                    <svg class="mx-auto w-12 h-12 mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-2a3 3 0 00-3-3H10a3 3 0 00-3 3v2m10 0H7m5-8a3 3 0 100-6 3 3 0 000 6z"/>
                                    </svg>
                                    <p class="text-lg">
                                        Aucun employé trouvé avec ces critères.
                                    </p>
                                    @if(request()->anyFilled(['search', 'role', 'status']))
                                        <a href="{{ route('users.index') }}" class="mt-4 inline-block px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg font-medium transition">
                                            Effacer les filtres
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-5 border-t border-slate-700 flex justify-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>