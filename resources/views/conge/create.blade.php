<x-app-layout>

    <x-slot name="header">
        <x-erp.page-header
            title="Nouvelle demande de congé"
            subtitle="Créez une nouvelle demande de congé."
        />
    </x-slot>

    <div class="space-y-6">

        <x-erp.alert />

        <div class="max-w-4xl mx-auto">

            <x-erp.card
                title="Nouvelle demande"
                subtitle="Remplissez les informations ci-dessous."
            >

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('conges.store') }}" method="POST" class="space-y-6">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <x-erp.input
                            label="Date début"
                            name="date_debut"
                            id="currentDate"
                            type="date"
                            :value="old('date_debut')"
                            required
                        />

                        <x-erp.input
                            label="Date fin"
                            name="date_fin"
                            type="date"
                            :value="old('date_fin')"
                            required
                        />

                    </div>

                    <x-erp.select
                        name="type_conge"
                        label="Type de congé">

                        <option value="annuel"
                            @selected(old('type_conge')=='annuel')>
                            Annuel
                        </option>

                        <option value="maladie"
                            @selected(old('type_conge')=='maladie')>
                            Maladie
                        </option>

                        <option value="jours_ferie"
                            @selected(old('type_conge')=='jours_ferie')>
                            Jour férié
                        </option>

                        <option value="conge_de_maternite"
                            @selected(old('type_conge')=='conge_de_maternite')>
                            Congé maternité
                        </option>

                    </x-erp.select>

                    <div class="flex justify-end gap-3 border-t border-slate-700 pt-6">

                        <a href="{{ route('conges') }}"
                           class="px-5 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-medium transition">
                            Annuler
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                            Enregistrer
                        </button>

                    </div>

                </form>

            </x-erp.card>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentDate = document.getElementById('currentDate');

            if (currentDate && !currentDate.value) {
                currentDate.valueAsDate = new Date();
            }
        });
    </script>

</x-app-layout>