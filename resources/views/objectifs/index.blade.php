<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header
            title="Gestion des Objectifs"
            subtitle="Consultez et gérez les objectifs de votre entreprise."
        >

            

        </x-erp.page-header>

    </x-slot>
    <a
                href="{{ route('objectifs.create') }}"
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

                Nouvel Objectif

            </a>

    <div class="space-y-6">

        <x-erp.alert />

        <x-erp.card
            title="Liste des Objectifs"
            subtitle="Tous les objectifs enregistrés."
            :count="$objectifs->total()"
            label="Objectifs"
        >

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-slate-900/40 border-b border-slate-700">

                        <tr class="text-slate-400 uppercase text-xs tracking-wider">

                            <th class="px-6 py-4 text-left">
                                Objectif
                            </th>

                            <th class="px-6 py-4 text-left">
                                Employés
                            </th>

                            <th class="px-6 py-4 text-left">
                                Département
                            </th>

                            <th class="px-6 py-4 text-center">
                                Début
                            </th>

                            <th class="px-6 py-4 text-center">
                                Fin
                            </th>

                            <th class="px-6 py-4 text-center">
                                Avancement
                            </th>

                            <th class="px-6 py-4 text-right">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-700">

                        @forelse($objectifs as $objectif)

                        <tr class="hover:bg-slate-700/30 transition">

                            {{-- Objectif --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-4">

                                    <div class="w-11 h-11 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-400">

    <svg class="w-5 h-5"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 2v4m0 12v4m10-10h-4M6 12H2m15.07-7.07l-2.83 2.83M9.76 14.24l-2.83 2.83m0-12.14l2.83 2.83m7.31 7.31l2.83 2.83M12 16a4 4 0 100-8 4 4 0 000 8z"/>
    </svg>

</div>

                                    <div>

                                        <p class="font-semibold text-white">
                                            {{ $objectif->titre_objectif }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            {{ Str::limit($objectif->description_objectif,70) }}
                                        </p>

                                    </div>

                                </div>

                            </td>

                            {{-- Employés --}}
                            <td class="px-6 py-5">

                                @forelse($objectif->users as $user)

                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-semibold mr-1 mb-1">
                                        {{ $user->name_users }}
                                    </span>

                                @empty

                                    <span class="text-slate-500">
                                        Aucun
                                    </span>

                                @endforelse

                            </td>

                            {{-- Département --}}
                            <td class="px-6 py-5">

                                @forelse($objectif->departement as $dep)

                                    <span class="inline-flex px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-semibold mr-1 mb-1">
                                        {{ $dep->nom_departement }}
                                    </span>

                                @empty

                                    <span class="text-slate-500">
                                        Aucun
                                    </span>

                                @endforelse

                            </td>

                            {{-- Début --}}
                            <td class="px-6 py-5 text-center text-slate-300">

                                {{ $objectif->date_debut_obj ?? '-' }}

                            </td>

                            {{-- Fin --}}
                            <td class="px-6 py-5 text-center text-slate-300">

                                {{ $objectif->date_fin_obj ?? '-' }}

                            </td>

                            {{-- Avancement --}}
                            <td class="px-6 py-5">

                                <div class="w-full h-2 bg-slate-700 rounded-full overflow-hidden">

                                    <div
                                        class="h-full bg-blue-500 rounded-full"
                                        style="width: {{ $objectif->etat_avancement_objectif }}%">
                                    </div>

                                </div>

                                <div class="text-center text-xs mt-2 font-semibold text-white">

                                    {{ $objectif->etat_avancement_objectif }}%

                                </div>

                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('objectifs.show',$objectif->id) }}"
                                        class="px-3 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium transition">

                                        Voir

                                    </a>

                                    <a
                                        href="{{ route('objectifs.edit',$objectif->id) }}"
                                        class="px-3 py-2 rounded-lg bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium transition">

                                        Modifier

                                    </a>

                                    <form
                                        action="{{ route('objectifs.destroy',$objectif->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Supprimer cet objectif ?')">

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

    <td colspan="7" class="py-14 text-center">

        <div class="text-slate-500">

            <svg class="mx-auto w-12 h-12 mb-3 opacity-50"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>

            </svg>

            <p class="text-lg">

                Aucun objectif enregistré.

            </p>

        </div>

    </td>

</tr>

@endforelse

                    </tbody>

                </table>

            </div>

@if(method_exists($objectifs,'links'))

<div class="px-6 py-5 border-t border-slate-700 flex items-center justify-between">

    <div class="text-sm text-slate-400">

        Affichage de

        <span class="font-semibold text-white">
            {{ $objectifs->firstItem() }}
        </span>

        à

        <span class="font-semibold text-white">
            {{ $objectifs->lastItem() }}
        </span>

        sur

        <span class="font-semibold text-white">
            {{ $objectifs->total() }}
        </span>

        objectifs

    </div>

    <div>

        {{ $objectifs->links() }}

    </div>

</div>

@endif

        </x-erp.card>

    </div>

</x-app-layout>