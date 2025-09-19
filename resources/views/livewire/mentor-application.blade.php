<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
    <!-- Hero Section - Flat Design -->
    <div class="bg-gradient-to-r from-[#1e3737] to-[#07847f] relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-black/10 to-transparent"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <div class="w-24 h-24 bg-white rounded-full mx-auto mb-8 grid place-items-center shadow-xl">
                    <img src="/images/getu-logo.png" alt="GeTu Logo" class="h-14 w-14 object-contain">
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                    Thank You for Choosing to Make a Difference!
                </h1>
                <p class="text-xl text-[#8fe1de] max-w-3xl mx-auto font-light">
                    Your decision to become a mentor with GeTu Prospects e.V. will transform lives and build bridges in our community
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
    </div>

    @if($submitted)
        <!-- Success State - Flat Design -->
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="bg-white border-t-4 border-[#07847f]">
                <div class="p-12 text-center">
                    <div class="w-20 h-20 bg-[#8fe1de] mx-auto flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-[#1e3737]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-[#1e3737] mb-4">Application Submitted</h2>
                    <p class="text-[#6e7a7a] mb-8 text-lg">Thank you for joining the GeTu mentor community. We'll review your application within 2-3 business days.</p>

                    @if($statusCheckUrl)
                        <div class="bg-[#f2f7f7] border-l-4 border-[#07847f] p-6 text-left max-w-2xl mx-auto mb-8">
                            <p class="font-semibold text-[#1e3737] mb-3">Save Your Status Check Link</p>
                            <p class="text-[#6e7a7a] text-sm mb-4">Use this secure link to check your application status:</p>
                            <div class="bg-white p-4 font-mono text-sm text-[#07847f] break-all border border-[#edefef]">
                                <a href="{{ $statusCheckUrl }}" class="hover:text-[#1e3737] transition-colors">
                                    {{ $statusCheckUrl }}
                                </a>
                            </div>
                        </div>
                    @endif

                    <button wire:click="$set('submitted', false)" class="px-8 py-3 bg-[#1e3737] text-white font-medium hover:bg-[#385656] transition-colors">
                        Submit Another Application
                    </button>
                </div>
            </div>
        </div>
    @else
        <!-- Application Form - Enhanced Flat Design -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">

            <!-- About GeTu Section - Flat Design -->
            <div class="mb-24">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-px bg-gray-300">
                    <!-- Left Side - Organization Info -->
                    <div class="bg-white relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=2070&auto=format&fit=crop"
                             alt="People helping each other"
                             class="w-full h-64 object-cover">
                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-[#1e3737] mb-4">About GeTu Prospects e.V.</h2>
                            <p class="text-[#385656] mb-6 leading-relaxed">
                                We are a registered non-profit organization in Germany dedicated to helping people integrate and achieve their personal and professional goals. Through mentorship, we connect experienced professionals with newcomers who need guidance navigating their new life in Germany.
                            </p>

                            <div class="border-l-4 border-[#07847f] pl-6">
                                <p class="text-sm text-[#6e7a7a] mb-4">
                                    Our mission is to create a supportive community where everyone has access to the guidance and resources they need to thrive in Germany.
                                </p>
                                <p class="text-sm text-[#385656]">
                                    Learn more about us at <a href="https://getu-prospects.de" target="_blank" class="text-[#07847f] hover:text-[#1e3737] underline transition-colors">getu-prospects.de</a> or reach out to us at <a href="mailto:info@getu-prospects.de" class="text-[#07847f] hover:text-[#1e3737] underline transition-colors">info@getu-prospects.de</a> for more information.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Areas of Support -->
                    <div class="bg-white">
                        <div class="bg-gradient-to-r from-[#07847f] to-[#0a9e98] p-8">
                            <h2 class="text-3xl font-bold text-white">Areas Where You Can Help</h2>
                        </div>
                        <div class="p-8">
                            <p class="text-[#385656] mb-6">As a mentor, you'll provide guidance in the following areas:</p>

                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Orientation & Everyday Life in Germany</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Language & Communication</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Education & Work</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Administrative Procedures & Rights</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Housing & Mobility</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Social Integration & Network</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Healthcare</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Instrument (Piano, Guitar, etc.)</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Other Special Skills</p>
                                </div>
                            </div>

                            <div class="mt-8 p-4 bg-[#f2f7f7] border-l-4 border-[#fe7f4c]">
                                <p class="text-sm text-[#385656]">
                                    Join our community and help newcomers achieve their personal and professional goals in Germany.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Your Impact Section - Grid Layout -->
            <div class="mb-24 grid grid-cols-1 lg:grid-cols-4 gap-px bg-gray-300">
                <!-- Main Message -->
                <div class="bg-white p-8 lg:col-span-4">
                    <h3 class="text-2xl font-bold text-[#1e3737] mb-4">Your Journey as a Mentor</h3>
                    <p class="text-[#6e7a7a] leading-relaxed">
                        Together, we're building a Germany where everyone has the support they need to thrive. Here's how you'll make an impact:
                    </p>
                </div>

                <!-- Impact Card 1 -->
                <div class="bg-white p-6 relative overflow-hidden group hover:bg-[#f8f9f9] transition-colors">
                    <div class="absolute top-0 left-0 w-full h-1 bg-[#07847f]"></div>
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?q=80&w=2069&auto=format&fit=crop"
                             alt="Professional guidance"
                             class="w-full h-32 object-cover mb-4 grayscale group-hover:grayscale-0 transition-all">
                        <h4 class="font-bold text-[#1e3737] mb-2">Career Navigation</h4>
                        <p class="text-sm text-[#6e7a7a]">Guide professionals through the German job market, from CV optimization to interview preparation.</p>
                    </div>
                </div>

                <!-- Impact Card 2 -->
                <div class="bg-white p-6 relative overflow-hidden group hover:bg-[#f8f9f9] transition-colors">
                    <div class="absolute top-0 left-0 w-full h-1 bg-[#fe7f4c]"></div>
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=2070&auto=format&fit=crop"
                             alt="Language support"
                             class="w-full h-32 object-cover mb-4 grayscale group-hover:grayscale-0 transition-all">
                        <h4 class="font-bold text-[#1e3737] mb-2">Language Bridge</h4>
                        <p class="text-sm text-[#6e7a7a]">Help break language barriers and build confidence in German communication.</p>
                    </div>
                </div>

                <!-- Impact Card 3 -->
                <div class="bg-white p-6 relative overflow-hidden group hover:bg-[#f8f9f9] transition-colors">
                    <div class="absolute top-0 left-0 w-full h-1 bg-[#8fe1de]"></div>
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2084&auto=format&fit=crop"
                             alt="Community building"
                             class="w-full h-32 object-cover mb-4 grayscale group-hover:grayscale-0 transition-all">
                        <h4 class="font-bold text-[#1e3737] mb-2">Community Building</h4>
                        <p class="text-sm text-[#6e7a7a]">Connect people with local communities and help them build lasting friendships.</p>
                    </div>
                </div>

                <!-- Impact Card 4 -->
                <div class="bg-white p-6 relative overflow-hidden group hover:bg-[#f8f9f9] transition-colors">
                    <div class="absolute top-0 left-0 w-full h-1 bg-[#385656]"></div>
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=2070&auto=format&fit=crop"
                             alt="Administrative help"
                             class="w-full h-32 object-cover mb-4 grayscale group-hover:grayscale-0 transition-all">
                        <h4 class="font-bold text-[#1e3737] mb-2">System Navigation</h4>
                        <p class="text-sm text-[#6e7a7a]">Demystify German bureaucracy and help with essential paperwork.</p>
                    </div>
                </div>
            </div>

            <!-- How It Works Section - Redesigned -->
            <div class="mb-24">
                <div class="bg-gradient-to-br from-[#f8f9f9] to-[#f2f7f7] p-12">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-[#1e3737] mb-3">Your Journey as a Mentor</h2>
                        <p class="text-[#6e7a7a] max-w-2xl mx-auto">A simple three-step process to start making a difference</p>
                    </div>

                    <div class="max-w-4xl mx-auto">
                        <!-- Step 1 -->
                        <div class="flex items-start mb-8 relative">
                            <div class="flex-shrink-0 relative z-10">
                                <div class="w-14 h-14 bg-[#07847f] flex items-center justify-center">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <!-- Connecting Line -->
                                <div class="absolute top-14 left-7 w-px h-20 bg-gray-300"></div>
                            </div>
                            <div class="ml-6 bg-white p-6 flex-1 border-l-4 border-[#07847f]">
                                <div class="flex items-center mb-2">
                                    <span class="text-xs font-bold text-[#07847f] uppercase tracking-wider">Step 1</span>
                                </div>
                                <h3 class="text-xl font-bold text-[#1e3737] mb-2">Share Your Story</h3>
                                <p class="text-[#6e7a7a]">Complete your profile with your background, expertise areas, and availability. Tell us about your journey in Germany and what motivates you to help others.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex items-start mb-8 relative">
                            <div class="flex-shrink-0 relative z-10">
                                <div class="w-14 h-14 bg-[#fe7f4c] flex items-center justify-center">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <!-- Connecting Line -->
                                <div class="absolute top-14 left-7 w-px h-20 bg-gray-300"></div>
                            </div>
                            <div class="ml-6 bg-white p-6 flex-1 border-l-4 border-[#fe7f4c]">
                                <div class="flex items-center mb-2">
                                    <span class="text-xs font-bold text-[#fe7f4c] uppercase tracking-wider">Step 2</span>
                                </div>
                                <h3 class="text-xl font-bold text-[#1e3737] mb-2">Find Your Match</h3>
                                <p class="text-[#6e7a7a]">Our team carefully matches you with mentees based on shared interests, professional backgrounds, and specific needs. You'll receive mentee profiles for your review.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex items-start relative">
                            <div class="flex-shrink-0 relative z-10">
                                <div class="w-14 h-14 bg-[#8fe1de] flex items-center justify-center">
                                    <svg class="w-7 h-7 text-[#1e3737]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6 bg-white p-6 flex-1 border-l-4 border-[#8fe1de]">
                                <div class="flex items-center mb-2">
                                    <span class="text-xs font-bold text-[#8fe1de] uppercase tracking-wider">Step 3</span>
                                </div>
                                <h3 class="text-xl font-bold text-[#1e3737] mb-2">Make an Impact</h3>
                                <p class="text-[#6e7a7a]">Start your mentoring sessions - whether online or in-person. Guide your mentees through challenges, celebrate their successes, and watch them thrive in their new home.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="text-center mt-12 pt-8 border-t border-gray-200">
                        <p class="text-[#385656] mb-4">Ready to begin your mentoring journey?</p>
                        <a href="#application-form" class="inline-flex items-center px-6 py-3 bg-[#07847f] text-white font-medium hover:bg-[#1e3737] transition-colors">
                            Start Your Application
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Application Form -->
            <form wire:submit="submit" class="space-y-px bg-gray-200 mt-32">
                {{-- Personal Information Section --}}
                <div class="bg-white">
                    <div class="bg-gradient-to-r from-[#07847f] to-[#0a9e98] px-8 py-6 flex items-center">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur flex items-center justify-center text-white text-xl font-bold mr-4">1</div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Personal Information</h3>
                            <p class="text-[#c3f0ed] text-sm mt-1">Tell us how to reach you</p>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-[#385656] mb-2">
                                    Full Name <span class="text-[#fe7f4c]">*</span>
                                </label>
                                <input
                                    type="text"
                                    wire:model="name"
                                    id="name"
                                    class="w-full px-4 py-3 border border-[#edefef] bg-white text-[#1e3737] placeholder-[#8b9e9e] focus:outline-none focus:border-[#07847f] transition-colors @error('name') border-[#fe7f4c] @enderror"
                                    placeholder="Enter your full name"
                                >
                                @error('name')
                                    <p class="mt-2 text-sm text-[#fe7f4c]">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-[#385656] mb-2">
                                    Email Address <span class="text-[#fe7f4c]">*</span>
                                </label>
                                <input
                                    type="email"
                                    wire:model="email"
                                    id="email"
                                    class="w-full px-4 py-3 border border-[#edefef] bg-white text-[#1e3737] placeholder-[#8b9e9e] focus:outline-none focus:border-[#07847f] transition-colors @error('email') border-[#fe7f4c] @enderror"
                                    placeholder="your.email@example.com"
                                >
                                @error('email')
                                    <p class="mt-2 text-sm text-[#fe7f4c]">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- Location Field -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-[#385656] mb-2">
                                    Location <span class="text-[#fe7f4c]">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-[#8b9e9e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        wire:model="location"
                                        id="location"
                                        class="w-full pl-12 pr-4 py-3 border border-[#edefef] bg-white text-[#1e3737] placeholder-[#8b9e9e] focus:outline-none focus:border-[#07847f] transition-colors @error('location') border-[#fe7f4c] @enderror"
                                        placeholder="Berlin, Hamburg, München..."
                                    >
                                </div>
                                @error('location')
                                    <p class="mt-2 text-sm text-[#fe7f4c]">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Profession Field -->
                            <div>
                                <label for="profession" class="block text-sm font-medium text-[#385656] mb-2">
                                    Profession
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-[#8b9e9e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        wire:model="profession"
                                        id="profession"
                                        class="w-full pl-12 pr-4 py-3 border border-[#edefef] bg-white text-[#1e3737] placeholder-[#8b9e9e] focus:outline-none focus:border-[#07847f] transition-colors @error('profession') border-[#fe7f4c] @enderror"
                                        placeholder="Software Engineer, Teacher, Doctor..."
                                    >
                                </div>
                                @error('profession')
                                    <p class="mt-2 text-sm text-[#fe7f4c]">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Calendar Link Field -->
                            <div>
                                <label for="booking_calendar_link" class="block text-sm font-medium text-[#385656] mb-2">
                                    Calendar Booking Link <span class="text-[#fe7f4c]">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-[#8b9e9e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input
                                        type="url"
                                        wire:model="booking_calendar_link"
                                        id="booking_calendar_link"
                                        class="w-full pl-12 pr-4 py-3 border border-[#edefef] bg-white text-[#1e3737] placeholder-[#8b9e9e] focus:outline-none focus:border-[#07847f] transition-colors @error('booking_calendar_link') border-[#fe7f4c] @enderror"
                                        placeholder="https://calendly.com/your-name"
                                    >
                                </div>
                                <p class="mt-2 text-xs text-[#8b9e9e]">Calendly, Google Calendar, Cal.com, or any booking system</p>
                                @error('booking_calendar_link')
                                    <p class="mt-2 text-sm text-[#fe7f4c]">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Areas of Expertise Section --}}
                <div class="bg-white">
                    <div class="bg-gradient-to-r from-[#fe7f4c] to-[#ff9a6e] px-8 py-6 flex items-center">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur flex items-center justify-center text-white text-xl font-bold mr-4">2</div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Areas of Expertise</h3>
                            <p class="text-white/90 text-sm mt-1">Select all areas where you can provide guidance</p>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-gray-200">
                            @foreach($expertiseCategories as $category)
                                <label class="bg-white p-5 hover:bg-[#f2f7f7] cursor-pointer transition-colors group">
                                    <div class="flex items-start">
                                        <input
                                            type="checkbox"
                                            wire:model="expertise_areas"
                                            value="{{ $category->id }}"
                                            class="mt-1 h-5 w-5 text-[#07847f] border-[#edefef] focus:ring-[#8fe1de] focus:ring-offset-0"
                                        >
                                        <div class="ml-3 flex-1">
                                            <span class="block font-medium text-[#1e3737] group-hover:text-[#07847f] transition-colors">
                                                {{ $category->name }}
                                            </span>
                                            @if($category->description)
                                                <span class="block text-sm text-[#8b9e9e] mt-1">{{ $category->description }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('expertise_areas')
                            <div class="mt-4 bg-[#fff5f5] border-l-4 border-[#fe7f4c] p-4">
                                <p class="text-sm text-[#fe7f4c]">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                </div>


                {{-- Additional Contribution Section --}}
                <div class="bg-white">
                    <div class="bg-gradient-to-r from-[#385656] to-[#4a6b6b] px-8 py-6 flex items-center">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur flex items-center justify-center text-white text-xl font-bold mr-4">3</div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Additional Ways to Help</h3>
                            <p class="text-white/90 text-sm mt-1">How else can you contribute to our community?</p>
                        </div>
                    </div>

                    <div class="p-8 space-y-6">
                        <div>
                            <label for="additional_contribution" class="block text-sm font-medium text-[#385656] mb-2">
                                Additional Contributions (Optional)
                            </label>
                            <textarea
                                wire:model="additional_contribution"
                                id="additional_contribution"
                                rows="4"
                                maxlength="1000"
                                class="w-full px-4 py-3 border border-[#edefef] bg-white text-[#1e3737] placeholder-[#8b9e9e] focus:outline-none focus:border-[#07847f] transition-colors resize-none @error('additional_contribution') border-[#fe7f4c] @enderror"
                                placeholder="E.g., I can teach piano/guitar, help with language exchange, organize community events, provide career mentoring..."
                            ></textarea>
                            <p class="mt-2 text-xs text-[#8b9e9e]">
                                Any special skills or ways you can support the community beyond mentoring
                            </p>
                            @error('additional_contribution')
                                <p class="mt-2 text-sm text-[#fe7f4c]">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#385656] mb-3">
                                Join Our WhatsApp Community
                            </label>
                            <div class="bg-[#f2f7f7] border-l-4 border-[#07847f] p-4">
                                <label class="flex items-start cursor-pointer">
                                    <input
                                        type="checkbox"
                                        wire:model.live="join_online_community"
                                        class="mt-1 h-5 w-5 text-[#07847f] border-[#edefef] focus:ring-[#8fe1de] focus:ring-offset-0"
                                    >
                                    <div class="ml-3">
                                        <span class="block font-medium text-[#1e3737]">
                                            Yes, I want to join the WhatsApp community
                                        </span>
                                        <span class="block text-sm text-[#8b9e9e] mt-1">
                                            Connect with other mentors and mentees, share resources, and participate in discussions
                                        </span>
                                    </div>
                                </label>
                            </div>

                            @if($join_online_community)
                                <div class="mt-6">
                                    <label for="phone" class="block text-sm font-medium text-[#385656] mb-2">
                                        WhatsApp Number <span class="text-[#fe7f4c]">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-[#8b9e9e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <input
                                            type="tel"
                                            wire:model="phone"
                                            id="phone"
                                            class="w-full pl-12 pr-4 py-3 border border-[#edefef] bg-white text-[#1e3737] placeholder-[#8b9e9e] focus:outline-none focus:border-[#07847f] transition-colors @error('phone') border-[#fe7f4c] @enderror"
                                            placeholder="+49 123 456789"
                                        >
                                    </div>
                                    <p class="mt-2 text-xs text-[#8b9e9e]">We'll add you to our WhatsApp community group</p>
                                    @error('phone')
                                        <p class="mt-2 text-sm text-[#fe7f4c]">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Submit Section --}}
                <div class="bg-white">
                    <div class="px-8 py-8 bg-gradient-to-r from-[#f8f9f9] to-[#f2f7f7] border-t-2 border-[#edefef]">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-[#8b9e9e]">
                                <span class="text-[#fe7f4c]">*</span> Required fields
                            </p>

                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed"
                                class="group px-10 py-4 bg-[#07847f] text-white font-semibold hover:bg-[#1e3737] transition-colors focus:outline-none focus:ring-4 focus:ring-[#8fe1de]/30"
                            >
                                <span wire:loading.remove class="flex items-center">
                                    Submit Application
                                    <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                                <span wire:loading class="flex items-center">
                                    <svg class="animate-spin h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle>
                                        <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" class="opacity-75"></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif
</div>