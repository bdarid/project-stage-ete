<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header>
            <x-slot:title>Modifier la tâche</x-slot:title>
            <x-slot:description>Mise à jour des détails et de l'assignation de la tâche.</x-slot:description>
        </x-erp.page-header>
    </x-slot>

    <x-erp.form-card>
        <x-erp.alert type="error"/>

        <form action="{{ route('taches.update', $tache->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <x-erp.input 
                name="titre_taches" 
                label="Titre de la tâche" 
                value="{{ old('titre_taches', $tache->titre_taches) }}"/>

            <x-erp.input 
                name="description_taches" 
                label="Description" 
                value="{{ old('description_taches', $tache->description_taches) }}"/>

            <div class="grid md:grid-cols-2 gap-6">
                <x-erp.input 
                    name="date_debut" 
                    label="Date de début" 
                    type="date" 
                    value="{{ old('date_debut', \Carbon\Carbon::parse($tache->date_debut)->format('Y-m-d')) }}"/>
                
                <x-erp.input 
                    name="date_fin" 
                    label="Date de fin estimée" 
                    type="date" 
                    value="{{ old('date_fin', $tache->date_fin ? \Carbon\Carbon::parse($tache->date_fin)->format('Y-m-d') : '') }}"/>
            </div>
            <x-erp.select name="priorite" label="Priorité">
    <option value="">-- Sélectionner une priorité --</option>

    <option value="basse"
        {{ old('priorite', $tache->priorite) == 'basse' ? 'selected' : '' }}>
        Basse
    </option>

    <option value="haute"
        {{ old('priorite', $tache->priorite) == 'haute' ? 'selected' : '' }}>
        Haute
    </option>

    <option value="urgent"
        {{ old('priorite', $tache->priorite) == 'urgent' ? 'selected' : '' }}>
        Urgente
    </option>
</x-erp.select>

            <x-erp.select name="user_id" label="Assigner à un employé">
                @foreach($employes as $emp)
                    <option value="{{ $emp->id }}" {{ $affectation->users_id == $emp->id ? 'selected' : '' }}>
                        {{ $emp->name_users }}
                    </option>
                @endforeach
            </x-erp.select>

            <x-erp.form-actions>
                <x-erp.button href="{{ route('taches.index') }}" color="gray">
                    Annuler
                </x-erp.button>
                <x-erp.button type="submit">
                    Enregistrer les modifications
                </x-erp.button>
            </x-erp.form-actions>
        </form>
    </x-erp.form-card>
</x-app-layout>