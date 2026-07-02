<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier une demande de congé') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">

                        <ul class="list-disc ml-5">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>
                @endif

                <form action="{{ route('conges.update',$conge->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block text-sm font-medium text-gray-700">
                            Date début
                        </label>

                        <input
                            type="date"
                            name="date_debut"
                            value="{{ old('date_debut',$conge->date_debut) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="block text-sm font-medium text-gray-700">
                            Date fin
                        </label>

                        <input
                            type="date"
                            name="date_fin"
                            value="{{ old('date_fin',$conge->date_fin) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required>

                    </div>

                    <div class="mb-6">

                        <label class="block text-sm font-medium text-gray-700">
                            Type de congé
                        </label>

                        <select
                            name="type_conge"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

                            <option value="annuel"
                                {{ $conge->type_conge=='annuel'?'selected':'' }}>
                                Annuel
                            </option>

                            <option value="maladie"
                                {{ $conge->type_conge=='maladie'?'selected':'' }}>
                                Maladie
                            </option>

                            <option value="jours_ferie"
                                {{ $conge->type_conge=='jours_ferie'?'selected':'' }}>
                                Jour férié
                            </option>

                            <option value="conge_de_maternite"
                                {{ $conge->type_conge=='conge_de_maternite'?'selected':'' }}>
                                Congé maternité
                            </option>

                        </select>

                    </div>

                    <div class="flex justify-end">

                        <a href="{{ route('conges') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded mr-2">
                            Annuler
                        </a>

                        <button
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Modifier
                        </button>

                    </div>

                </form>
                {{-- SECTION ADMIN : DÉCISION POUR LE CONGÉ --}}
@if(auth()->user()->hasRole(['Admin','Manager']) && $conge->statut == 'en attente')
    <div class="mt-8 pt-6 border-t border-gray-200">
        <h3 class="text-lg font-medium text-gray-900 mb-4">
            Décision de la direction (Admin/Manager)
        </h3>
        
        <div class="flex gap-4">
            {{-- Formulaire pour ACCEPTER --}}
            <form action="{{ route('conges.valider', $conge->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="reponse" value="accepte">
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir ACCEPTER cette demande ?')" 
                        class="px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 shadow-sm">
                    ✓ Accepter la demande
                </button>
            </form>

            {{-- Formulaire pour REFUSER --}}
            <form action="{{ route('conges.valider', $conge->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="reponse" value="refuse">
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir REFUSER cette demande ?')" 
                        class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 shadow-sm">
                    ✗ Refuser la demande
                </button>
            </form>
        </div>
    </div>
@endif

            </div>

        </div>

    </div>

</x-app-layout>