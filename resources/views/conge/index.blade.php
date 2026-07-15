<x-app-layout>
    
    <x-slot name="header">
        <x-erp.page-header
            title="Gestion des Congés"
            subtitle="Consultez et gérez toutes les demandes de congé."
        >

            <a href="{{ route('conges.create') }}"
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

                Nouvelle demande

            </a>

        </x-erp.page-header>
        
    </x-slot>

    <div class="space-y-6">

        <x-erp.alert/>

        <x-erp.card
            title="Demandes de congé"
            subtitle="Toutes les demandes enregistrées."
            :count="$conges->total()"
            label="Demandes"
        >
        <a href="{{ route('conges.create') }}"
   class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition">

    <svg class="w-5 h-5"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 4v16m8-8H4"/>
    </svg>

    Nouvelle demande de congé

</a>
            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-slate-900/40 border-b border-slate-700">

                        <tr class="text-slate-400 uppercase text-xs tracking-wider">

                            <th class="px-6 py-4 text-left">#</th>
                            <th class="px-6 py-4 text-left">Employé</th>
                            <th class="px-6 py-4 text-left">Type</th>
                            <th class="px-6 py-4 text-left">Début</th>
                            <th class="px-6 py-4 text-left">Fin</th>
                            <th class="px-6 py-4 text-left">Durée</th>
                            <th class="px-6 py-4 text-left">Solde</th>
                            <th class="px-6 py-4 text-left">Statut</th>
                            <th class="px-6 py-4 text-left">Réponse</th>
                            <th class="px-6 py-4 text-left">Motif</th>
                            <th class="px-6 py-4 text-right">Actions</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-700">

                    @forelse($conges as $conge)

                        <tr class="hover:bg-slate-700/30 transition">

                            <td class="px-6 py-5 text-slate-500">
                                {{ $conges->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-4">

                                    <div class="w-11 h-11 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">

                                        {{ strtoupper(substr($conge->user->name_users ?? '-',0,1)) }}

                                    </div>

                                    <div>

                                        <p class="font-semibold text-white">

                                            {{ $conge->user->name_users ?? '-' }}

                                        </p>

                                        <p class="text-xs text-slate-500">

                                            Demande #{{ $conge->id }}

                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-5">
                                                            @if($conge->type_conge == 'annuel')

                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-semibold">
                                        Annuel
                                    </span>

                                @elseif($conge->type_conge == 'maladie')

                                    <span class="inline-flex px-3 py-1 rounded-full bg-red-500/10 text-red-400 text-xs font-semibold">
                                        Maladie
                                    </span>

                                @elseif($conge->type_conge == 'jours_ferie')

                                    <span class="inline-flex px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-400 text-xs font-semibold">
                                        Jour férié
                                    </span>

                                @else

                                    <span class="inline-flex px-3 py-1 rounded-full bg-pink-500/10 text-pink-400 text-xs font-semibold">
                                        Congé maternité
                                    </span>

                                @endif

                            </td>

                            {{-- Date début --}}
                            <td class="px-6 py-5 text-slate-300">
                                {{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}
                            </td>

                            {{-- Date fin --}}
                            <td class="px-6 py-5 text-slate-300">
                                {{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}
                            </td>

                            {{-- Durée --}}
                            <td class="px-6 py-5">

                                <span class="font-semibold text-white">
                                    {{ $conge->duree }}
                                </span>

                                <span class="text-slate-500 text-sm">
                                    jour(s)
                                </span>

                            </td>

                            {{-- Solde --}}
                            <td class="px-6 py-5">

                                <span class="font-semibold text-white">
                                    {{ $conge->solde }}
                                </span>

                                <span class="text-slate-500 text-sm">
                                    jour(s)
                                </span>

                            </td>

                            {{-- Statut --}}
                            <td class="px-6 py-5">

                                @if($conge->statut == 'en attente')

                                    <span class="inline-flex px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-400 text-xs font-semibold">
                                        En attente
                                    </span>

                                @elseif($conge->statut == 'en cours')

                                    <span class="inline-flex px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-semibold">
                                        En cours
                                    </span>

                                @else

                                    <span class="inline-flex px-3 py-1 rounded-full bg-red-500/10 text-red-400 text-xs font-semibold">
                                        Hors congé
                                    </span>

                                @endif

                            </td>

                            {{-- Réponse --}}
                            <td class="px-6 py-5">

                                @if($conge->reponse == 'accepte')

                                    <span class="inline-flex px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-semibold">
                                        Accepté
                                    </span>

                                @elseif($conge->reponse == 'refuse')

                                    <span class="inline-flex px-3 py-1 rounded-full bg-red-500/10 text-red-400 text-xs font-semibold">
                                        Refusé
                                    </span>

                                @else

                                    <span class="text-slate-500">
                                        —
                                    </span>

                                @endif

                            </td>
                            
                             <td class="px-6 py-5">

    @if($conge->reponse == 'refuse')

        @if($conge->motif_refus)

            <div class="max-w-xs whitespace-normal break-words text-red-300 text-sm">
                {{ $conge->motif_refus }}
            </div>

        @else

            <span class="text-slate-500 italic">
                Aucun motif
            </span>

        @endif

    @else

        <span class="text-slate-500">—</span>

    @endif

</td>

                            {{-- Actions --}}
                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">
                                                                    @if($conge->reponse == null)

                                        <a href="{{ route('conges.edit', $conge->id) }}"
                                           class="px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">

                                            Modifier

                                        </a>

                                        <form action="{{ route('conges.destroy', $conge->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer cette demande ?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition">

                                                Supprimer

                                            </button>

                                        </form>

                                    @else

                                        <span class="inline-flex items-center px-3 py-2 rounded-lg bg-green-500/10 text-green-400 text-sm font-semibold">

                                            ✓ Validée

                                        </span>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="11" class="py-16 text-center">

                                <div class="text-slate-500">

                                    <svg
                                        class="mx-auto w-14 h-14 mb-4 opacity-40"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"/>

                                    </svg>

                                    <p class="text-xl font-semibold text-slate-300">

                                        Aucune demande de congé.

                                    </p>

                                    <p class="mt-2">

                                        Cliquez sur <strong>Nouvelle demande</strong> pour créer votre première demande.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            @if(method_exists($conges,'links'))

                <div class="px-6 py-5 border-t border-slate-700 flex justify-between items-center">

                    <p class="text-sm text-slate-400">

                        Affichage de

                        <span class="font-semibold text-white">
                            {{ $conges->firstItem() }}
                        </span>

                        à

                        <span class="font-semibold text-white">
                            {{ $conges->lastItem() }}
                        </span>

                        sur

                        <span class="font-semibold text-white">
                            {{ $conges->total() }}
                        </span>

                        demandes

                    </p>

                    {{ $conges->links() }}

                </div>

            @endif

        </x-erp.card>

    </div>

</x-app-layout>