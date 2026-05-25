<div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-gray-200 pb-4 mb-6">
    <div class="flex items-center gap-2">
        <i class="fas fa-users-viewfinder text-primary text-2xl"></i>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">Home</h1>
    </div>
    <div class="flex gap-2 mt-3 md:mt-0 bg-white/60 p-1 rounded-xl shadow-sm">
        <a href="{{ route('dashboard') }}" data-page="home" class="nav-btn px-5 py-2 rounded-lg font-medium transition-all flex items-center gap-2 text-gray-700 hover:bg-primary/10" :class="{ 'bg-primary text-white shadow-sm': currentPage === 'home' }">
            <i class="fas fa-chart-line text-sm"></i> <span>Home</span>
        </a>
        <a href="{{ route('login') }}" data-page="login" class="nav-btn px-5 py-2 rounded-lg font-medium transition-all flex items-center gap-2 text-gray-700 hover:bg-primary/10" :class="{ 'bg-primary text-white shadow-sm': currentPage === 'login' }">
            <i class="fas fa-sign-in-alt"></i> <span>Login</span>
        </a>
        <a href="{{ route('register') }}" data-page="register" class="nav-btn px-5 py-2 rounded-lg font-medium transition-all flex items-center gap-2 text-gray-700 hover:bg-primary/10" :class="{ 'bg-primary text-white shadow-sm': currentPage === 'register' }">
            <i class="fas fa-user-plus"></i> <span>Registro</span>
        </a>
    </div>
</div>