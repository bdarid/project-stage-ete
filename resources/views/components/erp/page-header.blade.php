@props([
    'title',
    'subtitle' => '',
])

<div class="flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold text-white">
            {{ $title }}
        </h2>

        @if($subtitle)
            <p class="text-slate-400 mt-1">
                {{ $subtitle }}
            </p>
        @endif
    </div>

    <div>
        {{ $actions ?? '' }}
    </div>
</div>