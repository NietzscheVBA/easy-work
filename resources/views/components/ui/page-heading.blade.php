@props([
    'title',
    'description' => null,
])

<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">{{ $title }}</h1>
    @if($description)
        <p class="text-sm text-slate-400 mt-1">{{ $description }}</p>
    @endif
</div>
