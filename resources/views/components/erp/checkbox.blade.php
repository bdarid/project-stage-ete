@props([
'name',
'label'
])

<label class="flex items-center gap-3 cursor-pointer">

<input

type="checkbox"

name="{{ $name }}"

{{ $attributes }}

class="rounded border-slate-700 bg-slate-900 text-blue-500 focus:ring-blue-500">

<span class="text-slate-300">

{{ $label }}

</span>

</label>