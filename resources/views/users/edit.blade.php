<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header>

            <x-slot:title>

                Modifier {{ $user->name_users }}

            </x-slot:title>

            <x-slot:description>

                Modifiez les informations de cet employé.

            </x-slot:description>

        </x-erp.page-header>

    </x-slot>

    <x-erp.form-card>

        <x-erp.alert type="error"/>

        <form
            method="POST"
            action="{{ route('users.update',$user->id) }}"
            class="space-y-6">

            @csrf
            @method('PUT')

            <x-erp.input
                name="name_users"
                label="Nom complet"
                :value="$user->name_users"/>

            <x-erp.input
                name="email"
                type="email"
                label="Adresse Email"
                :value="$user->email"/>

            <x-erp.select
                name="role"
                label="Rôle">

                @foreach($roles as $role)

                    <option

                        value="{{ $role->name }}"

                        {{ $user->hasRole($role->name) ? 'selected' : '' }}>

                        {{ ucfirst($role->name) }}

                    </option>

                @endforeach

            </x-erp.select>

            <div class="grid md:grid-cols-2 gap-6">

                <x-erp.input
                    name="CIN"
                    label="Numéro CIN"
                    :value="$user->CIN"/>

                <x-erp.input
                    name="date_naissance"
                    type="date"
                    label="Date de naissance"
                    :value="$user->date_naissance?->format('Y-m-d')"/>

            </div>

            <x-erp.form-actions>

                <x-erp.button
                    href="{{ route('users.index') }}"
                    color="gray">

                    Annuler

                </x-erp.button>

                <x-erp.button
                    type="submit">

                    Mettre à jour

                </x-erp.button>

            </x-erp.form-actions>

        </form>

    </x-erp.form-card>

</x-app-layout>