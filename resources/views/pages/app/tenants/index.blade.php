<x-layouts.app title="Usuários — Controle de Usuários">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <x-ui.page-heading title="Usuários" description="Gerencie todos os usuários do sistema" />

        <a href="{{ route('admin.tenants.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm shadow-blue-200 transition-all duration-150 active:scale-95">
            <x-ui.icon name="user" class="w-4 h-4" />
            Novo Usuário
        </a>
    </div>

{{-- Table Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden"
     x-data="userTable(@js($users->map(fn($u) => [
         'name'   => $u->name,
         'email'  => $u->email,
         'status' => $u->status,
         'href'   => route('admin.tenants.show', $u),
     ])->values()))">

    {{-- Search bar --}}
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-4">
        <div class="relative flex-1">
            <x-ui.icon name="users" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
            <input
                type="text"
                x-model="search"
                @input="currentPage = 1"
                placeholder="Buscar usuários..."
                class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 transition-all"
            />
        </div>
        <p class="text-xs text-slate-400 flex-shrink-0">
            <span x-text="filtered.length"></span> resultado(s)
        </p>
    </div>

    {{-- User list --}}
    <div class="divide-y divide-slate-50 min-h-[3rem]">
        <template x-for="user in paginated" :key="user.email">
            <div class="flex items-center justify-between px-6 py-3 hover:bg-slate-50 transition-colors group">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold flex-shrink-0"
                         x-text="user.name.charAt(0).toUpperCase()">
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-700 group-hover:text-blue-600 transition-colors"
                           x-text="user.name"></p>
                        <p class="text-xs text-slate-400" x-text="user.email"></p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    {{-- <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold"
                          :class="user.status === 'active'
                              ? 'bg-emerald-50 text-emerald-600 ring-1 ring-emerald-200'
                              : 'bg-amber-50 text-amber-600 ring-1 ring-amber-200'">
                        <span class="w-1.5 h-1.5 rounded-full"
                              :class="user.status === 'active' ? 'bg-emerald-500' : 'bg-amber-500'"></span>
                        <span x-text="user.status === 'active' ? 'Ativo' : 'Pendente'"></span>
                    </span> --}}

                    <a :href="user.href"
                       class="p-1.5 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all">
                        <x-ui.icon name="arrow-right" class="w-4 h-4" />
                    </a>
                </div>
            </div>
        </template>

        <p x-show="filtered.length === 0"
           class="text-center text-sm text-slate-400 py-12">
            Nenhum usuário encontrado.
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
function userTable(allUsers) {
    return {
        allUsers,
        search: '',
        currentPage: 1,
        perPage: 10,

        get filtered() {
            const q = this.search.toLowerCase().trim()
            if (!q) return this.allUsers
            return this.allUsers.filter(u =>
                u.name.toLowerCase().includes(q) ||
                u.email.toLowerCase().includes(q)
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
