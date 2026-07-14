<form>

<div class="relative">

<input

type="text"

name="search"

placeholder="Rechercher..."

value="{{ request('search') }}"

class="w-full rounded-xl bg-slate-900 border border-slate-700 text-white pl-12 pr-4 py-3 focus:ring-blue-500 focus:border-blue-500">

<svg
class="absolute left-4 top-3.5 w-5 h-5 text-slate-500"
fill="none"
stroke="currentColor"
viewBox="0 0 24 24">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>

</svg>

</div>

</form>