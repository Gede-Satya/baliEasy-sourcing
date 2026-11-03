@extends('layouts.site')

@section('content')

        <!-- 1. Home / Hero Section -->
        <section id="home" class="py-12 md:py-20 border-b border-stone-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    
                    <!-- Left Hero Content -->
                    <div class="lg:col-span-6 flex flex-col justify-center">
                        <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase mb-4">
                            {{ (!empty($settings['hero_eyebrow']) && $settings['hero_eyebrow'] !== 'BALI SOURCING & QUALITY CONTROL') ? $settings['hero_eyebrow'] : __('site.hero.eyebrow') }}
                        </span>
                        
                        <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-stone-900 leading-[1.1] mb-6 font-normal">
                            @if(!empty($settings['hero_title']) && $settings['hero_title'] !== 'Source from Indonesia. We make it simple.')
                                {{ $settings['hero_title'] }}
                            @else
                                {{ __('site.hero.title_part1') }} <span class="italic font-normal">{{ __('site.hero.title_part2') }}</span>
                            @endif
                        </h1>

                        <p class="text-stone-600 text-base md:text-lg leading-relaxed mb-8 max-w-xl font-light">
                            @if(!empty($settings['hero_description']) && $settings['hero_description'] !== 'We find vetted artisan workshops, negotiate honest local prices, and inspect every single item before it ships. You get exceptional craftsmanship without ever leaving your desk.')
                                {{ $settings['hero_description'] }}
                            @else
                                {{ __('site.hero.description') }}
                            @endif
                        </p>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 mb-12">
                            <a href="#contact" class="inline-flex items-center justify-center w-full sm:w-auto px-7 py-3.5 bg-stone-900 text-stone-50 text-xs font-medium uppercase tracking-[0.18em] hover:bg-stone-800 transition-colors shadow-sm text-center">
                                {{ __('site.hero.btn_quote') }}
                            </a>
                            <a href="#categories" class="inline-flex items-center justify-center w-full sm:w-auto px-7 py-3.5 border border-stone-300 text-stone-800 text-xs font-medium uppercase tracking-[0.18em] hover:border-stone-900 transition-colors text-center">
                                {{ __('site.hero.btn_explore') }}
                            </a>
                        </div>

                        <!-- Trust Metrics / Stats -->
                        <div class="grid grid-cols-3 gap-3 sm:gap-6 pt-8 border-t border-stone-200">
                            <div>
                                <div class="font-serif text-2xl sm:text-3xl font-bold text-stone-900">
                                    {{ $settings['stat_1_number'] ?? __('site.hero.stats.workshops_num') }}
                                </div>
                                <div class="text-[10px] sm:text-[11px] text-stone-500 font-medium tracking-wide mt-1 uppercase leading-snug">
                                    {{ $settings['stat_1_label'] ?? __('site.hero.stats.workshops_label') }}
                                </div>
                            </div>
                            <div>
                                <div class="font-serif text-2xl sm:text-3xl font-bold text-stone-900">
                                    {{ $settings['stat_2_number'] ?? __('site.hero.stats.pricing_num') }}
                                </div>
                                <div class="text-[10px] sm:text-[11px] text-stone-500 font-medium tracking-wide mt-1 uppercase leading-snug">
                                    {{ $settings['stat_2_label'] ?? __('site.hero.stats.pricing_label') }}
                                </div>
                            </div>
                            <div>
                                <div class="font-serif text-2xl sm:text-3xl font-bold text-stone-900">
                                    {{ $settings['stat_3_number'] ?? __('site.hero.stats.qc_num') }}
                                </div>
                                <div class="text-[10px] sm:text-[11px] text-stone-500 font-medium tracking-wide mt-1 uppercase leading-snug">
                                    {{ $settings['stat_3_label'] ?? __('site.hero.stats.qc_label') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Hero Image -->
                    <div class="lg:col-span-6">
                        <div class="relative bg-stone-100 overflow-hidden shadow-sm">
                            <img 
                                src="{{ !empty($settings['hero_image']) ? (str_starts_with($settings['hero_image'], 'http') ? $settings['hero_image'] : asset('storage/' . $settings['hero_image'])) : 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=80' }}" 
                                alt="Master woodcarver shaping seasoned plantation teak in traditional Indonesian workshop" 
                                class="w-full h-auto aspect-4/5 object-cover object-center"
                                width="640" 
                                height="800"
                                fetchpriority="high"
                            >
                        </div>
                        <p class="mt-3 text-xs text-stone-500 font-serif italic text-left">
                            {{ (!empty($settings['hero_image_caption']) && $settings['hero_image_caption'] !== 'Master woodcarver shaping seasoned plantation teak in our partner workshop.') ? $settings['hero_image_caption'] : __('site.hero.image_caption') }}
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- 2. About Us / Why Work With Us Section (#about) -->
        <section id="about" class="py-16 md:py-24 border-b border-stone-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">

                <div class="max-w-2xl mb-12">
                    <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                        {{ __('site.about.eyebrow') }}
                    </span>
                    <h2 class="font-poppins text-3xl sm:text-4xl text-stone-900 font-semibold tracking-tight mb-3">
                        {{ __('site.about.title') }}
                    </h2>
                    <p class="text-stone-600 text-sm md:text-base font-light leading-relaxed">
                        {{ __('site.about.subtitle') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
                    @foreach($services as $index => $service)
                        @php
                            $isIndonesian = app()->getLocale() === 'id';
                            $title = $service->title;
                            $desc = $service->description;

                            $defaultPillars = [
                                'Handpicked Workshops' => 1,
                                'Rigorous Inspection Protocol' => 2,
                                'Fluent, Fast Communication' => 3,
                                'Full Container Consolidation' => 4,
                            ];

                            if ($isIndonesian && isset($defaultPillars[$service->title])) {
                                $pNum = $defaultPillars[$service->title];
                                $transTitle = __("site.about.pillars.$pNum.title");
                                $transDesc = __("site.about.pillars.$pNum.description");
                                if ($transTitle !== "site.about.pillars.$pNum.title") {
                                    $title = $transTitle;
                                }
                                if ($transDesc !== "site.about.pillars.$pNum.description") {
                                    $desc = $transDesc;
                                }
                            }

                            $icon = $service->icon;
                        @endphp
                        <div class="pt-5 border-t border-stone-300 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="font-poppins text-2xl sm:text-3xl text-amber-800 font-bold tracking-tight">0{{ $index + 1 }}</span>
                                    @if($icon)
                                        <div class="text-stone-400">
                                            @if(str_contains($icon, 'shield'))
                                                <svg class="w-5 h-5 text-amber-800/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                            @elseif(str_contains($icon, 'check') || str_contains($icon, 'badge'))
                                                <svg class="w-5 h-5 text-amber-800/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                                            @elseif(str_contains($icon, 'chat') || str_contains($icon, 'communication'))
                                                <svg class="w-5 h-5 text-amber-800/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-.642 0-1.272-.033-1.894-.096A48.51 48.51 0 016.75 16.5m10.5-8.989A48.243 48.243 0 0012 7.5a48.27 48.27 0 00-5.25.289c-1.133.093-1.98 1.057-1.98 2.193v4.286c0 .97.616 1.813 1.5 2.097m10.5-8.989l-.001.002M12 7.5v-3.75a2.25 2.25 0 00-2.25-2.25H4.5A2.25 2.25 0 002.25 3.75v10.5a2.25 2.25 0 002.25 2.25h1.5"/></svg>
                                            @elseif(str_contains($icon, 'truck') || str_contains($icon, 'shipping') || str_contains($icon, 'container'))
                                                <svg class="w-5 h-5 text-amber-800/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25V18.75m0-11.25H3.375c-.621 0-1.125.504-1.125 1.125v6.75c0 .621.504 1.125 1.125 1.125h1.5"/></svg>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <h3 class="font-poppins text-lg sm:text-xl text-stone-900 font-semibold tracking-tight mb-1.5">{{ $title }}</h3>
                                <p class="text-stone-600 text-sm leading-relaxed font-light">{{ $desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- 3. Product Categories Section (#categories) -->
        <section id="categories" class="py-16 md:py-24 border-b border-stone-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 pb-6 border-b border-stone-200 gap-6">
                    <div>
                        <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                            {{ __('site.categories.eyebrow') }}
                        </span>
                        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal">
                            {{ __('site.categories.title') }}
                        </h2>
                    </div>
                    <p class="text-stone-600 text-sm md:text-base max-w-md font-light leading-relaxed">
                        {{ __('site.categories.subtitle') }}
                    </p>
                </div>

                <!-- 4-Column Categories Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($categories as $index => $category)
                        @php
                            $catName = __("site.categories.items.{$category->slug}.name");
                            if ($catName === "site.categories.items.{$category->slug}.name") {
                                $catName = $category->name;
                            }
                            $catDesc = __("site.categories.items.{$category->slug}.description");
                            if ($catDesc === "site.categories.items.{$category->slug}.description") {
                                $catDesc = $category->description;
                            }
                        @endphp
                        <article class="group flex flex-col justify-between">
                            <div>
                                <!-- Image Container -->
                                <div class="overflow-hidden bg-stone-100 aspect-3/4 mb-5">
                                    <img 
                                        src="{{ $category->cover_image }}" 
                                        alt="{{ $catName }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                        width="400" 
                                        height="533" 
                                        loading="lazy"
                                    >
                                </div>

                                <!-- Index & Slug -->
                                <span class="text-[10px] font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                                    {{ __('site.categories.category_badge', ['num' => $index + 1]) }}
                                </span>

                                <!-- Title -->
                                <h3 class="font-serif text-xl text-stone-900 mb-2 font-medium">
                                    {{ $catName }}
                                </h3>

                                <!-- Description -->
                                <p class="text-stone-600 text-xs leading-relaxed font-light mb-4">
                                    {{ $catDesc }}
                                </p>
                            </div>

                            <!-- Link Action -->
                            <div class="pt-3 border-t border-stone-200">
                                <a href="{{ route('categories.show', $category->slug) }}" class="inline-flex items-center text-xs font-medium tracking-[0.15em] uppercase text-stone-900 hover:text-stone-600 transition-colors">
                                    <span>{{ __('site.categories.btn_view') }}</span>
                                    <span class="ml-1 text-sm font-sans" aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- 4. How It Works Section (#how-it-works) -->
        <section id="how-it-works" class="py-16 md:py-24 border-b border-stone-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                
                <!-- Section Header -->
                <div class="max-w-2xl mb-12">
                    <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                        {{ __('site.how_it_works.eyebrow') }}
                    </span>
                    <h2 class="font-poppins text-3xl sm:text-4xl text-stone-900 font-semibold tracking-tight mb-3">
                        {{ __('site.how_it_works.title') }}
                    </h2>
                    <p class="text-stone-600 text-sm md:text-base font-light leading-relaxed">
                        {{ __('site.how_it_works.subtitle') }}
                    </p>
                </div>

                <ol class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
                    @foreach($steps as $index => $step)
                        @php
                            $key = 'site.how_it_works.steps.' . ($index + 1);
                            $stepTitle = __("$key.title");
                            if ($stepTitle === "$key.title") { $stepTitle = $step->title; }
                            $stepDesc = __("$key.description");
                            if ($stepDesc === "$key.description") { $stepDesc = $step->description; }
                        @endphp
                        <li class="pt-5 border-t border-stone-300">
                            <span class="font-poppins text-2xl sm:text-3xl text-amber-800 font-bold tracking-tight">0{{ $index + 1 }}</span>
                            <h3 class="font-poppins text-lg sm:text-xl text-stone-900 font-semibold tracking-tight mt-2 mb-1.5">{{ $stepTitle }}</h3>
                            <p class="text-stone-600 text-sm leading-relaxed font-light">{{ $stepDesc }}</p>
                        </li>
                    @endforeach
                </ol>

            </div>
        </section>

        <!-- 5. Mid Callout Banner -->
        <section class="py-14 bg-[#EDE6DC] border-b border-stone-200">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                    <div class="max-w-2xl">
                        <span class="text-xs font-semibold tracking-[0.22em] text-stone-600 uppercase block mb-2">
                            {{ __('site.banner.eyebrow') }}
                        </span>
                        <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl text-stone-950 font-normal mb-3">
                            {{ __('site.banner.title') }}
                        </h2>
                        <p class="text-stone-700 text-sm sm:text-base font-light leading-relaxed">
                            {{ __('site.banner.subtitle') }}
                        </p>
                    </div>

                    <div class="shrink-0 w-full lg:w-auto">
                        <a href="#contact" class="inline-flex items-center justify-center w-full lg:w-auto px-8 py-4 bg-stone-900 text-stone-50 text-xs font-medium uppercase tracking-[0.18em] hover:bg-stone-800 transition-colors shadow-sm text-center">
                            {{ __('site.banner.btn') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Where to Stay & Where to Eat (#stay-eat) -->
        <section id="stay-eat" class="py-16 md:py-24 border-b border-stone-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                
                <!-- Section Header -->
                <div class="max-w-xl mb-12">
                    <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                        {{ __('site.stay_eat.eyebrow') }}
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal mb-2">
                        {{ __('site.stay_eat.title') }}
                    </h2>
                    <p class="text-stone-600 text-sm font-light">
                        {{ __('site.stay_eat.subtitle') }}
                    </p>
                </div>

                <!-- 2 Simple Clean Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                    @foreach($partners as $partner)
                        @php
                            $partnerName = __("site.stay_eat.items.{$partner->slug}.name");
                            if ($partnerName === "site.stay_eat.items.{$partner->slug}.name") {
                                $partnerName = $partner->name;
                            }
                            $partnerDesc = __("site.stay_eat.items.{$partner->slug}.description");
                            if ($partnerDesc === "site.stay_eat.items.{$partner->slug}.description") {
                                $partnerDesc = $partner->description;
                            }
                            $typeLabel = $partner->type === 'stay' ? __('site.stay_eat.badge_stay') : __('site.stay_eat.badge_eat');
                        @endphp
                        <article class="group bg-white border border-stone-200/70 p-6 flex flex-col justify-between">
                            <div>
                                <!-- Image Container -->
                                <div class="overflow-hidden bg-stone-100 aspect-16/10 mb-5">
                                    <img 
                                        src="{{ str_starts_with($partner->cover_image ?? '', 'http') ? $partner->cover_image : asset('storage/' . ($partner->cover_image ?? '')) }}" 
                                        alt="{{ $partnerName }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                        width="600" 
                                        height="375" 
                                        loading="lazy"
                                    >
                                </div>

                                <!-- Label: Where to Stay / Where to Eat -->
                                <div class="text-[11px] font-semibold tracking-[0.18em] text-stone-500 uppercase mb-2">
                                    {{ $typeLabel }} &middot; {{ $partner->area }}
                                </div>

                                <!-- Partner Title -->
                                <h3 class="font-serif text-2xl text-stone-900 mb-2 font-medium">
                                    {{ $partnerName }}
                                </h3>

                                <!-- Description -->
                                <p class="text-stone-600 text-xs sm:text-sm leading-relaxed font-light mb-4">
                                    {{ $partnerDesc }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-stone-100 flex items-center justify-between text-xs">
                                <span class="text-stone-400 font-light">{{ $partner->price_range ?? '$$' }}</span>
                                <a href="{{ route('stay-eat') }}" class="inline-flex items-center font-medium tracking-[0.12em] uppercase text-stone-900 hover:text-stone-600 transition-colors">
                                    <span>{{ __('site.stay_eat.btn_learn_more') }}</span>
                                    <span class="ml-1 text-sm font-sans" aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- View All Link -->
                <div class="mt-12 text-center">
                    <a href="{{ route('stay-eat') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-stone-800 text-stone-900 text-xs font-semibold uppercase tracking-[0.18em] hover:bg-stone-900 hover:text-white transition-colors">
                        {{ __('site.stay_eat.view_all') }} &rarr;
                    </a>
                </div>

            </div>
        </section>

        <!-- 7. Contact Us & Request a Quote Form (#contact) -->
        <section id="contact" class="py-16 md:py-24 bg-[#FAF7F2] border-b border-stone-200">
            <div class="max-w-4xl mx-auto px-6 lg:px-12">
                
                <div class="text-center mb-12">
                    <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                        {{ __('site.contact.eyebrow') }}
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal mb-3">
                        {{ __('site.contact.title') }}
                    </h2>
                    <p class="text-stone-600 text-sm sm:text-base font-light max-w-xl mx-auto">
                        {{ __('site.contact.subtitle') }}
                    </p>
                </div>

                <form action="{{ route('rfq.submit') }}" method="POST" class="bg-white p-5 sm:p-8 md:p-10 border border-stone-200 shadow-sm space-y-6">
                    @csrf

                    @if ($errors->any())
                        <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs">
                            <p class="font-medium mb-1">Please correct the highlighted fields:</p>
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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
                            rows="4" 
                            required 
                            placeholder="{{ __('site.contact.description_placeholder') }}"
                            class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                        >{{ old('description') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="w-full py-4 bg-stone-900 text-stone-50 text-xs font-medium uppercase tracking-[0.18em] hover:bg-stone-800 transition-colors shadow-sm">
                            {{ __('site.contact.btn_submit') }}
                        </button>
                    </div>
                </form>

            </div>
        </section>

        <!-- 8. Dark Bottom CTA -->
        <section class="py-20 md:py-28 bg-[#181614] text-stone-100 border-t border-stone-900">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <span class="text-xs font-semibold tracking-[0.22em] text-stone-400 uppercase block mb-3">
                    {{ __('site.bottom_cta.eyebrow') }}
                </span>
                
                <h2 class="font-serif text-3xl sm:text-5xl lg:text-6xl text-white font-normal mb-6">
                    {{ __('site.bottom_cta.title') }}
                </h2>

                <p class="text-stone-300 text-sm sm:text-base md:text-lg font-light leading-relaxed max-w-2xl mx-auto mb-10">
                    {{ __('site.bottom_cta.subtitle') }}
                </p>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4">
                    <a href="#contact" class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-4 bg-white text-stone-900 text-xs font-medium uppercase tracking-[0.18em] hover:bg-stone-100 transition-colors text-center">
                        {{ __('site.bottom_cta.btn_quote') }}
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-4 border border-stone-600 text-stone-200 text-xs font-medium uppercase tracking-[0.18em] hover:border-white hover:text-white transition-colors text-center">
                        {{ __('site.bottom_cta.btn_whatsapp') }}
                    </a>
                </div>
            </div>
        </section>

@endsection
