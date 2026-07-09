<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Supervision des Pointages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-100 flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Historique Global des Présences</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Employé</th>
                                <th scope="col" class="px-6 py-3">Manager Direct</th>
                                <th scope="col" class="px-6 py-3">Heure Arrivée</th>
                                <th scope="col" class="px-6 py-3">Heure Départ</th>
                                <th scope="col" class="px-6 py-3">Statut Congé (Jour même)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pointages as $pointage)
                                <tr class="bg-white border-b hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($pointage->date)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $pointage->users->name ?? 'Utilisateur introuvable' }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $pointage->users->manager->name ?? 'Aucun manager' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 bg-green-100 text-green-800 rounded-full font-semibold text-xs">
                                            {{ $pointage->heure_arrive ? \Carbon\Carbon::parse($pointage->heure_arrive)->format('H:i') : '--:--' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($pointage->heure_depart)
                                            <span class="px-2.5 py-1 bg-blue-100 text-blue-800 rounded-full font-semibold text-xs">
                                                {{ \Carbon\Carbon::parse($pointage->heure_depart)->format('H:i') }}
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full font-semibold text-xs">
                                                En cours
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($pointage->users->conges->isNotEmpty())
                                            <span class="px-2.5 py-1 bg-purple-100 text-purple-800 border border-purple-200 rounded-md font-semibold text-xs flex w-fit items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                En congé ({{ $pointage->users->conges->first()->type ?? 'Absence' }})
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs italic">Présent / Non applicable</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                                        Aucun pointage enregistré pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-100">
                    {{ $pointages->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
