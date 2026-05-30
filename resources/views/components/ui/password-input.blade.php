@props([
    'label',
    'name',
    'placeholder' => '',
    'required'    => false,
    'hint'        => null,
    'showStrength'=> false,
])

<div class="flex flex-col gap-1.5" x-data="{ show: false, val: '{{ old($name) }}' }">
    <label for="{{ $name }}"
           class="text-xs font-semibold text-slate-600 uppercase tracking-widest">
        {{ $label }}
        @if($required)
            <span class="text-red-400 ml-0.5">*</span>
        @endif
    </label>

    <div class="relative">
        <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
            <x-ui.icon name="lock" class="w-4 h-4 text-slate-400" />
        </div>

        <input
            :type="show ? 'text' : 'password'"
            name="{{ $name }}"
            id="{{ $name }}"
            placeholder="{{ $placeholder }}"
            x-model="val"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => 'w-full pl-9 pr-10 py-2.5 text-sm bg-slate-50 border rounded-xl
                            text-slate-800 placeholder-slate-400
                            focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 focus:bg-white
                            transition-all duration-150
                            ' . ($errors->has($name) ? 'border-red-300 bg-red-50/30' : 'border-slate-200')
            ]) }}
        />

        <button type="button"
                @click="show = !show"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
            <x-ui.icon name="eye"     class="w-4 h-4" x-show="!show" />
            <x-ui.icon name="eye-off" class="w-4 h-4" x-show="show"  />
        </button>
    </div>

    @if($showStrength)
        <div x-show="val.length > 0" x-cloak>
            @php
                $strengthId = 'strength_' . $name;
            @endphp
            <div class="flex gap-1 mt-0.5">
                <template x-for="i in 4" :key="i">
                    <div class="h-1 flex-1 rounded-full transition-all duration-300"
                         :class="(()=>{
                             let s=0;
                             if(val.length>=8)s++;
                             if(/[A-Z]/.test(val))s++;
                             if(/[0-9]/.test(val))s++;
                             if(/[^A-Za-z0-9]/.test(val))s++;
                             const c=s===1?'bg-red-400':s===2?'bg-amber-400':s===3?'bg-blue-400':'bg-emerald-400';
                             return i<=s ? c : 'bg-slate-100';
                         })()">
                    </div>
                </template>
            </div>
            <p class="text-xs mt-1 font-medium"
               :class="(()=>{
                   let s=0;
                   if(val.length>=8)s++;
                   if(/[A-Z]/.test(val))s++;
                   if(/[0-9]/.test(val))s++;
                   if(/[^A-Za-z0-9]/.test(val))s++;
                   return s===1?'text-red-500':s===2?'text-amber-500':s===3?'text-blue-500':'text-emerald-500';
               })()"
               x-text="(()=>{
                   let s=0;
                   if(val.length>=8)s++;
                   if(/[A-Z]/.test(val))s++;
                   if(/[0-9]/.test(val))s++;
                   if(/[^A-Za-z0-9]/.test(val))s++;
                   return ['','Fraca','Razoável','Boa','Forte'][s]??'';
               })()">
            </p>
        </div>
    @endif

    @error($name)
        <p class="text-xs text-red-500 flex items-center gap-1 mt-0.5">
            <x-ui.icon name="alert-circle" class="w-3 h-3 flex-shrink-0" />
            {{ $message }}
        </p>
    @enderror

    @if($hint && !$errors->has($name))
        <p class="text-xs text-slate-400">{{ $hint }}</p>
    @endif
</div>
