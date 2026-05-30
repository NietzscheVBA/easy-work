@props([
    'title',
    'description' => null,
])

<div class="pb-4 mb-6 border-b border-slate-100">
    <h3 class="text-sm font-bold text-slate-700">{{ $title }}</h3>
    @if($description)
        <p class="text-xs text-slate-400 mt-0.5">{{ $description }}</p>
    @endif
</div>
