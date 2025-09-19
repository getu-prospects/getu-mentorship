<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
    <!-- Hero Section - Flat Design -->
    <div class="bg-gradient-to-r from-[#1e3737] to-[#07847f] relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-black/10 to-transparent"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <img src="/images/getu-logo.png" alt="GeTu Logo" class="h-20 w-auto mx-auto mb-8 drop-shadow-lg">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                    Become a Mentor
                </h1>
                <p class="text-xl text-[#8fe1de] max-w-3xl mx-auto font-light">
                    Join our community of experienced professionals guiding newcomers on their journey in Germany
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
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Progress Steps - Flat Design -->
            <div class="mb-12">
                <div class="grid grid-cols-3 gap-px bg-gray-300 p-px">
                    <div class="bg-white p-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-[#07847f] text-white font-bold flex items-center justify-center mr-4 text-lg">1</div>
                            <div>
                                <p class="font-semibold text-[#1e3737]">Personal Info</p>
                                <p class="text-xs text-[#8b9e9e] mt-1">Contact details</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-[#fe7f4c] text-white font-bold flex items-center justify-center mr-4 text-lg">2</div>
                            <div>
                                <p class="font-semibold text-[#1e3737]">Expertise</p>
                                <p class="text-xs text-[#8b9e9e] mt-1">Your skills</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-[#8fe1de] text-[#1e3737] font-bold flex items-center justify-center mr-4 text-lg">3</div>
                            <div>
                                <p class="font-semibold text-[#1e3737]">About You</p>
                                <p class="text-xs text-[#8b9e9e] mt-1">Your story</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form wire:submit="submit" class="space-y-px bg-gray-200">
                {{-- Personal Information Section --}}
                <div class="bg-white">
                    <div class="bg-gradient-to-r from-[#07847f] to-[#0a9e98] px-8 py-6">
                        <h3 class="text-2xl font-bold text-white">Personal Information</h3>
                        <p class="text-[#c3f0ed] text-sm mt-1">Tell us how to reach you</p>
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

                            <!-- Phone Field -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-[#385656] mb-2">
                                    Phone Number
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
                                @error('phone')
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
                                <p class="mt-2 text-xs text-[#8b9e9e]">Calendly, Cal.com, or any booking system</p>
                                @error('booking_calendar_link')
                                    <p class="mt-2 text-sm text-[#fe7f4c]">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Areas of Expertise Section --}}
                <div class="bg-white">
                    <div class="bg-gradient-to-r from-[#fe7f4c] to-[#ff9a6e] px-8 py-6">
                        <h3 class="text-2xl font-bold text-white">Areas of Expertise</h3>
                        <p class="text-white/90 text-sm mt-1">Select all areas where you can provide guidance</p>
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

                {{-- Biography Section --}}
                <div class="bg-white">
                    <div class="bg-gradient-to-r from-[#8fe1de] to-[#a5e8e5] px-8 py-6">
                        <h3 class="text-2xl font-bold text-[#1e3737]">Your Story</h3>
                        <p class="text-[#385656] text-sm mt-1">Share your journey and motivation</p>
                    </div>

                    <div class="p-8">
                        <div>
                            <label for="bio" class="block text-sm font-medium text-[#385656] mb-2">
                                Tell Us Your Story <span class="text-[#fe7f4c]">*</span>
                            </label>
                            <div class="relative">
                                <textarea
                                    wire:model="bio"
                                    id="bio"
                                    rows="8"
                                    maxlength="2000"
                                    class="w-full px-4 py-3 border border-[#edefef] bg-white text-[#1e3737] placeholder-[#8b9e9e] focus:outline-none focus:border-[#07847f] transition-colors resize-none @error('bio') border-[#fe7f4c] @enderror"
                                    placeholder="Share your background, experience in Germany, and why you're passionate about helping newcomers integrate successfully..."
                                ></textarea>

                                <!-- Character Counter with Progress Bar -->
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-white to-transparent pt-8 pb-3 px-4">
                                    <div class="flex items-center justify-between bg-white">
                                        <div class="w-full h-1 bg-gray-200 mr-4">
                                            <div class="h-1 bg-gradient-to-r from-[#07847f] to-[#8fe1de] transition-all duration-300"
                                                 style="width: {{ min((strlen($bio) / 2000) * 100, 100) }}%"></div>
                                        </div>
                                        <span class="text-xs font-medium text-[#6e7a7a] whitespace-nowrap">
                                            {{ strlen($bio) }}/2000
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 text-xs text-[#8b9e9e]">
                                Describe your journey and how you can help others
                            </p>
                            @error('bio')
                                <p class="mt-2 text-sm text-[#fe7f4c]">{{ $message }}</p>
                            @enderror
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