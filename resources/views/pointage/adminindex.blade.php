<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header
            title="Supervision des Pointages"
            subtitle="Consultez l'historique des présences de tous les employés."
        />

    </x-slot>

    <div class="space-y-6">

        <x-erp.alert />

        <x-erp.card
            title="Historique des Présences"
            subtitle="Tous les pointages enregistrés."
            :count="$pointages->total()"
            label="Pointages"
        >

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-slate-900/40 border-b border-slate-700">

                        <tr class="text-slate-400 uppercase text-xs tracking-wider">

                            <th class="px-6 py-4 text-left">
                                Date
                            </th>

                            <th class="px-6 py-4 text-left">
                                Employé
                            </th>

                            <th class="px-6 py-4 text-left">
                                Manager
                            </th>

                            <th class="px-6 py-4 text-left">
                                Arrivée
                            </th>

                            <th class="px-6 py-4 text-left">
                                Départ
                            </th>

                            <th class="px-6 py-4 text-left">
                                Statut
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-700">

                        @forelse($pointages as $pointage)

                        

<tr class="hover:bg-slate-700/30 transition">

    {{-- Date --}}
    <td class="px-6 py-5 text-slate-300">
        {{ \Carbon\Carbon::parse($pointage->date)->format('d/m/Y') }}
    </td>

    {{-- Employé --}}
    <td class="px-6 py-5">

        <div class="flex items-center gap-4">

            <div class="w-11 h-11 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">
                {{ strtoupper(substr($pointage->users->name ?? '?',0,1)) }}
            </div>

            <div>

                <p class="font-semibold text-white">
                    {{ $pointage->users->name ?? 'Utilisateur introuvable' }}
                </p>

                <p class="text-xs text-slate-500">
                    ID #{{ $pointage->users->id ?? '-' }}
                </p>

            </div>

        </div>

    </td>

    {{-- Manager --}}
    <td class="px-6 py-5 text-slate-300">

        {{ $pointage->users->manager->name ?? 'Aucun manager' }}

    </td>

    {{-- Arrivée --}}
    <td class="px-6 py-5">

        @if($pointage->heure_arrive)

            <span class="inline-flex px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-semibold">
                {{ \Carbon\Carbon::parse($pointage->heure_arrive)->format('H:i') }}
            </span>

        @else

            <span class="inline-flex px-3 py-1 rounded-full bg-slate-700 text-slate-400 text-xs">
                --:--
            </span>

        @endif

    </td>

    {{-- Départ --}}
    <td class="px-6 py-5">

        @if($pointage->heure_depart)

            <span class="inline-flex px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-semibold">
                {{ \Carbon\Carbon::parse($pointage->heure_depart)->format('H:i') }}
            </span>

        @else

            <span class="inline-flex px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-400 text-xs font-semibold">
                En cours
            </span>

        @endif

    </td>

    {{-- Congé --}}
    <td class="px-6 py-5">

        @if($pointage->users && $pointage->users->conges->isNotEmpty())

            <span class="inline-flex px-3 py-1 rounded-full bg-purple-500/10 text-purple-400 text-xs font-semibold">
                En congé
            </span>

        @else

            <span class="inline-flex px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-semibold">
                Présent
            </span>

        @endif

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
                      d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>

            </svg>

            <p class="text-lg">
                Aucun pointage enregistré.
            </p>

        </div>

    </td>

</tr>

@endforelse

</tbody>
</table>

</div>

@if(method_exists($pointages,'links'))

<div class="px-6 py-5 border-t border-slate-700 flex items-center justify-between">

    <div class="text-sm text-slate-400">
        Affichage de
        <span class="font-semibold text-white">{{ $pointages->firstItem() }}</span>
        à
        <span class="font-semibold text-white">{{ $pointages->lastItem() }}</span>
        sur
        <span class="font-semibold text-white">{{ $pointages->total() }}</span>
        pointages
    </div>

    <div>
        {{ $pointages->links() }}
    </div>

</div>

@endif

</x-erp.card>

</div>

</x-app-layout>