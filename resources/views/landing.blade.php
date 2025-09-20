@extends('layouts.app')

@section('title', 'GeTu Mentorship Platform - Home')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center">
        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3"
             alt="People from different backgrounds coming together in community"
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-[#1e3737]/90 to-[#1e3737]/60"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-20">
            <div class="max-w-2xl">
                <div class="mb-6">
                    <span class="text-[#8fe1de] text-sm font-semibold tracking-wider uppercase">GeTu Prospects e.V.</span>
                </div>
                <h1 class="text-5xl lg:text-7xl font-bold text-white leading-tight mb-6">
                    Your community in Germany<br/>
                    <span class="text-[#8fe1de]">starts here.</span>
                </h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">
                    Connect with caring mentors who understand your journey. Get the support, friendship, and guidance you need to feel at home in Germany.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('mentorship.request') }}" class="px-8 py-4 bg-[#fe7f4c] text-white font-semibold text-lg hover:bg-[#e6703f] transition-all text-center">
                        Find a Mentor →
                    </a>
                    <a href="{{ route('mentor.apply') }}" class="px-8 py-4 border-2 border-white text-white font-semibold text-lg hover:bg-white hover:text-[#1e3737] transition-all text-center">
                        Become a Mentor
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Our Mentorship Program Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-[#1e3737] mb-6">
                        Why choose our mentorship program?
                    </h2>
                    <p class="text-xl text-[#6e7a7a] mb-6 leading-relaxed">
                        Moving to a new country can feel overwhelming. Our mentorship program connects you with caring people who have walked the same path and want to help you succeed.
                    </p>
                    <p class="text-lg text-[#385656] mb-8 leading-relaxed">
                        Our mentors are everyday people - neighbors, friends, community members - who remember what it was like to start fresh in Germany. They offer their time because they believe in the power of human connection and community support.
                    </p>

                    <div class="bg-[#f2f7f7] border-l-4 border-[#07847f] p-6">
                        <h3 class="font-bold text-[#1e3737] mb-2">What makes us different:</h3>
                        <ul class="space-y-2 text-[#385656]">
                            <li class="flex items-start">
                                <span class="text-[#07847f] mr-2">•</span>
                                Genuine friendships built on mutual respect and care
                            </li>
                            <li class="flex items-start">
                                <span class="text-[#07847f] mr-2">•</span>
                                Practical support from people who truly understand
                            </li>
                            <li class="flex items-start">
                                <span class="text-[#07847f] mr-2">•</span>
                                A welcoming community that celebrates your journey
                            </li>
                            <li class="flex items-start">
                                <span class="text-[#07847f] mr-2">•</span>
                                Emotional support during both challenges and victories
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3"
                         alt="Two women of different backgrounds having a warm, supportive conversation"
                         class="w-full h-96 object-cover rounded-lg shadow-lg">
                    <div class="absolute -bottom-6 -left-6 bg-[#fe7f4c] text-white p-6 rounded-lg">
                        <div class="text-2xl font-bold">Free</div>
                        <div class="text-sm">Always & Forever</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How Our Community Works -->
    <section class="py-24 bg-[#f8f9fa]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-[#1e3737] mb-4">
                    How our community works
                </h2>
                <p class="text-xl text-[#6e7a7a] max-w-3xl mx-auto">
                    A simple, caring process designed to create lasting friendships and meaningful support
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-[#fe7f4c] text-white text-2xl font-bold rounded-full flex items-center justify-center mb-6 mx-auto">1</div>
                    <h3 class="text-lg font-bold text-[#1e3737] mb-2">Share your story</h3>
                    <p class="text-sm text-[#6e7a7a]">Tell us about yourself, your dreams, and what kind of support would mean the most to you</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-[#07847f] text-white text-2xl font-bold rounded-full flex items-center justify-center mb-6 mx-auto">2</div>
                    <h3 class="text-lg font-bold text-[#1e3737] mb-2">We connect hearts</h3>
                    <p class="text-sm text-[#6e7a7a]">Our caring team thoughtfully matches you with someone who shares your interests and understands your journey</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-[#8fe1de] text-[#1e3737] text-2xl font-bold rounded-full flex items-center justify-center mb-6 mx-auto">3</div>
                    <h3 class="text-lg font-bold text-[#1e3737] mb-2">Build friendship</h3>
                    <p class="text-sm text-[#6e7a7a]">Meet your mentor and start building a meaningful relationship based on trust and mutual support</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-[#1e3737] text-white text-2xl font-bold rounded-full flex items-center justify-center mb-6 mx-auto">4</div>
                    <h3 class="text-lg font-bold text-[#1e3737] mb-2">Grow together</h3>
                    <p class="text-sm text-[#6e7a7a]">Support each other through life's ups and downs, celebrate victories, and build lasting bonds</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Areas of Support -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-[#1e3737] mb-4">
                    How we support each other
                </h2>
                <p class="text-xl text-[#6e7a7a] max-w-3xl mx-auto">
                    Our community helps with all aspects of life in Germany - from practical matters to emotional support
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group bg-[#f8f9fa] p-8 hover:bg-[#1e3737] hover:text-white transition-all duration-300">
                    <div class="w-16 h-16 bg-[#fe7f4c] rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#8fe1de]">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Finding Your Path</h3>
                    <p class="text-[#6e7a7a] group-hover:text-white/90">Whether it's career decisions, education choices, or life direction - get support from someone who cares about your dreams</p>
                </div>

                <div class="group bg-[#f8f9fa] p-8 hover:bg-[#07847f] hover:text-white transition-all duration-300">
                    <div class="w-16 h-16 bg-[#07847f] rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#8fe1de]">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Daily Life Support</h3>
                    <p class="text-[#6e7a7a] group-hover:text-white/90">From finding a home to understanding healthcare, get practical help with the everyday challenges of life in Germany</p>
                </div>

                <div class="group bg-[#f8f9fa] p-8 hover:bg-[#fe7f4c] hover:text-white transition-all duration-300">
                    <div class="w-16 h-16 bg-[#8fe1de] rounded-lg flex items-center justify-center mb-4 group-hover:bg-white">
                        <svg class="w-8 h-8 text-[#1e3737] group-hover:text-[#fe7f4c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Building Community</h3>
                    <p class="text-[#6e7a7a] group-hover:text-white/90">Connect with others, find your tribe, and build the social network that makes Germany feel like home</p>
                </div>

                <div class="group bg-[#f8f9fa] p-8 hover:bg-[#385656] hover:text-white transition-all duration-300">
                    <div class="w-16 h-16 bg-[#385656] rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#8fe1de]">
                        <svg class="w-8 h-8 text-white group-hover:text-[#1e3737]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Language & Culture</h3>
                    <p class="text-[#6e7a7a] group-hover:text-white/90">Practice German in a friendly environment and learn about German culture from someone who wants to see you succeed</p>
                </div>

                <div class="group bg-[#f8f9fa] p-8 hover:bg-[#6e7a7a] hover:text-white transition-all duration-300">
                    <div class="w-16 h-16 bg-[#6e7a7a] rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#8fe1de]">
                        <svg class="w-8 h-8 text-white group-hover:text-[#1e3737]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Navigating Paperwork</h3>
                    <p class="text-[#6e7a7a] group-hover:text-white/90">Get help understanding visa processes, permits, and all the official requirements with someone by your side</p>
                </div>

                <div class="group bg-[#f8f9fa] p-8 hover:bg-[#07847f] hover:text-white transition-all duration-300">
                    <div class="w-16 h-16 bg-[#fe7f4c] rounded-lg flex items-center justify-center mb-4 group-hover:bg-[#8fe1de]">
                        <svg class="w-8 h-8 text-white group-hover:text-[#1e3737]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Family Life</h3>
                    <p class="text-[#6e7a7a] group-hover:text-white/90">Support for families navigating schools, childcare, and creating a loving home environment in Germany</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Our Community CTA Section -->
    <section class="py-32 bg-[#1e3737] relative">
        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3"
             alt="Diverse community of people supporting each other"
             class="absolute inset-0 w-full h-full object-cover opacity-20">

        <div class="relative max-w-4xl mx-auto text-center px-6">
            <h2 class="text-5xl md:text-6xl font-bold text-white mb-6">
                Ready to join our community?
            </h2>
            <p class="text-2xl text-[#8fe1de] mb-12 font-light">
                Take the first step towards building meaningful connections in Germany
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-2xl mx-auto">
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-lg">
                    <h3 class="text-2xl font-bold text-white mb-4">Looking for support?</h3>
                    <p class="text-white/90 mb-6">Connect with a caring mentor who understands your journey and wants to help you thrive in Germany</p>
                    <a href="{{ route('mentorship.request') }}" class="block w-full px-8 py-4 bg-[#fe7f4c] text-white font-semibold text-lg hover:bg-[#e6703f] transition-all">
                        Find a Mentor
                    </a>
                </div>

                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-lg">
                    <h3 class="text-2xl font-bold text-white mb-4">Want to help others?</h3>
                    <p class="text-white/90 mb-6">Share your experience and make a meaningful difference in someone's life by becoming a mentor</p>
                    <a href="{{ route('mentor.apply') }}" class="block w-full px-8 py-4 border-2 border-white text-white font-semibold text-lg hover:bg-white hover:text-[#1e3737] transition-all">
                        Become a Mentor
                    </a>
                </div>
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
                        Our mentorship platform connects experienced individuals with newcomers, creating meaningful relationships that foster personal growth, emotional well-being, and successful integration into German society.
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