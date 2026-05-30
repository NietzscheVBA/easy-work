<x-layouts.app title="Mensagens — Controle de Usuários">

    <x-ui.page-heading title="Mensagens" description="Todas as mensagens recebidas dos usuários" />

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden"
     x-data="messageTable(@js($messages->map(fn($m) => [
         'name'    => $m->user->name ?? 'Desconhecido',
         'preview' => $m->message,
         'date'    => $m->created_at->format('d M'),
         'unread'  => is_null($m->read_at),
         'href'    => route('admin.messages.show', $m),
     ])->values()))">

    {{-- Search bar --}}
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-4">
        <div class="relative flex-1">
            <x-ui.icon name="message-square" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
            <input
                type="text"
                x-model="search"
                @input="currentPage = 1"
                placeholder="Buscar mensagens..."
                class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition-all"
            />
        </div>
        <p class="text-xs text-slate-400 flex-shrink-0">
            <span x-text="filtered.length"></span> resultado(s)
        </p>
    </div>

    {{-- Message list --}}
    <div class="divide-y divide-slate-50 min-h-[3rem]">
        <template x-for="msg in paginated" :key="msg.href">
            <a :href="msg.href"
               class="flex items-start gap-4 px-6 py-4 hover:bg-slate-50 transition-colors group"
               :class="msg.unread ? 'bg-blue-50/30' : ''">

                <div class="mt-1 flex-shrink-0">
                    <span class="w-2 h-2 rounded-full block mt-1"
                          :class="msg.unread ? 'bg-blue-500' : 'bg-transparent'"></span>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-1">
                        <p class="text-sm font-semibold text-slate-800 group-hover:text-blue-600 transition-colors truncate"
                           :class="msg.unread ? 'font-bold' : ''"
                           x-text="msg.name"></p>
                        <span class="text-xs text-slate-400 flex-shrink-0 ml-2" x-text="msg.date"></span>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-2" x-text="msg.preview"></p>
                </div>

            </a>
        </template>

        <p x-show="filtered.length === 0"
           class="text-center text-sm text-slate-400 py-12">
            Nenhuma mensagem encontrada.
        </p>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between gap-4"
         x-show="totalPages > 1">
        <p class="text-xs text-slate-400">
            Página <span x-text="currentPage"></span> de <span x-text="totalPages"></span>
        </p>
        <div class="flex items-center gap-1">
            <button @click="currentPage = Math.max(1, currentPage - 1)"
                    :disabled="currentPage === 1"
                    class="px-3 py-1.5 text-xs font-medium rounded-lg border border-slate-200 text-slate-600
                           hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed transition-all">
                ← Anterior
            </button>

            <template x-for="page in pageNumbers" :key="page">
                <button @click="page !== '…' && (currentPage = page)"
                        :class="page === currentPage
                            ? 'bg-blue-600 text-white border-blue-600'
                            : 'border-slate-200 text-slate-600 hover:bg-slate-50'"
                        class="px-3 py-1.5 text-xs font-medium rounded-lg border transition-all min-w-[2rem]"
                        x-text="page">
                </button>
            </template>

            <button @click="currentPage = Math.min(totalPages, currentPage + 1)"
                    :disabled="currentPage === totalPages"
                    class="px-3 py-1.5 text-xs font-medium rounded-lg border border-slate-200 text-slate-600
                           hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed transition-all">
                Próxima →
            </button>
        </div>
    </div>

</div>

@push('scripts')
<script>
function messageTable(allMessages) {
    return {
        allMessages,
        search: '',
        currentPage: 1,
        perPage: 15,

        get filtered() {
            const q = this.search.toLowerCase().trim()
            if (!q) return this.allMessages
            return this.allMessages.filter(m =>
                m.name.toLowerCase().includes(q) ||
                m.preview.toLowerCase().includes(q)
            )
        },

        get totalPages() {
            return Math.max(1, Math.ceil(this.filtered.length / this.perPage))
        },

        get paginated() {
            const start = (this.currentPage - 1) * this.perPage
            return this.filtered.slice(start, start + this.perPage)
        },

        get pageNumbers() {
            const total = this.totalPages
            if (total <= 7) return Array.from({ length: total }, (_, i) => i + 1)

            const pages = [1]
            if (this.currentPage > 3) pages.push('…')

            const start = Math.max(2, this.currentPage - 1)
            const end   = Math.min(total - 1, this.currentPage + 1)
            for (let i = start; i <= end; i++) pages.push(i)

            if (this.currentPage < total - 2) pages.push('…')
            pages.push(total)
            return pages
        },
    }
}
</script>
@endpush

</x-layouts.app>
