<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'GeTu Mentorship Platform')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="antialiased bg-white">
    <!-- Minimal Header -->
    <header class="fixed w-full bg-white/95 backdrop-blur-sm z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center space-x-3">
                    <img src="/images/getu-logo.png" alt="GeTu" class="h-10 w-auto">
                    <div>
                        <span class="text-sm font-bold text-[#1e3737]">GeTu Prospects e.V.</span>
                        <span class="text-xs text-[#8b9e9e] block">Mentorship Platform</span>
                    </div>
                </a>

                <nav class="hidden md:flex items-center gap-6">
                    <a href="/" class="text-[#6e7a7a] hover:text-[#1e3737] font-medium text-sm transition-colors">Home</a>
                    <a href="/mentor/apply" class="text-[#6e7a7a] hover:text-[#1e3737] font-medium text-sm transition-colors">Become a Mentor</a>
                    <a href="/request-mentorship" class="text-[#6e7a7a] hover:text-[#1e3737] font-medium text-sm transition-colors">Find a Mentor</a>
                    <a href="/admin" class="px-6 py-2 bg-[#1e3737] text-white text-sm font-medium hover:bg-[#07847f] transition-all">
                        Admin
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <button class="md:hidden p-2 text-[#6e7a7a]" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="px-6 py-4 space-y-2">
                <a href="/" class="block text-[#6e7a7a] hover:text-[#1e3737] font-medium text-sm py-2">Home</a>
                <a href="/mentor/apply" class="block text-[#6e7a7a] hover:text-[#1e3737] font-medium text-sm py-2">Become a Mentor</a>
                <a href="/request-mentorship" class="block text-[#6e7a7a] hover:text-[#1e3737] font-medium text-sm py-2">Find a Mentor</a>
                <a href="/admin" class="block px-6 py-2 bg-[#1e3737] text-white text-sm font-medium text-center">Admin</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer -->
    <footer class="bg-[#1e3737] text-white mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <img src="/images/getu-logo.png" alt="GeTu" class="h-10 w-auto mb-4 brightness-0 invert">
                    <p class="text-[#8fe1de] text-sm">
                        Supporting families and youth through integration and cultural exchange.
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="text-[#8fe1de] hover:text-white transition">Home</a></li>
                        <li><a href="/mentor/apply" class="text-[#8fe1de] hover:text-white transition">Become a Mentor</a></li>
                        <li><a href="/request-mentorship" class="text-[#8fe1de] hover:text-white transition">Request Mentorship</a></li>
                        <li><a href="https://getu-prospects.de" target="_blank" class="text-[#8fe1de] hover:text-white transition">About Us</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-sm text-[#8fe1de]">
                        <li>GeTu Prospects e.V.</li>
                        <li>Berlin, Germany</li>
                        <li><a href="mailto:info@getu-prospects.de" class="hover:text-white transition">info@getu-prospects.de</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-[#385656] mt-8 pt-8 text-center text-sm text-[#8fe1de]">
                <p>&copy; {{ date('Y') }} GeTu Prospects e.V. All rights reserved.</p>
                <p class="mt-2 italic">"Vielfalt leben, Träume stärken"</p>
            </div>
        </div>
    </footer>

    @livewireScripts
    @stack('scripts')
</body>
</html>