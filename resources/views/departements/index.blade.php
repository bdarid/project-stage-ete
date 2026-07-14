<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header
            title="Gestion des Départements"
            subtitle="Consultez et gérez tous les départements de l'entreprise."
        >

            

        </x-erp.page-header>

    </x-slot>
    <a href="{{ route('departements.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 rounded-xl font-semibold text-white transition">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4"/>

                </svg>

                Nouveau Département

            </a>

    <div class="space-y-6">

        <x-erp.alert />

        <x-erp.card
            title="Liste des Départements"
            subtitle="Tous les départements enregistrés."
            :count="$departements->total()"
            label="Départements"
        >

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-slate-900/40 border-b border-slate-700">

                        <tr class="text-slate-400 uppercase text-xs tracking-wider">

                            <th class="px-6 py-4 text-left">
                                Département
                            </th>

                            <th class="px-6 py-4 text-center">
                                Employés
                            </th>

                            <th class="px-6 py-4 text-center">
                                Objectifs
                            </th>

                            <th class="px-6 py-4 text-right">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-700">
                                            @forelse($departements as $departement)

                            <tr class="hover:bg-slate-700/30 transition">

                                {{-- Département --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        <div class="w-11 h-11 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">

                                            {{ strtoupper(substr($departement->nom_departement,0,1)) }}

                                        </div>

                                        <div>

                                            <p class="font-semibold text-white">
                                                {{ $departement->nom_departement }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                Département #{{ $departement->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                {{-- Employés --}}
                                <td class="px-6 py-5 text-center">

                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-semibold">

                                        {{ $departement->users->count() }}

                                    </span>

                                </td>

                                {{-- Objectifs --}}
                                <td class="px-6 py-5 text-center">

                                    <span class="inline-flex px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-semibold">

                                        {{ $departement->objectifs->count() }}

                                    </span>

                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-2">

                                        <a href="{{ route('departements.show',$departement) }}"
                                           class="px-3 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">

                                            Voir

                                        </a>

                                        <a href="{{ route('departements.edit',$departement) }}"
                                           class="px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">

                                            Modifier

                                        </a>

                                        <form action="{{ route('departements.destroy',$departement) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer ce département ?')">

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

                                <td colspan="4" class="py-14 text-center">

                                    <div class="text-slate-500">

                                        <svg class="mx-auto w-12 h-12 mb-3 opacity-50"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M19 11H5m14-7H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2z"/>

                                        </svg>

                                        <p class="text-lg">

                                            Aucun département enregistré.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
            @if(method_exists($departements,'links'))

<div class="px-6 py-5 border-t border-slate-700 flex items-center justify-between">

    <div class="text-sm text-slate-400">

        Affichage de

        <span class="font-semibold text-white">

            {{ $departements->firstItem() }}

        </span>

        à

        <span class="font-semibold text-white">

            {{ $departements->lastItem() }}

        </span>

        sur

        <span class="font-semibold text-white">

            {{ $departements->total() }}

        </span>

        départements

    </div>

    <div>

        {{ $departements->links() }}

    </div>

</div>

@endif

        </x-erp.card>

    </div>

</x-app-layout>