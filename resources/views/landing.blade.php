@extends('layouts.app')

@section('title', 'GeTu Mentorship Platform - Home')

@section('content')
    <!-- Hero - Split Screen -->
    <section class="min-h-screen flex items-center">
        <div class="w-full max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <!-- Left Side - Text -->
                <div class="py-20 lg:pr-16 flex flex-col justify-center">
                    <div class="mb-6">
                        <span class="text-[#fe7f4c] text-sm font-semibold tracking-wider uppercase">GeTu Prospects e.V.</span>
                    </div>
                    <h1 class="text-6xl lg:text-7xl font-bold text-[#1e3737] leading-tight mb-6">
                        Mentorship<br/>
                        that<br/>
                        <span class="text-[#07847f]">matters.</span>
                    </h1>
                    <p class="text-xl text-[#6e7a7a] mb-10 leading-relaxed">
                        Connect with experienced mentors who understand your journey in Germany.
                    </p>

                    <div class="flex gap-4">
                        <a href="/request-mentorship" class="px-8 py-4 bg-[#07847f] text-white font-medium hover:bg-[#1e3737] transition-all">
                            Get Started →
                        </a>
                        <a href="/mentor/apply" class="px-8 py-4 border-2 border-[#1e3737] text-[#1e3737] font-medium hover:bg-[#1e3737] hover:text-white transition-all">
                            Become a Mentor
                        </a>
                    </div>
                </div>

                <!-- Right Side - Visual -->
                <div class="relative bg-gradient-to-br from-[#8fe1de] to-[#07847f] lg:min-h-[calc(100vh-4rem)] flex items-center justify-center">
                    <div class="absolute inset-0 bg-[#1e3737]/10"></div>
                    <div class="relative p-12 text-center">
                        <div class="text-white">
                            <div class="text-8xl font-bold mb-4">500+</div>
                            <div class="text-2xl font-light">Successful Matches</div>
                            <div class="mt-8 flex justify-center gap-8">
                                <div>
                                    <div class="text-4xl font-bold">92%</div>
                                    <div class="text-sm opacity-90">Success Rate</div>
                                </div>
                                <div>
                                    <div class="text-4xl font-bold">48h</div>
                                    <div class="text-sm opacity-90">Avg. Match Time</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Simple Process -->
    <section class="py-24 bg-[#f8f9fa]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="max-w-2xl mb-16">
                <h2 class="text-5xl font-bold text-[#1e3737] mb-4">
                    How it works
                </h2>
                <p class="text-xl text-[#6e7a7a]">
                    Three simple steps to connect with the right mentor
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border-t border-l border-[#e0e0e0]">
                <div class="p-8 border-r border-b border-[#e0e0e0] bg-white hover:bg-[#f8f9fa] transition-colors">
                    <div class="text-6xl font-bold text-[#8fe1de] mb-4">01</div>
                    <h3 class="text-2xl font-semibold text-[#1e3737] mb-3">Apply</h3>
                    <p class="text-[#6e7a7a]">Share your goals and what support you need</p>
                </div>

                <div class="p-8 border-r border-b border-[#e0e0e0] bg-white hover:bg-[#f8f9fa] transition-colors">
                    <div class="text-6xl font-bold text-[#fe7f4c] mb-4">02</div>
                    <h3 class="text-2xl font-semibold text-[#1e3737] mb-3">Match</h3>
                    <p class="text-[#6e7a7a]">We connect you with the perfect mentor</p>
                </div>

                <div class="p-8 border-b border-r border-[#e0e0e0] bg-white hover:bg-[#f8f9fa] transition-colors">
                    <div class="text-6xl font-bold text-[#07847f] mb-4">03</div>
                    <h3 class="text-2xl font-semibold text-[#1e3737] mb-3">Grow</h3>
                    <p class="text-[#6e7a7a]">Start your journey to success in Germany</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertise Grid - Bento Style -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16">
                <h2 class="text-5xl font-bold text-[#1e3737] mb-4">
                    Expert guidance for every need
                </h2>
                <p class="text-xl text-[#6e7a7a]">
                    Our mentors cover all aspects of life in Germany
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Large Card -->
                <div class="col-span-2 row-span-2 bg-[#1e3737] p-10 text-white group hover:bg-[#07847f] transition-all">
                    <h3 class="text-3xl font-bold mb-4">Career & Education</h3>
                    <p class="text-lg opacity-90 mb-6">University applications, job search strategies, and professional development in the German market</p>
                    <span class="text-white/60 group-hover:text-white transition">Learn more →</span>
                </div>

                <!-- Regular Cards -->
                <div class="bg-[#f8f9fa] p-6 hover:bg-[#8fe1de] hover:text-white transition-all group">
                    <h4 class="text-lg font-semibold mb-2 group-hover:text-white">Housing</h4>
                    <p class="text-sm text-[#6e7a7a] group-hover:text-white">Finding apartments</p>
                </div>

                <div class="bg-[#f8f9fa] p-6 hover:bg-[#fe7f4c] hover:text-white transition-all group">
                    <h4 class="text-lg font-semibold mb-2 group-hover:text-white">Legal</h4>
                    <p class="text-sm text-[#6e7a7a] group-hover:text-white">Visa & permits</p>
                </div>

                <div class="bg-[#f8f9fa] p-6 hover:bg-[#07847f] hover:text-white transition-all group">
                    <h4 class="text-lg font-semibold mb-2 group-hover:text-white">Language</h4>
                    <p class="text-sm text-[#6e7a7a] group-hover:text-white">German practice</p>
                </div>

                <div class="bg-[#f8f9fa] p-6 hover:bg-[#1e3737] hover:text-white transition-all group">
                    <h4 class="text-lg font-semibold mb-2 group-hover:text-white">Healthcare</h4>
                    <p class="text-sm text-[#6e7a7a] group-hover:text-white">Insurance & doctors</p>
                </div>

                <!-- Wide Card -->
                <div class="col-span-2 bg-[#fe7f4c] p-8 text-white">
                    <h3 class="text-2xl font-bold mb-3">Family Integration</h3>
                    <p class="opacity-90">Schools, childcare, and family services support</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial -->
    <section class="py-24 bg-[#f8f9fa]">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="mb-8">
                <svg class="w-16 h-16 text-[#8fe1de] mx-auto" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
            </div>
            <blockquote class="text-3xl font-light text-[#1e3737] mb-8 leading-relaxed">
                The mentorship program helped me navigate the German job market with confidence. Within three months, I landed my dream position.
            </blockquote>
            <cite class="text-[#6e7a7a] not-italic">
                <span class="font-semibold text-[#1e3737]">Maria Rodriguez</span>
                <span class="mx-2">•</span>
                Software Engineer, Berlin
            </cite>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 bg-[#1e3737] relative overflow-hidden -mt-20">
        <div class="absolute inset-0 bg-gradient-to-r from-[#1e3737] to-[#07847f] opacity-90"></div>
        <div class="relative max-w-4xl mx-auto text-center px-6">
            <h2 class="text-5xl md:text-6xl font-bold text-white mb-6">
                Start your success story
            </h2>
            <p class="text-2xl text-[#8fe1de] mb-12 font-light">
                Join hundreds who've found their path in Germany
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="/request-mentorship" class="px-10 py-5 bg-white text-[#1e3737] font-semibold text-lg hover:bg-[#f8f9fa] transition-all">
                    Request a Mentor
                </a>
                <a href="/mentor/apply" class="px-10 py-5 border-2 border-white text-white font-semibold text-lg hover:bg-white hover:text-[#1e3737] transition-all">
                    Become a Mentor
                </a>
            </div>
        </div>
    </section>

    <!-- About GeTu -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-[#1e3737] mb-6">About GeTu Prospects e.V.</h2>
                    <p class="text-lg text-[#6e7a7a] mb-4 leading-relaxed">
                        GeTu Prospects e.V. is an intercultural non-profit organization based in Berlin, dedicated to supporting families and youth through integration and cultural exchange.
                    </p>
                    <p class="text-lg text-[#6e7a7a] mb-8 leading-relaxed">
                        Our mentorship platform connects experienced individuals with newcomers, creating meaningful relationships that foster personal growth, professional development, and successful integration into German society.
                    </p>
                    <div class="bg-[#f2f7f7] border-l-4 border-[#07847f] p-5 mb-8">
                        <p class="text-[#1e3737] font-semibold text-lg italic">
                            "Vielfalt leben, Träume stärken"
                        </p>
                        <p class="text-[#6e7a7a] text-sm mt-1">
                            Live Diversity, Strengthen Dreams
                        </p>
                    </div>
                    <a href="https://getu-prospects.de" target="_blank" class="inline-block px-8 py-3 bg-[#07847f] text-white font-semibold hover:bg-[#1e3737] transition-colors">
                        Learn More About GeTu
                    </a>
                </div>
                <div class="flex justify-center">
                    <img src="/images/getu-logo.png" alt="GeTu Prospects Logo" class="max-w-sm w-full">
                </div>
            </div>
        </div>
    </section>
@endsection