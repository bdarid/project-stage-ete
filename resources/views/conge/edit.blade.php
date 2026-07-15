<x-app-layout>

    <x-slot name="header">
        <x-erp.page-header
            title="Modifier une demande de congé"
            subtitle="Modifiez les informations de cette demande ou validez-la."
        />
    </x-slot>

    <div class="space-y-6">

        <x-erp.alert />

        <div class="max-w-4xl mx-auto">

            <x-erp.card
                title="Informations de la demande"
                subtitle="Mettez à jour les informations du congé."
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

                <form action="{{ route('conges.update', $conge->id) }}" method="POST" class="space-y-6">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <x-erp.input
                            label="Date début"
                            name="date_debut"
                            type="date"
                            :value="old('date_debut', $conge->date_debut)"
                            required
                        />

                        <x-erp.input
                            label="Date fin"
                            name="date_fin"
                            type="date"
                            :value="old('date_fin', $conge->date_fin)"
                            required
                        />

                    </div>

                    <x-erp.select
                        name="type_conge"
                        label="Type de congé">

                        <option value="annuel"
                            @selected(old('type_conge', $conge->type_conge) == 'annuel')>
                            Annuel
                        </option>

                        <option value="maladie"
                            @selected(old('type_conge', $conge->type_conge) == 'maladie')>
                            Maladie
                        </option>

                        <option value="jours_ferie"
                            @selected(old('type_conge', $conge->type_conge) == 'jours_ferie')>
                            Jour férié
                        </option>

                        <option value="conge_de_maternite"
                            @selected(old('type_conge', $conge->type_conge) == 'conge_de_maternite')>
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

            @if(auth()->user()->hasRole(['Admin','Manager']) && $conge->statut == 'en attente')

                <div class="mt-6">

                    <x-erp.card
                        title="Décision de la direction"
                        subtitle="Acceptez ou refusez cette demande de congé."
                    >

                        <div class="flex flex-wrap gap-4">

                            <form action="{{ route('conges.valider',$conge->id) }}" method="POST" class="space-y-4">

    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium text-slate-300 mb-2">
            Décision
        </label>

        <select
            name="reponse"
            id="reponse"
            class="w-full rounded-xl bg-slate-800 border border-slate-600 text-white px-4 py-2">

            <option value="accepte">Accepter</option>
            <option value="refuse">Refuser</option>

        </select>
    </div>

    <div id="motifRefus" class="hidden">

        <label class="block text-sm font-medium text-slate-300 mb-2">
            Motif du refus
        </label>

        <textarea
            name="motif_refus"
            rows="4"
            class="w-full rounded-xl bg-slate-800 border border-slate-600 text-white px-4 py-3"
            placeholder="Expliquez pourquoi cette demande est refusée..."></textarea>

    </div>

    <button
        class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold">

        Enregistrer la décision

    </button>

</form>
<script>
document.addEventListener('DOMContentLoaded', () => {

    const select = document.getElementById('reponse');
    const motif = document.getElementById('motifRefus');

    function toggleMotif() {
        if (select.value === 'refuse') {
            motif.classList.remove('hidden');
        } else {
            motif.classList.add('hidden');
        }
    }

    toggleMotif();

    select.addEventListener('change', toggleMotif);

});
</script>

                        </div>

                    </x-erp.card>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>