@props([
    'name',
    'email',
    'status' => 'active', // active | pending | inactive
    'href'   => '#',
])

@php
$initial = strtoupper(mb_substr($name, 0, 1));

$statusConfig = [
    'active'   => ['label' => 'Ativo',     'classes' => 'bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200'],
    'pending'  => ['label' => 'Pendente',  'classes' => 'bg-amber-50 text-amber-600 ring-1 ring-amber-200'],
    'inactive' => ['label' => 'Inativo',   'classes' => 'bg-slate-100 text-slate-500 ring-1 ring-slate-200'],
];

$s = $statusConfig[$status] ?? $statusConfig['active'];

$avatarColors = [
    'A' => 'bg-violet-100 text-violet-600',
    'B' => 'bg-blue-100 text-blue-600',
    'C' => 'bg-cyan-100 text-cyan-600',
    'D' => 'bg-indigo-100 text-indigo-600',
    'E' => 'bg-emerald-100 text-emerald-600',
    'F' => 'bg-fuchsia-100 text-fuchsia-600',
    'G' => 'bg-green-100 text-green-600',
    'H' => 'bg-pink-100 text-pink-600',
    'I' => 'bg-sky-100 text-sky-600',
    'J' => 'bg-amber-100 text-amber-600',
    'K' => 'bg-orange-100 text-orange-600',
    'L' => 'bg-lime-100 text-lime-600',
    'M' => 'bg-rose-100 text-rose-600',
    'N' => 'bg-teal-100 text-teal-600',
];

$avatarClass = $avatarColors[$initial] ?? 'bg-slate-100 text-slate-600';
@endphp

<a href="{{ $href }}"
   class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-slate-50 transition-all duration-150 group">
    <div class="flex items-center gap-3">
        {{-- Avatar --}}
        <div class="w-9 h-9 rounded-xl {{ $avatarClass }} flex items-center justify-center text-sm font-bold flex-shrink-0">
            {{ $initial }}
        </div>
        {{-- Info --}}
        <div>
            <p class="text-sm font-semibold text-slate-700 leading-tight group-hover:text-blue-600 transition-colors">{{ $name }}</p>
            <p class="text-xs text-slate-400 mt-0.5">{{ $email }}</p>
        </div>
    </div>

    {{-- Status Badge --}}
    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $s['classes'] }}">
        <span class="w-1.5 h-1.5 rounded-full
            {{ $status === 'active' ? 'bg-emerald-500' : ($status === 'pending' ? 'bg-amber-500' : 'bg-slate-400') }}">
        </span>
        {{ $s['label'] }}
    </span>
</a>
