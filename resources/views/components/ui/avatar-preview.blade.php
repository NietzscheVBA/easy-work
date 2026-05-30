@props([
    'nameVar'    => 'userName',
    'companyVar' => 'companyName',
    'cnpjVar'    => null,
    'logoVar'    => null,
])

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
    <x-ui.form-section title="Prévia" />

    <div class="flex flex-col items-center gap-3 py-2">

        {{-- Logo da empresa se houver preview, senão avatar do usuário --}}
        @if($logoVar)
            <template x-if="{{ $logoVar }}">
                <div class="w-20 h-20 rounded-2xl border border-slate-200 bg-white
                            flex items-center justify-center overflow-hidden shadow-sm">
                    <img :src="{{ $logoVar }}" alt="Logo" class="w-full h-full object-contain p-2" />
                </div>
            </template>
            <template x-if="!{{ $logoVar }}">
                <div class="w-20 h-20 rounded-2xl bg-blue-50 text-blue-600
                            flex items-center justify-center text-3xl font-bold shadow-sm transition-all duration-200"
                     x-text="{{ $nameVar }} ? {{ $nameVar }}.charAt(0).toUpperCase() : '?'">
                </div>
            </template>
        @else
            <div class="w-20 h-20 rounded-2xl bg-blue-50 text-blue-600
                        flex items-center justify-center text-3xl font-bold shadow-sm transition-all duration-200"
                 x-text="{{ $nameVar }} ? {{ $nameVar }}.charAt(0).toUpperCase() : '?'">
            </div>
        @endif

        <div class="text-center">
            <p class="text-sm font-semibold text-slate-700"
               x-text="{{ $nameVar }} || 'Nome do usuário'"></p>
            @if($companyVar)
                <p class="text-xs text-slate-400 mt-0.5"
                   x-text="{{ $companyVar }} || 'Sem empresa vinculada'"></p>
            @endif
        </div>

        @if($cnpjVar)
            <template x-if="{{ $cnpjVar }}">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                             text-xs font-mono font-semibold bg-slate-100 text-slate-600">
                    <x-ui.icon name="hash" class="w-3 h-3" />
                    <span x-text="{{ $cnpjVar }}"></span>
                </span>
            </template>
        @endif
    </div>
</div>
