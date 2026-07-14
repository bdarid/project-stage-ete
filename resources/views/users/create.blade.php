<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header>

            <x-slot:title>
                Ajouter un employé
            </x-slot:title>

            <x-slot:description>
                Créez un nouvel employé et attribuez-lui un rôle.
            </x-slot:description>

        </x-erp.page-header>

    </x-slot>

    <x-erp.form-card>

        <x-erp.alert type="error"/>

        <form
            action="{{ route('users.store') }}"
            method="POST"
            class="space-y-6">

            @csrf

            <x-erp.input
                name="name_users"
                label="Nom complet"/>

            <x-erp.input
                name="email"
                label="Adresse Email"
                type="email"/>

            <div class="rounded-xl bg-blue-500/10 border border-blue-500/20 p-5 text-blue-300">

                Un mot de passe sécurisé sera automatiquement généré puis envoyé à l'employé par email.

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <x-erp.input
                    name="CIN"
                    label="Numéro CIN"/>

                <x-erp.input
                    name="date_naissance"
                    label="Date de naissance"
                    type="date"
                    value="2010-01-01"/>

            </div>

            <x-erp.select
                name="role"
                label="Rôle">

                <option disabled selected>

                    Choisir un rôle

                </option>

                @foreach($roles as $role)

                    <option value="{{ $role->name }}">

                        {{ ucfirst($role->name) }}

                    </option>

                @endforeach

            </x-erp.select>

            <x-erp.form-actions>

                <x-erp.button
                    href="{{ route('users.index') }}"
                    color="gray">

                    Annuler

                </x-erp.button>

                <x-erp.button
                    type="submit">

                    Enregistrer

                </x-erp.button>

            </x-erp.form-actions>

        </form>

    </x-erp.form-card>

</x-app-layout>