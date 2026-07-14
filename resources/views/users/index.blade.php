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
                    {{ $users->count() }} Employés
                </span>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-slate-900/40 border-b border-slate-700">
                    <tr class="text-slate-400 uppercase text-xs tracking-wider">

                        <th class="px-6 py-4 text-left">Employé</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Rôle</th>
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

                                        <span
                                            class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $role=='Admin'
                                                ? 'bg-red-500/10 text-red-400'
                                                : ($role=='Manager'
                                                    ? 'bg-yellow-500/10 text-yellow-400'
                                                    : 'bg-green-500/10 text-green-400') }}">
                                            {{ $role }}
                                        </span>

                                    @endforeach

                                @else

                                    <span class="inline-flex px-3 py-1 rounded-full bg-slate-700 text-slate-300 text-xs">
                                        Aucun rôle
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-5 text-slate-300">

                                {{ $user->date_naissance
                                    ? $user->date_naissance->format('d/m/Y')
                                    : 'Non renseignée' }}

                            </td>

                            <td class="px-6 py-5 text-slate-300">

                                {{ $user->date_embauche
                                    ? $user->date_embauche->format('d/m/Y')
                                    : ($user->created_at
                                        ? $user->created_at->format('d/m/Y')
                                        : 'Aujourd\'hui') }}

                            </td>

                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <a href="{{ route('users.edit',$user->id) }}"
                                       class="px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">
                                        Modifier
                                    </a>

                                    <form method="POST"
                                          action="{{ route('users.destroy',$user->id) }}"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition">
                                            Supprimer
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="py-14 text-center">

                                <div class="text-slate-500">

                                    <svg class="mx-auto w-12 h-12 mb-3 opacity-50"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M17 20h5V4H2v16h5m10 0v-2a3 3 0 00-3-3H10a3 3 0 00-3 3v2m10 0H7m5-8a3 3 0 100-6 3 3 0 000 6z"/>

                                    </svg>

                                    <p class="text-lg">
                                        Aucun employé enregistré.
                                    </p>

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