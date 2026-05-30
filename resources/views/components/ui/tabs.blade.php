@props([
    'tabs',      {{-- array of ['key'=>'pessoa','label'=>'Dados Pessoais','icon'=>'user'] --}}
    'default' => null,
    'alpine'  => 'currentTab',  {{-- name of the Alpine variable --}}
])

@php $default = $default ?? $tabs[0]['key']; @endphp

<div x-data="{ {{ $alpine }}: '{{ $default }}' }"
     {{ $attributes }}>

    {{-- Tab bar --}}
    <div class="flex border-b border-slate-100">
        @foreach($tabs as $tab)
            <button type="button"
                    @click="{{ $alpine }} = '{{ $tab['key'] }}'"
                    :class="{{ $alpine }} === '{{ $tab['key'] }}'
                        ? 'border-b-2 border-blue-600 text-blue-600 bg-blue-50/40'
                        : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50'"
                    class="flex items-center gap-2 px-6 py-4 text-sm font-semibold
                           transition-all duration-150 flex-1 justify-center sm:justify-start sm:flex-none">
                @if(!empty($tab['icon']))
                    <x-ui.icon :name="$tab['icon']" class="w-4 h-4" />
                @endif
                {{ $tab['label'] }}
                @if(!empty($tab['badge']))
                    <span x-show="{{ $tab['badge'] }}"
                          class="w-1.5 h-1.5 rounded-full bg-emerald-500 flex-shrink-0"></span>
                @endif
            </button>
        @endforeach
    </div>

    {{-- Slot with pane content --}}
    {{ $slot }}
</div>
