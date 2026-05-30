@props([
    'label',
    'name',
    'placeholder' => '',
    'rows'        => 3,
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

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-2.5 text-sm bg-slate-50 border rounded-xl
                        text-slate-800 placeholder-slate-400 resize-none
                        focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 focus:bg-white
                        transition-all duration-150
                        ' . ($errors->has($name) ? 'border-red-300 bg-red-50/30' : 'border-slate-200')
        ]) }}>{{ old($name) }}</textarea>

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
