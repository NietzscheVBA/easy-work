<x-layouts.app>
    <x-navigation.nav-tabs current-page="register" />
    
    <div id="registerPage" class="page-content transition-page">
        <div class="max-w-md mx-auto mt-6 md:mt-10">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8">
                <div class="text-center mb-6">
                    <i class="fas fa-user-plus text-primary text-4xl mb-2"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Criar conta</h2>
                    <p class="text-gray-500 text-sm">Preencha os dados para se cadastrar</p>
                </div>
                
                <form id="registerForm" action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Nome completo</label>
                        <input type="text" name="name" id="regName" required 
                               class="w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary" 
                               placeholder="Maria Oliveira">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">E-mail</label>
                        <input type="email" name="email" id="regEmail" required 
                               class="w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary" 
                               placeholder="email@exemplo.com">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Senha</label>
                        <input type="password" name="password" id="regPassword" required 
                               class="w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary" 
                               placeholder="mínimo 6 caracteres">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Confirmar senha</label>
                        <input type="password" name="password_confirmation" id="regPasswordConfirm" required 
                               class="w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary" 
                               placeholder="digite novamente">
                    </div>
                                    
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fas fa-paper-plane"></i> Cadastrar e receber confirmação
                </button>
                </form>
                
                <div id="registerFeedback" class="mt-4 text-sm rounded-lg p-3 hidden"></div>
                <p class="text-center text-xs text-gray-400 mt-4">Ao cadastrar, você receberá um e‑mail de boas‑vindas (simulação).</p>
            </div>
        </div>
    </div>
</x-layouts.app>