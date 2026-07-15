<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header>
            <x-slot:title>
                Mon Profil
            </x-slot:title>

            <x-slot:description>
                Gérez vos informations personnelles et votre sécurité.
            </x-slot:description>
        </x-erp.page-header>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto space-y-6">

            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-slate-800 border border-red-500/20 rounded-2xl p-6">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>