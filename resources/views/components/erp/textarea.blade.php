@props([
    'name',
    'label'
])

<div>

    <label
        for="{{ $name }}"
        class="block text-sm font-semibold text-slate-300 mb-2">

        {{ $label }}

    </label>

    <select

        id="{{ $name }}"
        name="{{ $name }}"

        {{ $attributes->merge([
            'class'=>'w-full rounded-xl bg-slate-900 border border-slate-700 text-white focus:border-blue-500 focus:ring-blue-500'
        ]) }}>

        {{ $slot }}

    </select>

    @error($name)

        <p class="text-red-400 text-sm mt-2">

            {{ $message }}

        </p>

    @enderror

</div>