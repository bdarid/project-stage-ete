@props([
    'title',
    'description' => '',
    'count' => null,
])

<div class="px-6 py-5 border-b border-slate-700 flex items-center justify-between">

    <div>

        <h3 class="text-xl font-bold text-white">
            {{ $title }}
        </h3>

        @if($description)
            <p class="text-slate-400 text-sm mt-1">
                {{ $description }}
            </p>
        @endif

    </div>

    @isset($count)
        <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-sm font-semibold">
            {{ $count }}
        </span>
    @endisset

</div>