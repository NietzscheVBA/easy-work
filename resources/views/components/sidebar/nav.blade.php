<aside class="w-56 bg-white border-r border-slate-100 flex flex-col h-full shadow-sm" x-data="{ active: '{{ request()->routeIs('dashboard') ? 'painel' : (request()->routeIs('users*') ? 'usuarios' : 'mensagens') }}' }">

    {{-- Logo --}}
    <div class="px-6 pt-8 pb-6">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-0.5">Controle de</p>
        <h1 class="text-lg font-bold text-blue-600 leading-tight">Usuários</h1>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 space-y-1">
        <x-sidebar.nav-item
            icon="grid"
            label="Painel"
            href="{{ route('admin.index') }}"
            :active="request()->routeIs('admin.index')"
        />
        <x-sidebar.nav-item
            icon="users"
            label="Usuários"
            href="{{ route('admin.tenants.index') }}"
            :active="request()->routeIs('admin.tenants*')"
        />
        <x-sidebar.nav-item
            icon="message-square"
            label="Mensagens"
            href="{{ route('admin.messages.index') }}"
            :active="request()->routeIs('admin.messages*')"
        />
        <x-sidebar.nav-item
            icon="permission"
            label="Permissões"
            href="{{ route('admin.permission.index') }}"
            :active="request()->routeIs('admin.permission*')"
        />
        <x-sidebar.nav-item
            icon="roles"
            label="Papéis"
            href="{{ route('admin.role.index') }}"
            :active="request()->routeIs('admin.role*')"
        />
    </nav>

    {{-- Logout --}}
    <div class="px-3 pb-6">
        <form method="POST" action="{{ route('admin.config.logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-slate-500 rounded-xl hover:bg-slate-50 hover:text-slate-700 transition-all duration-150 group">
                <x-ui.icon name="log-out" class="w-4 h-4 group-hover:text-red-400 transition-colors" />
                <span>Sair</span>
            </button>
        </form>
    </div>

</aside>
