<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Nouvelle demande de congé') }}
        </h2>
    </x-slot>

    <div class="py-12 text-black">
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

                <form action="{{ route('conges.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Date début
                        </label>

                        <input
                            type="date"
                            name="date_debut"
                            value="{{ old('date_debut') }}"
                            id="currentDate"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Date fin
                        </label>
                        <script>
                             //   Automatically sets the input value to today's date
                                document.getElementById('currentDate').valueAsDate = new Date();
                                </script>

                        <input
                            type="date"
                            name="date_fin"
                            value="{{ old('date_fin') }}"
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

                            <option value="annuel">Annuel</option>
                            <option value="maladie">Maladie</option>
                            <option value="jours_ferie">Jour férié</option>
                            <option value="conge_de_maternite">Congé maternité</option>

                        </select>
                    </div>

                    <div class="flex justify-end">

                        <a href="{{ route('conges') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded mr-2">
                            Annuler
                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Enregistrer
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>
