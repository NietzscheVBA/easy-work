@props([
    'title',
    'linkLabel' => 'Ver todos',
    'linkHref'  => '#',
])

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-6 pt-5 pb-3">
        <h2 class="text-base font-bold text-slate-800">{{ $title }}</h2>
        <a href="{{ $linkHref }}"
           class="inline-flex items-center gap-1 text-xs font-semibold text-blue-500 hover:text-blue-700 transition-colors group">
            {{ $linkLabel }}
            <x-ui.icon name="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" />
        </a>
    </div>

    {{-- Content --}}
    <div class="px-2 pb-4">
        {{ $slot }}
    </div>
</div>
