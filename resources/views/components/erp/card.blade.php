<div {{ $attributes->merge([
    'class' => 'bg-slate-800 border border-slate-700 rounded-2xl shadow-lg overflow-hidden'
]) }}>
    {{ $slot }}
</div>