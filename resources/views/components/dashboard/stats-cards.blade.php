<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between card-hover">
        <div>
            <p class="text-gray-500 text-sm font-medium">Total de Usuários</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
        </div>
        <div class="h-12 w-12 bg-blue-50 rounded-full flex items-center justify-center text-primary">
            <i class="fas fa-users text-xl"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between card-hover">
        <div>
            <p class="text-gray-500 text-sm font-medium">Ativos</p>
            <p class="text-3xl font-bold text-green-600">{{ $activeUsers }}</p>
        </div>
        <div class="h-12 w-12 bg-green-50 rounded-full flex items-center justify-center text-green-500">
            <i class="fas fa-user-check text-xl"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between card-hover">
        <div>
            <p class="text-gray-500 text-sm font-medium">Pendentes</p>
            <p class="text-3xl font-bold text-amber-600">{{ $pendingUsers }}</p>
        </div>
        <div class="h-12 w-12 bg-amber-50 rounded-full flex items-center justify-center text-amber-500">
            <i class="fas fa-clock"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between card-hover">
        <div>
            <p class="text-gray-500 text-sm font-medium">Mensagens Novas</p>
            <p class="text-3xl font-bold text-purple-600">{{ $newMessages }}</p>
        </div>
        <div class="h-12 w-12 bg-purple-50 rounded-full flex items-center justify-center text-purple-500">
            <i class="fas fa-envelope-open-text"></i>
        </div>
    </div>
</div>