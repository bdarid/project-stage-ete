<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header
            title="Modifier un Département"
            subtitle="Modifiez les informations du département et ses associations."
        />

    </x-slot>

    <div class="space-y-6">

        <x-erp.alert />

        <div class="max-w-5xl mx-auto" >

            <x-erp.card
                title="Informations du département"
                subtitle="Mettre à jour les informations."
            >

                @if ($errors->any())

                    <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300" >

                        <ul class="list-disc list-inside space-y-1">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('departements.update',$departement->id) }}"
                      method="POST"
                      class="space-y-8">

                    @csrf
                    @method('PUT')

                    <x-erp.input
                        label="Nom du département"
                        name="nom_departement"
                        :value="old('nom_departement',$departement->nom_departement)"
                        required
                    />
                                        {{-- Employés --}}

                    <div>

                        <label class="block text-sm font-semibold text-slate-300 mb-3">

                            Employés du département

                        </label>

                        <div class="rounded-xl border border-slate-700 bg-slate-900 p-5 max-h-72 overflow-y-auto">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                                @foreach($users as $user)

                                    <label class="flex items-center gap-3 rounded-lg border border-slate-700 bg-slate-800 hover:bg-slate-700 hover:border-blue-500 p-3 cursor-pointer transition">

                                        <input
                                            type="checkbox"
                                            name="users[]"
                                            value="{{ $user->id }}"
                                            class="rounded border-slate-600 bg-slate-900 text-blue-600 focus:ring-blue-500"
                                            {{
                                                in_array(
                                                    $user->id,
                                                    old(
                                                        'users',
                                                        $departement->users->pluck('id')->toArray()
                                                    )
                                                )
                                                ? 'checked'
                                                : ''
                                            }}>

                                        <div class="w-10 h-10 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">

                                            {{ strtoupper(substr($user->name,0,1)) }}

                                        </div>

                                        <div>

                                            <p class="text-white font-medium">

                                                {{ $user->name }}

                                            </p>

                                            <p class="text-xs text-slate-400">

                                                Employé

                                            </p>

                                        </div>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    </div>
                                        {{-- Employés --}}

                    <div>

                        <label class="block text-sm font-semibold text-slate-300 mb-3">

                            Employés du département

                        </label>

                        <div class="rounded-xl border border-slate-700 bg-slate-900 p-5 max-h-72 overflow-y-auto">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                                @foreach($users as $user)

                                    <label class="flex items-center gap-3 rounded-lg border border-slate-700 bg-slate-800 hover:bg-slate-700 hover:border-blue-500 p-3 cursor-pointer transition">

                                        <input
                                            type="checkbox"
                                            name="users[]"
                                            value="{{ $user->id }}"
                                            class="rounded border-slate-600 bg-slate-900 text-blue-600 focus:ring-blue-500"
                                            {{
                                                in_array(
                                                    $user->id,
                                                    old(
                                                        'users',
                                                        $departement->users->pluck('id')->toArray()
                                                    )
                                                )
                                                ? 'checked'
                                                : ''
                                            }}>

                                        <div class="w-10 h-10 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">

                                            {{ strtoupper(substr($user->name,0,1)) }}

                                        </div>

                                        <div>

                                            <p class="text-white font-medium">

                                                {{ $user->name }}

                                            </p>

                                            <p class="text-xs text-slate-400">

                                                Employé

                                            </p>

                                        </div>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    </div>
                                        <div class="flex justify-end gap-3 border-t border-slate-700 pt-6">

                        <a href="{{ route('departements.index') }}"
                           class="px-5 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition">

                            Annuler

                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                            Mettre à jour le département

                        </button>

                    </div>

                </form>

            </x-erp.card>

        </div>

    </div>

</x-app-layout>