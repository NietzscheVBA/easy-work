@props(['currentRoute' => ''])

@php
    $naveItems = [
        ['route' => 'home',         'title' => 'Home'],
        ['route' => 'login',        'title' => 'Login'],
        ['route' => 'register',     'title' => 'Registre-se']
    ];

@endphp 

<div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-gray-200 pb-4 mb-6">
    @foreach ($naveItems as $item)

        @if ($currentRoute === $item['route'])
            <div class="flex items-center gap-2">
                <i class="fas fa-users-viewfinder text-primary text-2xl"></i>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">{{ $item['title']}}</h1>
            </div>

        <div class="flex gap-2 mt-3 md:mt-0 bg-white/60 p-1 rounded-xl shadow-sm">
            <a href="{{ route('home') }}" data-page="home" class="nav-btn px-5 py-2 rounded-lg font-medium transition-all flex items-center gap-2 text-gray-700 hover:bg-primary/10 relative">
                <i class="fas fa-chart-line text-sm"></i> <span>Home</span>
                @if ($currentRoute === 'home')
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-gray-400"></span>
                @endif
            </a>
            <a href="{{ route('login') }}" data-page="login" class="nav-btn px-5 py-2 rounded-lg font-medium transition-all flex items-center gap-2 text-gray-700 hover:bg-primary/10 relative">
                <i class="fas fa-sign-in-alt"></i> <span>Login</span>
                @if ($currentRoute === 'login')
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-gray-400"></span>
                @endif
            </a>
            <a href="{{ route('register') }}" data-page="register" class="nav-btn px-5 py-2 rounded-lg font-medium transition-all flex items-center gap-2 text-gray-700 hover:bg-primary/10 relative">
                <i class="fas fa-user-plus"></i> <span>Registro</span>
                @if ($currentRoute === 'register')
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-gray-400"></span>
                @endif
            </a>
        </div>

        @endif

    @endforeach

</div>