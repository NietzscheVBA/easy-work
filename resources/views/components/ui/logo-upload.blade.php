@props([
    'name'   => 'logo',
    'label'  => 'Logotipo',
    'hint'   => 'PNG, JPG, WebP ou SVG — máximo 2 MB',
    'accept' => 'image/png,image/jpeg,image/webp,image/svg+xml',
    'maxMb'  => 2,
])

<div class="flex flex-col gap-1.5"
     x-data="logoUpload({{ $maxMb }})"
     x-on:dragover.prevent="dragging = true"
     x-on:dragleave.prevent="dragging = false"
     x-on:drop.prevent="handleDrop($event)">

    <span class="text-xs font-semibold text-slate-600 uppercase tracking-widest">
        {{ $label }}
    </span>

    {{-- Hidden file input --}}
    <input type="file"
           name="{{ $name }}"
           id="{{ $name }}"
           accept="{{ $accept }}"
           class="sr-only"
           x-ref="fileInput"
           x-on:change="handleFileInput($event)" />

    {{-- Drop zone (empty state) --}}
    <label for="{{ $name }}"
           x-show="!preview"
           :class="dragging
               ? 'border-blue-400 bg-blue-50/60 scale-[1.01]'
               : 'border-slate-200 hover:border-blue-300 hover:bg-slate-50/80'"
           class="flex flex-col items-center justify-center gap-3 p-8 rounded-xl border-2 border-dashed
                  cursor-pointer transition-all duration-200">

        <div :class="dragging ? 'text-blue-500 scale-110' : 'text-slate-300 group-hover:text-blue-400'"
             class="transition-all duration-200">
            <x-ui.icon name="upload" class="w-8 h-8" />
        </div>

        <div class="text-center">
            <p class="text-sm font-semibold text-slate-600">
                Clique ou arraste o arquivo aqui
            </p>
            <p class="text-xs text-slate-400 mt-1">{{ $hint }}</p>
        </div>
    </label>

    {{-- Preview state --}}
    <div x-show="preview"
         class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl border border-slate-200">

        <div class="w-16 h-16 rounded-xl border border-slate-200 bg-white
                    flex items-center justify-center overflow-hidden flex-shrink-0 shadow-sm">
            <img :src="preview" alt="Preview" class="w-full h-full object-contain p-1.5" />
        </div>

        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-slate-700 truncate" x-text="fileName"></p>
            <p class="text-xs text-slate-400 mt-0.5" x-text="fileSize"></p>
            <button type="button"
                    @click="$refs.fileInput.click()"
                    class="text-xs text-blue-500 hover:text-blue-700 font-medium mt-1 transition-colors">
                Trocar imagem
            </button>
        </div>

        <button type="button"
                @click="remove()"
                class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all flex-shrink-0"
                title="Remover">
            <x-ui.icon name="x" class="w-4 h-4" />
        </button>
    </div>

    {{-- Error state --}}
    <p x-show="error" x-text="error"
       class="text-xs text-red-500 flex items-center gap-1 mt-0.5">
    </p>

    @error($name)
        <p class="text-xs text-red-500 flex items-center gap-1 mt-0.5">
            <x-ui.icon name="alert-circle" class="w-3 h-3 flex-shrink-0" />
            {{ $message }}
        </p>
    @enderror
</div>

@once
    @push('scripts')
    <script>
    function logoUpload(maxMb) {
        return {
            preview:  null,
            fileName: '',
            fileSize: '',
            dragging: false,
            error:    '',

            handleFileInput(e) {
                const file = e.target.files[0]
                if (file) this.read(file)
            },

            handleDrop(e) {
                this.dragging = false
                const file = e.dataTransfer.files[0]
                if (file && file.type.startsWith('image/')) this.read(file)
                else this.error = 'Tipo de arquivo não suportado.'
            },

            read(file) {
                this.error = ''
                if (file.size > maxMb * 1024 * 1024) {
                    this.error = `O arquivo deve ter no máximo ${maxMb} MB.`
                    return
                }
                const reader = new FileReader()
                reader.onload = e => {
                    this.preview  = e.target.result
                    this.fileName = file.name
                    this.fileSize = (file.size / 1024).toFixed(0) + ' KB'
                }
                reader.readAsDataURL(file)
            },

            remove() {
                this.preview  = null
                this.fileName = ''
                this.fileSize = ''
                this.error    = ''
                this.$refs.fileInput.value = ''
            },
        }
    }
    </script>
    @endpush
@endonce
