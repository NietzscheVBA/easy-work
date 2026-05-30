@props([
    'label',
    'name',
    'type'        => 'text',
    'placeholder' => '',
    'icon'        => null,
    'hint'        => null,
    'required'    => false,
])

<div class="flex flex-col gap-1.5">
    <label for="{{ $name }}"
           class="text-xs font-semibold text-slate-600 uppercase tracking-widest">
        {{ $label }}
        @if($required)
            <span class="text-red-400 ml-0.5">*</span>
        @endif
    </label>

    <div class="relative">
        @if($icon)
            <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                <x-ui.icon :name="$icon" class="w-4 h-4 text-slate-400" />
            </div>
        @endif

        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            placeholder="{{ $placeholder }}"
            value="{{ old($name) }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => 'w-full ' . ($icon ? 'pl-9' : 'pl-4') . ' pr-4 py-2.5 text-sm bg-slate-50 border rounded-xl
                            text-slate-800 placeholder-slate-400
                            focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 focus:bg-white
                            transition-all duration-150
                            ' . ($errors->has($name) ? 'border-red-300 bg-red-50/30 focus:ring-red-500/20 focus:border-red-400' : 'border-slate-200')
            ]) }}
        />
    </div>

    @error($name)
        <p class="text-xs text-red-500 flex items-center gap-1 mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            {{ $message }}
        </p>
    @enderror

    @if($hint && !$errors->has($name))
        <p class="text-xs text-slate-400">{{ $hint }}</p>
    @endif
</div>
