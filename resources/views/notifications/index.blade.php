<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header>
            <x-slot:title>
                Notifications
            </x-slot:title>

            <x-slot:description>
                Consultez toutes vos notifications.
            </x-slot:description>
        </x-erp.page-header>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto">

            <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden">

                @forelse($notifications as $notification)

                    <div class="flex items-start gap-4 p-5 border-b border-slate-700 hover:bg-slate-750 transition">

                        {{-- Icône --}}
                        <div class="mt-1">

                            @switch($notification->type)

                                @case('success')
                                    <div class="w-10 h-10 rounded-xl bg-green-500/20 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    @break

                                @case('warning')
                                    <div class="w-10 h-10 rounded-xl bg-yellow-500/20 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M10.29 3.86L1.82 18A2 2 0 003.53 21h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                        </svg>
                                    </div>
                                    @break

                                @case('danger')
                                    <div class="w-10 h-10 rounded-xl bg-red-500/20 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01"/>
                                        </svg>
                                    </div>
                                    @break

                                @default
                                    <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01"/>
                                        </svg>
                                    </div>

                            @endswitch

                        </div>

                        {{-- Texte --}}
                        <div class="flex-1">

                            <h3 class="font-semibold text-white">
                                {{ $notification->titre }}
                            </h3>

                            <p class="text-slate-400 mt-1">
                                {{ $notification->message }}
                            </p>

                            <p class="text-xs text-slate-500 mt-3">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-20">

                        <svg class="w-16 h-16 mx-auto text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0h6z"/>
                        </svg>

                        <h3 class="mt-5 text-xl font-bold text-white">
                            Aucune notification
                        </h3>

                        <p class="mt-2 text-slate-500">
                            Vous êtes à jour.
                        </p>

                    </div>

                @endforelse

            </div>

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>

        </div>
    </div>
</x-app-layout>