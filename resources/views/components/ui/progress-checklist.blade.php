@props([
    'items', {{-- array of ['label'=>'Nome preenchido','condition'=>'name'] --}}
])

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
    <x-ui.form-section title="Progresso" />

    <div class="space-y-3">
        @foreach($items as $item)
            <div class="flex items-center gap-3">
                <div class="w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 transition-all duration-200"
                     :class="{{ $item['condition'] }} ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400'">
                    <x-ui.icon name="check" class="w-3 h-3" />
                </div>
                <span class="text-xs font-medium transition-colors duration-200"
                      :class="{{ $item['condition'] }} ? 'text-slate-700' : 'text-slate-400'">
                    {{ $item['label'] }}
                </span>
            </div>
        @endforeach
    </div>
</div>
