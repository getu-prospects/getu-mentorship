<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
    <!-- Hero Section -->
    <x-hero-section
        title="Get the Mentorship You Need"
        subtitle="Connect with experienced mentors who can guide you through your journey in Germany and help you achieve your personal and professional goals"
    />

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
                    <h2 class="text-3xl font-bold text-[#1e3737] mb-4">Request Submitted Successfully</h2>
                    <p class="text-[#6e7a7a] mb-4 text-lg">Thank you for your mentorship request. We'll match you with a suitable mentor and contact you within 3-5 business days.</p>
                    <div class="bg-[#f2f7f7] border-l-4 border-[#07847f] p-4 mb-8 text-left">
                        <p class="text-sm text-[#385656]">
                            <strong>Important:</strong> Please check your email inbox (including spam/junk folder) for updates about your mentor assignment.
                        </p>
                    </div>
                    <button wire:click="resetForm" class="px-8 py-3 bg-[#1e3737] text-white font-medium hover:bg-[#385656] transition-colors">
                        Submit Another Request
                    </button>
                </div>
            </div>
        </div>
    @else
        <!-- Request Form - Enhanced Flat Design -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">

            <!-- What We Offer Section - Flat Design -->
            <div class="mb-24">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-px bg-gray-300">
                    <!-- Left Side - Program Info -->
                    <div class="bg-white relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3"
                             alt="People collaborating and mentoring in modern office"
                             class="w-full h-64 object-cover">
                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-[#1e3737] mb-4">Our Mentorship Program</h2>
                            <p class="text-[#385656] mb-6 leading-relaxed">
                                GeTu Prospects e.V. connects you with experienced mentors who have successfully navigated the challenges you're facing. Our mentors volunteer their time to help you succeed in Germany.
                            </p>

                            <div class="border-l-4 border-[#07847f] pl-6">
                                <p class="text-sm text-[#6e7a7a] mb-4">
                                    Whether you need help with career development, academic guidance, or settling into German life, our mentors are here to support you.
                                </p>
                                <p class="text-sm text-[#385656]">
                                    Learn more at <a href="https://getu-prospects.de" target="_blank" class="text-[#07847f] hover:text-[#1e3737] underline transition-colors">getu-prospects.de</a> or contact us at <a href="mailto:info@getu-prospects.de" class="text-[#07847f] hover:text-[#1e3737] underline transition-colors">info@getu-prospects.de</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - What You'll Get -->
                    <div class="bg-white">
                        <div class="bg-gradient-to-r from-[#07847f] to-[#0a9e98] p-8">
                            <h2 class="text-3xl font-bold text-white">What You'll Receive</h2>
                        </div>
                        <div class="p-8">
                            <p class="text-[#385656] mb-6">Our mentorship program provides:</p>

                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">One-on-one guidance from experienced professionals</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Personalized advice for your specific situation</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Support in navigating German systems and culture</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Career and professional development guidance</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Academic and educational planning assistance</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-[#8fe1de] flex items-center justify-center mr-3 flex-shrink-0">
                                        <div class="w-2 h-2 bg-[#1e3737]"></div>
                                    </div>
                                    <p class="text-sm text-[#1e3737] font-medium">Network building and community connections</p>
                                </div>
                            </div>

                            <div class="mt-8 bg-[#1e3737] text-white p-6">
                                <h3 class="text-lg font-bold mb-2 flex items-center">
                                    <span class="text-2xl mr-2">✓</span>
                                    100% FREE SERVICE
                                </h3>
                                <p class="text-[#8fe1de]">
                                    Our mentorship program is completely free. No fees, no charges, no payment required - this is our commitment to helping everyone succeed in Germany.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How It Works - Timeline Style Flat Design -->
            <div class="mb-24">
                <h2 class="text-3xl font-bold text-[#1e3737] text-center mb-12">How It Works</h2>
                <div class="relative">
                    <div class="absolute top-1/2 left-0 w-full h-px bg-[#edefef] -translate-y-1/2 hidden md:block"></div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-4">
                        <div class="relative bg-white border border-[#edefef] p-8 text-center">
                            <div class="w-12 h-12 bg-[#fe7f4c] text-white flex items-center justify-center font-bold text-lg mb-4 mx-auto">1</div>
                            <h3 class="font-bold text-[#1e3737] mb-2">Submit Your Request</h3>
                            <p class="text-sm text-[#6e7a7a]">Tell us what you need help with and your preferred areas of expertise</p>
                        </div>
                        <div class="relative bg-white border border-[#edefef] p-8 text-center">
                            <div class="w-12 h-12 bg-[#07847f] text-white flex items-center justify-center font-bold text-lg mb-4 mx-auto">2</div>
                            <h3 class="font-bold text-[#1e3737] mb-2">Get Matched</h3>
                            <p class="text-sm text-[#6e7a7a]">We'll carefully match you with a mentor who can best support your goals</p>
                        </div>
                        <div class="relative bg-white border border-[#edefef] p-8 text-center">
                            <div class="w-12 h-12 bg-[#8fe1de] text-[#1e3737] flex items-center justify-center font-bold text-lg mb-4 mx-auto">3</div>
                            <h3 class="font-bold text-[#1e3737] mb-2">Start Your Journey</h3>
                            <p class="text-sm text-[#6e7a7a]">Connect with your mentor and begin working towards your success</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Form -->
            <form wire:submit="submit" class="bg-white border border-[#edefef]">
                <div class="bg-gradient-to-r from-[#1e3737] to-[#07847f] p-8">
                    <h2 class="text-2xl font-bold text-white">Mentorship Request Form</h2>
                    <p class="text-[#8fe1de] mt-2">Please fill out this form to help us match you with the right mentor</p>
                </div>

                <!-- Section 1: Personal Information -->
                <div class="p-8 border-b border-[#edefef]">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-[#1e3737] text-white flex items-center justify-center font-bold text-lg">1</div>
                        <h3 class="text-xl font-bold text-[#1e3737]">Your Information</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="mentee_name" class="block text-sm font-medium text-[#385656] mb-2">
                                Full Name <span class="text-[#fe7f4c]">*</span>
                            </label>
                            <input
                                type="text"
                                id="mentee_name"
                                wire:model="mentee_name"
                                class="w-full px-4 py-3 border border-[#edefef] focus:outline-none focus:ring-2 focus:ring-[#07847f] focus:border-transparent @error('mentee_name') border-[#fe7f4c] @enderror"
                                placeholder="Enter your full name"
                            >
                            @error('mentee_name')
                                <p class="text-[#fe7f4c] text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="mentee_email" class="block text-sm font-medium text-[#385656] mb-2">
                                Email Address <span class="text-[#fe7f4c]">*</span>
                            </label>
                            <input
                                type="email"
                                id="mentee_email"
                                wire:model="mentee_email"
                                class="w-full px-4 py-3 border border-[#edefef] focus:outline-none focus:ring-2 focus:ring-[#07847f] focus:border-transparent @error('mentee_email') border-[#fe7f4c] @enderror"
                                placeholder="your.email@example.com"
                            >
                            @error('mentee_email')
                                <p class="text-[#fe7f4c] text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="mentee_phone" class="block text-sm font-medium text-[#385656] mb-2">
                                Phone Number <span class="text-[#6e7a7a] text-xs">(Optional - for urgent contact)</span>
                            </label>
                            <input
                                type="tel"
                                id="mentee_phone"
                                wire:model="mentee_phone"
                                class="w-full px-4 py-3 border border-[#edefef] focus:outline-none focus:ring-2 focus:ring-[#07847f] focus:border-transparent @error('mentee_phone') border-[#fe7f4c] @enderror"
                                placeholder="+49 123 456 789"
                            >
                            @error('mentee_phone')
                                <p class="text-[#fe7f4c] text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Areas Where You Need Support -->
                <div class="p-8 border-b border-[#edefef]">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-[#1e3737] text-white flex items-center justify-center font-bold text-lg">2</div>
                        <h3 class="text-xl font-bold text-[#1e3737]">Areas Where You Need Support</h3>
                    </div>

                    <p class="text-[#385656] mb-6">Select the areas where you need help <span class="text-[#6e7a7a] text-xs">(Optional - helps us find the best match)</span></p>

                    @error('preferred_expertise')
                        <div class="bg-[#fef2f2] border border-[#fe7f4c] text-[#991b1b] px-4 py-3 mb-6">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($expertiseCategories as $category)
                            <label class="relative flex items-start p-4 border border-[#edefef] cursor-pointer hover:bg-[#f2f7f7] transition-colors
                                       {{ in_array($category->id, $preferred_expertise) ? 'bg-[#f2f7f7] border-[#07847f]' : '' }}">
                                <input
                                    type="checkbox"
                                    wire:model="preferred_expertise"
                                    value="{{ $category->id }}"
                                    @if(count($preferred_expertise) >= 3 && !in_array($category->id, $preferred_expertise)) disabled @endif
                                    class="mt-1 h-4 w-4 text-[#07847f] focus:ring-[#07847f] border-[#edefef]"
                                >
                                <div class="ml-3">
                                    <span class="block font-medium text-[#1e3737]">{{ $category->name }}</span>
                                    @if($category->description)
                                        <span class="block text-sm text-[#6e7a7a] mt-1">{{ $category->description }}</span>
                                    @endif
                                </div>
                                @if(in_array($category->id, $preferred_expertise))
                                    <div class="absolute top-2 right-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#07847f]" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </label>
                        @endforeach
                    </div>

                    @if(count($preferred_expertise) >= 3)
                        <p class="text-amber-600 text-sm mt-4">Maximum of 3 areas reached. Deselect one to choose a different area.</p>
                    @endif
                </div>

                <!-- Section 3: Your Specific Needs -->
                <div class="p-8 border-b border-[#edefef]">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-[#1e3737] text-white flex items-center justify-center font-bold text-lg">3</div>
                        <h3 class="text-xl font-bold text-[#1e3737]">Tell Us More About Your Needs</h3>
                    </div>

                    <div>
                        <label for="help_description" class="block text-sm font-medium text-[#385656] mb-2">
                            Describe your specific situation and goals <span class="text-[#fe7f4c]">*</span>
                        </label>
                        <p class="text-sm text-[#6e7a7a] mb-3">Please provide details about your current challenges, what you hope to achieve, and how a mentor could help you. (Minimum 50 characters)</p>
                        <div class="relative">
                            <textarea
                                id="help_description"
                                wire:model.live.debounce.500ms="help_description"
                                rows="6"
                                class="w-full px-4 py-3 border border-[#edefef] focus:outline-none focus:ring-2 focus:ring-[#07847f] focus:border-transparent @error('help_description') border-[#fe7f4c] @enderror"
                                placeholder="I am currently facing... and I would like help with..."
                            ></textarea>
                            <div class="absolute bottom-2 right-2 text-xs text-[#8b9e9e]">
                                {{ strlen($help_description) }}/2000 characters
                            </div>
                        </div>
                        @if(strlen($help_description) > 0 && strlen($help_description) < 50)
                            <p class="text-amber-600 text-sm mt-1">Please provide at least {{ 50 - strlen($help_description) }} more characters</p>
                        @endif
                        @error('help_description')
                            <p class="text-[#fe7f4c] text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <div class="mt-2 bg-gray-100 h-2">
                            <div class="bg-gradient-to-r from-[#fe7f4c] to-[#07847f] h-2 transition-all duration-300"
                                 style="width: {{ min(100, (strlen($help_description) / 2000) * 100) }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="p-8 bg-[#f2f7f7]">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div>
                            <h4 class="font-bold text-[#1e3737] text-lg mb-1">Ready to Submit?</h4>
                            <p class="text-sm text-[#6e7a7a]">We'll review your request and match you with the right mentor</p>
                        </div>
                        <button
                            type="submit"
                            class="px-8 py-3 bg-[#fe7f4c] text-white font-medium hover:bg-[#e6703f] transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            wire:loading.attr="disabled"
                            @if(!$this->isFormValid) disabled @endif
                        >
                            <span wire:loading.remove>Submit Request</span>
                            <span wire:loading>
                                <svg class="animate-spin inline-block h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Submitting...
                            </span>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Contact Information -->
            <div class="mt-12 text-center">
                <p class="text-[#6e7a7a] mb-4">Have questions? We're here to help!</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8">
                    <a href="https://getu-prospects.de" target="_blank" class="text-[#07847f] hover:text-[#1e3737] transition-colors flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                        </svg>
                        Visit our website
                    </a>
                    <a href="mailto:info@getu-prospects.de" class="text-[#07847f] hover:text-[#1e3737] transition-colors flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        Email us
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>