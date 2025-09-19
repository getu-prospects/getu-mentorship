@props([
    'title' => '',
    'subtitle' => ''
])

<!-- Hero Section - Flat Design -->
<div class="bg-gradient-to-r from-[#1e3737] to-[#07847f] relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-black/10 to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <div class="w-24 h-24 bg-white rounded-full mx-auto mb-8 grid place-items-center shadow-xl">
                <img src="/images/getu-logo.png" alt="GeTu Logo" class="h-14 w-14 object-contain">
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                {{ $title }}
            </h1>
            <p class="text-xl text-[#8fe1de] max-w-3xl mx-auto font-light">
                {{ $subtitle }}
            </p>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
</div>