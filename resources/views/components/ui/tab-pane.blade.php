@props([
    'key',
    'alpine' => 'currentTab',
])

<div x-show="{{ $alpine }} === '{{ $key }}'"
     x-transition:enter="transition ease-out duration-150"
     x-transition:enter-start="opacity-0 translate-y-1"
     x-transition:enter-end="opacity-100 translate-y-0"
     class="p-6">
    {{ $slot }}
</div>
