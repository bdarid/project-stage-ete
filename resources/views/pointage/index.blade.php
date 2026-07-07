<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pointage Quotidien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8 bg-white border-b border-gray-200 text-center">

                    <h3 class="text-2xl font-bold text-gray-800 mb-8">
                        Aujourd'hui : {{ \Carbon\Carbon::today()->translatedFormat('l d F Y') }}
                    </h3>

                    @if(!$pointageAujourdhui)
                        <div class="mb-4">
                            <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-50 border-4 border-gray-100 rounded-full mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-gray-600 mb-8">Vous n'avez pas encore enregistré votre arrivée aujourd'hui.</p>

                            <form action="{{ route('pointage.entree') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-md transition-all hover:scale-105 text-lg w-full sm:w-auto">
                                    ▶ Pointer mon Arrivée
                                </button>
                            </form>
                        </div>

                    @elseif($pointageAujourdhui && !$pointageAujourdhui->heure_depart)
                        <div class="mb-4">
                            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-50 border-4 border-green-100 rounded-full mb-4 animate-pulse">
                                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="text-green-700 font-semibold mb-2 text-xl">Arrivée enregistrée à {{ \Carbon\Carbon::parse($pointageAujourdhui->heure_arrive)->format('H:i') }}</p>
                            <p class="text-gray-600 mb-8">Bonne journée de travail ! N'oubliez pas de pointer votre départ ce soir.</p>

                            <form action="{{ route('pointage.sortie') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-md transition-all hover:scale-105 text-lg w-full sm:w-auto">
                                    ⏹ Pointer mon Départ
                                </button>
                            </form>
                        </div>

                    @else
                        <div class="mb-4">
                            <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-50 border-4 border-blue-100 rounded-full mb-4">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-800 mb-2">Journée terminée !</h4>
                            <p class="text-gray-500 mb-8">Merci et à demain.</p>
                            
                            <div class="flex flex-col sm:flex-row justify-center sm:space-x-12 space-y-4 sm:space-y-0 text-gray-700 bg-gray-50 p-6 rounded-lg inline-flex w-full sm:w-auto">
                                <div>
                                    <span class="block text-xs uppercase tracking-wider text-gray-500 mb-1">Heure d'arrivée</span>
                                    <span class="font-bold text-xl">{{ \Carbon\Carbon::parse($pointageAujourdhui->heure_arrive)->format('H:i') }}</span>
                                </div>
                                <div class="hidden sm:block w-px bg-gray-300"></div>
                                <div>
                                    <span class="block text-xs uppercase tracking-wider text-gray-500 mb-1">Heure de départ</span>
                                    <span class="font-bold text-xl">{{ \Carbon\Carbon::parse($pointageAujourdhui->heure_depart)->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>f
        </div>
    </div>
</x-app-layout>