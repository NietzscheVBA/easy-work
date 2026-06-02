@props([
    'permission',        {{-- App\Models\Permission instance --}}
    'checked' => false,
])

<label
    class="flex items-start gap-3 p-3 rounded-xl border cursor-pointer
           transition-all duration-150 group
           hover:border-violet-200 hover:bg-violet-50/40"
    :class="permissions.includes({{ $permission->id }})
        ? 'border-violet-300 bg-violet-50/60 shadow-sm'
        : 'border-slate-200 bg-white'">

    {{-- Hidden real checkbox --}}
    <input type="checkbox"
           name="permissions[]"
           value="{{ $permission->id }}"
           class="sr-only"
           {{ $checked ? 'checked' : '' }}
           :checked="permissions.includes({{ $permission->id }})"
           x-on:change="togglePermission({{ $permission->id }})" />

    {{-- Custom checkbox visual --}}
    <div class="flex-shrink-0 mt-0.5 w-4 h-4 rounded border-2 flex items-center justify-center transition-all duration-150"
         :class="permissions.includes({{ $permission->id }})
             ? 'bg-violet-600 border-violet-600'
             : 'border-slate-300 bg-white group-hover:border-violet-400'">
        <svg x-show="permissions.includes({{ $permission->id }})"
             xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5 text-white" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
        </svg>
    </div>

    {{-- Content --}}
    <div class="flex-1 min-w-0">
        <p class="text-sm font-semibold leading-tight transition-colors"
           :class="permissions.includes({{ $permission->id }}) ? 'text-violet-800' : 'text-slate-700'">
            {{ $permission->name }}
        </p>
        <p class="text-xs text-slate-400 mt-0.5 leading-relaxed">
            {{ $permission->description }}
        </p>
        <code class="inline-block mt-1 text-xs font-mono text-violet-500 bg-violet-50
                     px-1.5 py-0.5 rounded border border-violet-100">
            {{ $permission->slug }}
        </code>
    </div>
</label>
