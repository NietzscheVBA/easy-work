@props([
    'icon',
    'label',
    'href' => '#',
    'active' => false,
])

<a href="{{ $href }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
          {{ $active
             ? 'bg-blue-600 text-white shadow-md shadow-blue-200'
             : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'
          }}">
    <x-ui.icon
        :name="$icon"
        class="w-4 h-4 flex-shrink-0 {{ $active ? 'text-white' : 'text-slate-400' }}"
    />
    <span>{{ $label }}</span>
</a>
