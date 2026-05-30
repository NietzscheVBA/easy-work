@props([
    'label',
    'name',
    'options'  => [],
    'required' => false,
    'hint'     => null,
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
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => 'w-full pl-4 pr-9 py-2.5 text-sm bg-slate-50 border rounded-xl
                            text-slate-800 appearance-none cursor-pointer
                            focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 focus:bg-white
                            transition-all duration-150
                            ' . ($errors->has($name) ? 'border-red-300 bg-red-50/30' : 'border-slate-200')
            ]) }}>
            {{ $slot }}
            @foreach($options as $value => $label)
                <option value="{{ $value }}" {{ old($name) == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>

        {{-- Chevron --}}
        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </div>
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
