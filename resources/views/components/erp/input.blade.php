@props([
'name',
'label',
'type'=>'text',
'value'=>''
])

<div>

<label
for="{{ $name }}"
class="block text-sm font-semibold text-slate-300 mb-2">

{{ $label }}

</label>

<input

id="{{ $name }}"
name="{{ $name }}"
type="{{ $type }}"
value="{{ old($name,$value) }}"

{{ $attributes->merge([

'class'=>'w-full rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-blue-500'

]) }}>

@error($name)

<p class="text-red-400 text-sm mt-2">

{{ $message }}

</p>

@enderror

</div>