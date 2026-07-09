<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white">
            Modifier le Département : {{ $departement->nom_departement }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white shadow-lg rounded-xl p-8">

                <form action="{{ route('departements.update', $departement->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nom du département --}}
                    <div class="mb-6">
                        <label class="font-semibold text-gray-700">Nom du département</label>
                        <input type="text" name="nom_departement"
                               value="{{ old('nom_departement', $departement->nom_departement) }}"
                               class="w-full border rounded-lg mt-2 px-4 py-2 text-black" required>
                    </div>

                    {{-- Employés --}}
                    <div class="mb-6">
                        <label class="font-semibold text-gray-700">Employés</label>
                        <div class="border rounded-lg p-4 mt-2 max-h-48 overflow-y-auto bg-gray-50 grid grid-cols-1 md:grid-cols-2 gap-3 text-black">
                            @foreach($users as $user)
                                <label class="flex items-center gap-3 bg-white p-2.5 rounded-md border shadow-sm cursor-pointer hover:border-blue-300">
                                    <input type="checkbox" name="users[]" value="{{ $user->id }}"
                                           class="rounded text-blue-600"
                                           {{-- Vérifie si l'user est déjà lié au département --}}
                                           {{ $departement->users->contains($user->id) ? 'checked' : '' }}>
                                    <span class="text-sm">{{ $user->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Objectifs --}}
                    <div class="mb-6">
                        <label class="font-semibold text-gray-700">Objectifs</label>
                        <div class="border rounded-lg p-4 mt-2 max-h-48 overflow-y-auto bg-gray-50 grid grid-cols-1 md:grid-cols-2 gap-3 text-black">
                            @foreach($objectifs as $objectif)
                                <label class="flex items-center gap-3 bg-white p-2.5 rounded-md border shadow-sm cursor-pointer hover:border-purple-300">
                                    <input type="checkbox" name="objectifs[]" value="{{ $objectif->id }}"
                                           class="rounded text-purple-600"
                                           {{-- Vérifie si l'objectif est déjà lié --}}
                                           {{ $departement->objectifs->contains($objectif->id) ? 'checked' : '' }}>
                                    <span class="text-sm">{{ $objectif->titre_objectif }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('departements.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg">Annuler</a>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Mettre à jour</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
