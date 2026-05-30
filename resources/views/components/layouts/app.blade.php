<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Controle de Usuários' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-sora antialiased">
    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        <x-sidebar.nav />

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto">
            <div class="p-8 max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>

    </div>
    @stack('scripts')
</body>
</html>
