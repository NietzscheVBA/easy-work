@props([
    'submitLabel' => 'Salvar',
    'cancelHref'  => null,
    'cancelLabel' => 'Cancelar',
    'icon'        => 'check-circle',
])

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 space-y-3">
    <button type="submit"
            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5
                   bg-blue-600 hover:bg-blue-700 active:scale-95
                   text-white text-sm font-semibold rounded-xl
                   shadow-sm shadow-blue-200 transition-all duration-150">
        <x-ui.icon :name="$icon" class="w-4 h-4" />
        {{ $submitLabel }}
    </button>

    @if($cancelHref)
        <a href="{{ $cancelHref }}"
           class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5
                  bg-slate-50 hover:bg-slate-100 active:scale-95
                  text-slate-600 text-sm font-medium rounded-xl
                  border border-slate-200 transition-all duration-150">
            {{ $cancelLabel }}
        </a>
    @endif

    {{ $slot }}
</div>
