@props([
    'label',
    'value',
    'icon',
    'color' => 'blue', // blue | green | amber | purple
])

@php
$colorMap = [
    'blue'   => ['bg' => 'bg-blue-50',   'icon' => 'text-blue-500',   'ring' => 'ring-blue-100'],
    'green'  => ['bg' => 'bg-emerald-50','icon' => 'text-emerald-500','ring' => 'ring-emerald-100'],
    'amber'  => ['bg' => 'bg-amber-50',  'icon' => 'text-amber-500',  'ring' => 'ring-amber-100'],
    'purple' => ['bg' => 'bg-violet-50', 'icon' => 'text-violet-500', 'ring' => 'ring-violet-100'],
];
$c = $colorMap[$color] ?? $colorMap['blue'];
@endphp

<div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition-all duration-200">
    <div>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-1">{{ $label }}</p>
        <p class="text-3xl font-bold text-slate-800 leading-none">{{ $value }}</p>
    </div>
    <div class="{{ $c['bg'] }} {{ $c['ring'] }} ring-8 rounded-2xl p-3 group-hover:scale-110 transition-transform duration-200">
        <x-ui.icon :name="$icon" class="w-6 h-6 {{ $c['icon'] }}" />
    </div>
</div>
