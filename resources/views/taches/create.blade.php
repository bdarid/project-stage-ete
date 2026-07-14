<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="Assigner une nouvelle tâche" subtitle="Définissez les objectifs de la mission et assignez-les à un collaborateur.">
            <a href="{{ route('taches.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Retour
            </a>
        </x-erp.page-header>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Gestion des erreurs de validation --}}
            @if($errors->any())
                <div class="rounded-2xl border border-red-500/40 bg-red-500/10 p-5 mb-6">
                    <h3 class="font-semibold text-red-400 mb-3">Veuillez corriger les erreurs suivantes :</h3>
                    <ul class="list-disc ml-6 space-y-1 text-red-300 text-sm">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('taches.store') }}" method="POST">
                @csrf

                <x-erp.card title="Détails de la tâche" subtitle="Veuillez remplir les informations requises (*).">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Titre de la tâche --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Titre de la tâche <span class="text-red-400">*</span></label>
                            <input type="text" name="titre_taches" value="{{ old('titre_taches') }}" placeholder="Ex : Mise à jour du serveur" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                        </div>

                        {{-- Employé assigné --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Assigné à (Employé) <span class="text-red-400">*</span></label>
                            <select name="user_id" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                                <option value="">-- Choisir un employé --</option>
                                @foreach($employes as $employe)
                                    <option value="{{ $employe->id }}" {{ old('user_id') == $employe->id ? 'selected' : '' }}>
                                        {{ $employe->name }} ({{ $employe->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Description de la mission <span class="text-red-400">*</span></label>
                            <textarea name="description_taches" rows="4" placeholder="Détaillez les actions à effectuer..." class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition resize-y" required>{{ old('description_taches') }}</textarea>
                        </div>

                        {{-- Date de début --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Date de début <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <input type="date" name="date_debut" value="{{ old('date_debut') }}" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition [color-scheme:dark]" required>
                            </div>
                        </div>

                        {{-- Date de fin estimée --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Date de fin estimée</label>
                            <div class="relative">
                                <input type="date" name="date_fin" value="{{ old('date_fin') }}" class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition [color-scheme:dark]">
                            </div>
                        </div>
                        {{-- Priorité --}}
<div class="md:col-span-2">
    <label class="block text-sm font-semibold text-slate-300 mb-2">
        Priorité <span class="text-red-400">*</span>
    </label>

    <select
        name="priorite"
        class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition"
        required
    >
        <option value="">-- Choisir une priorité --</option>

        <option value="basse" {{ old('priorite') == 'basse' ? 'selected' : '' }}>
            🟢 Basse
        </option>

        <option value="haute" {{ old('priorite') == 'haute' ? 'selected' : '' }}>
            🟠 Haute
        </option>

        <option value="urgent" {{ old('priorite') == 'urgent' ? 'selected' : '' }}>
            🔴 Urgente
        </option>
    </select>
</div>

                    </div>
                </x-erp.card>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row justify-end gap-4 mt-6">
                    <a href="{{ route('taches.index') }}" class="px-6 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold text-center transition">
                        Annuler
                    </a>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg shadow-blue-600/20 transition">
                        Enregistrer la tâche
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>