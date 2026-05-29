@props([
    'name',
    'preview',
    'date',
    'href' => '#',
    'unread' => false,
])

<a href="{{ $href }}"
   class="flex items-start gap-3 px-4 py-3 rounded-xl hover:bg-slate-50 transition-all duration-150 group">

    {{-- Icon --}}
    <div class="mt-0.5 flex-shrink-0">
        <x-ui.icon name="message-square" class="w-4 h-4 text-slate-300 group-hover:text-blue-400 transition-colors" />
    </div>

    {{-- Content --}}
    <div class="flex-1 min-w-0">
        <div class="flex items-center justify-between gap-2 mb-0.5">
            <p class="text-sm font-semibold text-slate-700 truncate
                       {{ $unread ? 'text-slate-900' : '' }}
                       group-hover:text-blue-600 transition-colors">
                {{ $name }}
                @if($unread)
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-blue-500 ml-1 -translate-y-0.5"></span>
                @endif
            </p>
            <span class="text-xs text-slate-400 flex-shrink-0 font-medium">{{ $date }}</span>
        </div>
        <p class="text-xs text-slate-400 leading-relaxed line-clamp-2">{{ $preview }}</p>
    </div>

</a>
