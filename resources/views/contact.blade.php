@extends('layouts.site')

@section('title', __('site.contact_page.title') . ' | ' . ($settings['site_name'] ?? 'Bali Easy Sourcing'))

@section('content')

    <!-- Header Section -->
    <section class="py-16 md:py-24 border-b border-stone-200/80 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="max-w-3xl">
                <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-3">
                    {{ __('site.contact_page.eyebrow') }}
                </span>
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-stone-900 leading-[1.15] mb-6 font-normal">
                    {{ __('site.contact_page.title') }}
                </h1>
                <p class="text-stone-600 text-base md:text-lg leading-relaxed font-light">
                    {{ __('site.contact_page.subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content: Direct Channels & RFQ Form -->
    <section class="py-16 md:py-24 border-b border-stone-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                
                <!-- Left Column: Direct Channels & Studio Information -->
                <div class="lg:col-span-5 space-y-8">
                    
                    <!-- WhatsApp Direct Card -->
                    <div class="p-8 bg-[#FAF8F5] border border-stone-200 shadow-sm relative overflow-hidden">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-emerald-900 text-emerald-100 flex items-center justify-center shrink-0 rounded-full">
                                <span class="text-xl" aria-hidden="true">💬</span>
                            </div>
                            <div>
                                <h2 class="font-serif text-xl text-stone-900 font-medium mb-1">
                                    {{ __('site.contact_page.whatsapp_direct') }}
                                </h2>
                                <p class="text-stone-600 text-xs sm:text-sm font-light mb-4">
                                    {{ __('site.contact_page.whatsapp_note') }}
                                </p>
                                <a 
                                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890') }}?text={{ urlencode('Hello Bali Easy Sourcing, I would like to inquire about your sourcing and quality inspection services.') }}" 
                                    target="_blank" 
                                    rel="noopener noreferrer" 
                                    class="inline-flex items-center justify-center px-6 py-3 bg-stone-900 text-stone-50 text-xs font-semibold uppercase tracking-[0.16em] hover:bg-stone-800 transition-colors shadow-sm"
                                >
                                    <span>Chat {{ $settings['whatsapp_number'] ?? '+62 812 3456 7890' }}</span>
                                    <span class="ml-2" aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Direct Contact Details -->
                    <div class="p-8 bg-white border border-stone-200 space-y-6">
                        <div class="text-xs font-semibold tracking-[0.2em] uppercase text-stone-400">
                            {{ __('site.contact_page.channels_title') }}
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-3.5">
                            <span class="text-base text-stone-400 mt-0.5" aria-hidden="true">✉️</span>
                            <div>
                                <div class="text-[11px] font-medium tracking-wider uppercase text-stone-500 mb-0.5">
                                    {{ __('site.contact_page.email_direct') }}
                                </div>
                                <a href="mailto:{{ $settings['contact_email'] ?? 'hello@balieasysourcing.com' }}" class="text-stone-900 font-medium text-sm hover:underline">
                                    {{ $settings['contact_email'] ?? 'hello@balieasysourcing.com' }}
                                </a>
                            </div>
                        </div>

                        <!-- Office Address -->
                        <div class="flex items-start gap-3.5 pt-4 border-t border-stone-100">
                            <span class="text-base text-stone-400 mt-0.5" aria-hidden="true">📍</span>
                            <div>
                                <div class="text-[11px] font-medium tracking-wider uppercase text-stone-500 mb-0.5">
                                    {{ __('site.contact_page.office_title') }}
                                </div>
                                <p class="text-stone-700 text-sm font-light leading-relaxed">
                                    {{ $settings['address'] ?? 'Jl. Pantai Batu Bolong, Canggu, Bali 80361, Indonesia' }}
                                </p>
                            </div>
                        </div>

                        <!-- Operating Hours -->
                        <div class="flex items-start gap-3.5 pt-4 border-t border-stone-100">
                            <span class="text-base text-stone-400 mt-0.5" aria-hidden="true">⏰</span>
                            <div>
                                <div class="text-[11px] font-medium tracking-wider uppercase text-stone-500 mb-0.5">
                                    {{ __('site.contact_page.hours_title') }}
                                </div>
                                <p class="text-stone-900 text-sm font-medium">
                                    {{ __('site.contact_page.hours_value') }}
                                </p>
                                <p class="text-stone-500 text-xs font-light mt-1">
                                    {{ __('site.contact_page.hours_note') }}
                                </p>
                            </div>
                        </div>

                        <!-- Instagram Social -->
                        @if(!empty($settings['instagram_url']))
                            <div class="flex items-start gap-3.5 pt-4 border-t border-stone-100">
                                <span class="text-base text-stone-400 mt-0.5" aria-hidden="true">📸</span>
                                <div>
                                    <div class="text-[11px] font-medium tracking-wider uppercase text-stone-500 mb-0.5">
                                        Instagram
                                    </div>
                                    <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="text-stone-900 text-sm hover:underline">
                                        @balieasysourcing &nearr;
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- 48-Hour Guarantee Card -->
                    <div class="p-6 bg-[#181614] text-stone-100 border border-stone-900">
                        <div class="flex items-center gap-2 mb-2 text-amber-200">
                            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs font-semibold tracking-wider uppercase">{{ __('site.contact_page.guarantee_title') }}</span>
                        </div>
                        <p class="text-stone-300 text-xs sm:text-sm font-light leading-relaxed">
                            {{ __('site.contact_page.guarantee_text') }}
                        </p>
                    </div>

                </div>

                <!-- Right Column: Dedicated RFQ / Sourcing Form -->
                <div class="lg:col-span-7">
                    <div class="bg-white p-8 md:p-12 border border-stone-200 shadow-sm">
                        
                        <div class="mb-8">
                            <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                                {{ __('site.contact.eyebrow') }}
                            </span>
                            <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal mb-3">
                                {{ __('site.contact.title') }}
                            </h2>
                            <p class="text-stone-600 text-sm font-light leading-relaxed">
                                {{ __('site.contact.subtitle') }}
                            </p>
                        </div>

                        <!-- Flash Success Notification -->
                        @if(session('rfq_success'))
                            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-300 text-emerald-900 rounded text-sm flex items-start gap-3">
                                <span class="text-emerald-600 font-bold text-lg" aria-hidden="true">✓</span>
                                <div>
                                    <div class="font-semibold mb-0.5">Permintaan Terkirim!</div>
                                    <div>{{ session('rfq_success') }}</div>
                                </div>
                            </div>
                        @endif

                        <!-- Error Notifications -->
                        @if ($errors->any())
                            <div class="mb-8 p-4 bg-red-50 border border-red-300 text-red-900 rounded text-sm">
                                <div class="font-semibold mb-1">Harap lengkapi formulir dengan benar:</div>
                                <ul class="list-disc pl-5 space-y-1 text-xs">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- RFQ Form -->
                        <form action="{{ route('rfq.submit') }}" method="POST" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Full Name -->
                                <div>
                                    <label for="name" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                        {{ __('site.contact.name_label') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        required 
                                        placeholder="{{ __('site.contact.name_placeholder') }}"
                                        class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                                    >
                                </div>

                                <!-- Email Address -->
                                <div>
                                    <label for="email" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                        {{ __('site.contact.email_label') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        required 
                                        placeholder="{{ __('site.contact.email_placeholder') }}"
                                        class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                                    >
                                </div>

                                <!-- Company / Brand -->
                                <div>
                                    <label for="company" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                        {{ __('site.contact.company_label') }}
                                    </label>
                                    <input 
                                        type="text" 
                                        id="company" 
                                        name="company" 
                                        value="{{ old('company') }}" 
                                        placeholder="{{ __('site.contact.company_placeholder') }}"
                                        class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                                    >
                                </div>

                                <!-- WhatsApp Phone -->
                                <div>
                                    <label for="whatsapp" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                        {{ __('site.contact.whatsapp_label') }}
                                    </label>
                                    <input 
                                        type="text" 
                                        id="whatsapp" 
                                        name="whatsapp" 
                                        value="{{ old('whatsapp') }}" 
                                        placeholder="{{ __('site.contact.whatsapp_placeholder') }}"
                                        class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                                    >
                                </div>

                                <!-- Product Category Selector -->
                                <div>
                                    <label for="category_id" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                        {{ __('site.contact.category_label') }}
                                    </label>
                                    <select 
                                        id="category_id" 
                                        name="category_id" 
                                        class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                                    >
                                        <option value="">{{ __('site.contact.category_default') }}</option>
                                        @foreach($categories as $cat)
                                            @php
                                                $catSelectName = __("site.categories.items.{$cat->slug}.name");
                                                if ($catSelectName === "site.categories.items.{$cat->slug}.name") {
                                                    $catSelectName = $cat->name;
                                                }
                                            @endphp
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $catSelectName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Estimated Quantity -->
                                <div>
                                    <label for="quantity" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                        {{ __('site.contact.quantity_label') }}
                                    </label>
                                    <input 
                                        type="text" 
                                        id="quantity" 
                                        name="quantity" 
                                        value="{{ old('quantity') }}" 
                                        placeholder="{{ __('site.contact.quantity_placeholder') }}"
                                        class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                                    >
                                </div>
                            </div>

                            <!-- Project Scope & Description -->
                            <div>
                                <label for="description" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                    {{ __('site.contact.description_label') }} <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    id="description" 
                                    name="description" 
                                    rows="5" 
                                    required 
                                    placeholder="{{ __('site.contact.description_placeholder') }}"
                                    class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                                >{{ old('description') }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button type="submit" class="w-full py-4 bg-stone-900 text-stone-50 text-xs font-semibold uppercase tracking-[0.18em] hover:bg-stone-800 transition-colors shadow-sm">
                                    {{ __('site.contact.btn_submit') }} &rarr;
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
