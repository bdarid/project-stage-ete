<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white">
            Détails du Département
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto">

            <div class="bg-white shadow-lg rounded-xl p-8">

                <div class="grid grid-cols-2 gap-8">

                    {{-- Informations --}}
                    <div>

                        <h3 class="text-xl font-bold mb-6 text-black" >
                            Informations
                        </h3>

                        <div class="space-y-4 text-black" >

                            <div>
                                <span class="font-semibold text-black">Nom :</span>
                                <span>{{ $departement->nom_departement }}</span>
                            </div>

                            <div>
                                <span class="font-semibold text-black">Nombre d'employés :</span>
                                <span>{{ $departement->users->count()}}</span>
                            </div>

                            <div>
                                <span class="font-semibold text-black">Nombre d'objectifs :</span>
                                <span>{{ $departement->objectifs->count() }}</span>
                            </div>

                            <div>
                                <span class="font-semibold text-black">Créé le :</span>
                                <span>{{ $departement->created_at->format('d/m/Y H:i') }}</span>
                            </div>

                        </div>

                    </div>

                    {{-- Employés --}}
                    <div>

                        <h3 class="text-xl font-bold mb-6 text-black">
                            Employés
                        </h3>

                        @forelse($departement->users as $user)

                            <div class="border rounded-lg p-3 mb-2 text-black">

                                <div class="font-semibold">
                                    {{ $user->name }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ $user->email }}
                                </div>

                            </div>

                        @empty

                            <p class=" text-black">
                                Aucun employé.
                            </p>

                        @endforelse

                    </div>

                </div>

                {{-- Objectifs --}}
                <div class="mt-10 text-black">

                    <h3 class="text-xl font-bold mb-6">
                        Objectifs associés
                    </h3>

                    @forelse($departement->objectifs as $objectif)

                        <div class="border rounded-lg p-4 mb-4">

                            <div class="font-semibold text-lg">
                                {{ $objectif->titre_objectif }}
                            </div>

                            <div class="text-gray-600 mt-2">
                                {{ $objectif->description_objectif }}
                            </div>

                            <div class="mt-3">

                                <span class="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full">

                                    Avancement :
                                    {{ $objectif->etat_avancement_objectif }}%

                                </span>

                            </div>

                        </div>

                    @empty

                        <p class="text-gray-500">
                            Aucun objectif associé.
                        </p>

                    @endforelse

                </div>

                <div class="flex justify-end gap-4 mt-8">

                    <a href="{{ route('departements.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">

                        Retour

                    </a>

                    <a href="{{ route('departements.edit',$departement) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg">

                        Modifier

                    </a>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
