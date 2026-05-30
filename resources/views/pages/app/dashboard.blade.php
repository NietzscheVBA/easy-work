<x-layouts.app title="Painel — Controle de Usuários">

    {{-- Page Heading --}}
    <x-ui.page-heading
        title="Painel"
        description="Visão geral dos seus usuários"
    />

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        <x-cards.stat-card
            label="Total de Usuários"
            :value="$stats['total']"
            icon="users"
            color="blue"
        />
        <x-cards.stat-card
            label="Ativos"
            :value="$stats['active']"
            icon="check-circle"
            color="green"
        />
        <x-cards.stat-card
            label="Pendentes"
            :value="$stats['pending']"
            icon="clock"
            color="amber"
        />
        <x-cards.stat-card
            label="Mensagens Novas"
            :value="$stats['messages']"
            icon="mail"
            color="purple"
        />
    </div>

    {{-- Two-column section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent Registrations --}}
        <x-cards.panel-card
            title="Últimos Cadastros"
            link-label="Ver todos"
            :link-href="route('admin.tenants.index')"
        >
            @forelse($recentUsers as $user)
                <x-cards.user-row
                    :name="$user->name"
                    :email="$user->email"
                    :status="$user->status"
                    :href="route('admin.tenants.show', $user)"
                />
            @empty
                <p class="text-sm text-slate-400 text-center py-6">Nenhum usuário encontrado.</p>
            @endforelse
        </x-cards.panel-card>

        {{-- Recent Messages --}}
        <x-cards.panel-card
            title="Mensagens Recentes"
            link-label="Ver todas"
            :link-href="route('admin.messages.index')"
        >
            @forelse($recentMessages as $message)
                <x-cards.message-row
                    :name="$message->sender_name"
                    :preview="$message->preview"
                    :date="$message->created_at->format('d M')"
                    :unread="!$message->read_at"
                    :href="route('messages.show', $message)"
                />
            @empty
                <p class="text-sm text-slate-400 text-center py-6">Nenhuma mensagem recente.</p>
            @endforelse
        </x-cards.panel-card>

    </div>

</x-layouts.app>
