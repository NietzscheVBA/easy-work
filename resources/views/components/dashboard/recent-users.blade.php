<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class="font-semibold text-gray-800 text-lg flex items-center gap-2">
            <i class="fas fa-user-plus text-primary"></i> Últimos Cadastros
        </h2>
        <a href="#" class="text-sm text-primary hover:underline flex items-center gap-1">
            Ver todos <i class="fas fa-arrow-right text-xs"></i>
        </a>
    </div>
    <div class="divide-y divide-gray-100">
        @foreach($recentUsers as $user)
        <div class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
            <div class="flex items-center gap-3">
                <x-ui.user-avatar :initials="$user['initials']" />
                <div>
                    <p class="font-medium text-gray-800">{{ $user['name'] }}</p>
                    <p class="text-xs text-gray-500">{{ $user['email'] }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $user['active'] ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                    {{ $user['active'] ? 'Ativo' : 'Inativo' }}
                </span>
            </div>
        </div>
        @endforeach
    </div>
</div>