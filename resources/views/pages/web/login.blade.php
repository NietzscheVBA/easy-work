<x-layouts.web>
    {{-- <x-navigation.nav-tabs current-page="login"/> --}}
    
    <div id="loginPage" class="page-content transition-page">
        <div class="max-w-md mx-auto mt-6 md:mt-10">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8">
                <div class="text-center mb-6">
                    <i class="fas fa-lock text-primary text-4xl mb-2"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Acessar painel</h2>
                    <p class="text-gray-500 text-sm mt-1">Informe suas credenciais para continuar</p>
                </div>
                
                <form id="loginForm" action="{{ route('login.authenticate') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">E-mail</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="email" name="email" id="loginEmail" required 
                                   class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none transition" 
                                   placeholder="usuario@exemplo.com">
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Senha</label>
                        <div class="relative">
                            <i class="fas fa-key absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="password" name="password" id="loginPassword" required 
                                   class="w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none transition" 
                                   placeholder="********">
                        </div>
                    </div>
                    
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 rounded-xl transition shadow-sm flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fas fa-arrow-right-to-bracket"></i> Entrar
                </button>
                </form>
                
                <p class="text-center text-xs text-gray-400 mt-6">Demonstração: use maria@exemplo.com (qualquer senha) ou qualquer email cadastrado</p>
                <div id="loginFeedback" class="mt-3 text-sm text-center hidden"></div>
            </div>
        </div>
    </div>
</x-layouts.web>