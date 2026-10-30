@extends('layouts.site')

@section('title', __('site.about_page.breadcrumb') . ' | ' . ($settings['site_name'] ?? 'Bali Easy Sourcing'))
@section('meta_description', __('site.about_page.hero_subtitle'))

@section('content')

    <!-- 1. Page Hero / Header Banner -->
    <section class="py-16 md:py-24 border-b border-stone-200/80 bg-[#F4EFEA]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold tracking-widest uppercase text-stone-500 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-stone-900 transition-colors">{{ __('site.nav.home') }}</a>
                <span class="text-stone-400">/</span>
                <span class="text-stone-900">{{ __('site.about_page.breadcrumb') }}</span>
            </nav>

            <div class="max-w-3xl">
                <span class="text-xs font-semibold tracking-[0.25em] text-stone-500 uppercase block mb-3">
                    {{ __('site.about_page.hero_eyebrow') }}
                </span>
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-stone-900 font-normal leading-[1.15] mb-6">
                    {{ __('site.about_page.hero_title') }}
                </h1>
                <p class="text-stone-600 text-base md:text-lg font-light leading-relaxed">
                    {{ __('site.about_page.hero_subtitle') }}
                </p>
            </div>

        </div>
    </section>

    <!-- 2. The Story & Ground Reality Section -->
    <section class="py-20 md:py-28 border-b border-stone-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Left Narrative Column -->
                <div class="lg:col-span-6 space-y-6">
                    <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block">
                        {{ __('site.about_page.story_badge') }}
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal leading-snug">
                        {{ __('site.about_page.story_title') }}
                    </h2>
                    <p class="text-stone-600 text-sm md:text-base leading-relaxed font-light">
                        {{ __('site.about_page.story_p1') }}
                    </p>
                    <p class="text-stone-600 text-sm md:text-base leading-relaxed font-light">
                        {{ __('site.about_page.story_p2') }}
                    </p>

                    <!-- Quote Highlight Box -->
                    <div class="bg-[#F2ECE3] p-6 border-l-2 border-stone-900 mt-6">
                        <p class="font-serif italic text-lg text-stone-900 mb-2">
                            "{{ __('site.about.subtitle') }}"
                        </p>
                        <span class="text-xs font-sans tracking-wider uppercase text-stone-600 font-medium">
                            &mdash; {{ $settings['site_name'] ?? 'Bali Easy Sourcing' }} Principles
                        </span>
                    </div>
                </div>

                <!-- Right Visual Side -->
                <div class="lg:col-span-6 relative">
                    <div class="aspect-4/5 overflow-hidden bg-stone-200 shadow-sm border border-stone-300/80">
                        <img 
                            src="https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=80" 
                            alt="Balinese artisan handcrafted woodwork inspection" 
                            class="w-full h-full object-cover"
                            loading="lazy"
                        >
                    </div>
                    <!-- Overlapping Accent Label -->
                    <div class="absolute -bottom-6 -left-6 bg-stone-900 text-stone-100 p-6 hidden sm:block max-w-xs shadow-lg">
                        <div class="text-[10px] tracking-[0.2em] uppercase text-amber-300 font-semibold mb-1">
                            HEADQUARTERS
                        </div>
                        <div class="font-serif text-base text-white">
                            Canggu & Gianyar, Bali
                        </div>
                        <div class="text-xs text-stone-400 font-light mt-1">
                            Daily workshop visits and direct factory floor monitoring.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. Key Operational Numbers / Impact Metrics -->
    <section class="py-14 bg-stone-900 text-stone-100 border-b border-stone-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 text-center md:text-left">
                
                <div class="border-l-2 border-amber-400/50 pl-5">
                    <div class="font-serif text-4xl sm:text-5xl text-white font-normal mb-1">
                        {{ __('site.about_page.stats.artisans') }}
                    </div>
                    <div class="text-xs tracking-wider uppercase text-stone-400 font-medium">
                        {{ __('site.about_page.stats.artisans_label') }}
                    </div>
                </div>

                <div class="border-l-2 border-amber-400/50 pl-5">
                    <div class="font-serif text-4xl sm:text-5xl text-white font-normal mb-1">
                        {{ __('site.about_page.stats.inspection') }}
                    </div>
                    <div class="text-xs tracking-wider uppercase text-stone-400 font-medium">
                        {{ __('site.about_page.stats.inspection_label') }}
                    </div>
                </div>

                <div class="border-l-2 border-amber-400/50 pl-5">
                    <div class="font-serif text-4xl sm:text-5xl text-white font-normal mb-1">
                        {{ __('site.about_page.stats.countries') }}
                    </div>
                    <div class="text-xs tracking-wider uppercase text-stone-400 font-medium">
                        {{ __('site.about_page.stats.countries_label') }}
                    </div>
                </div>

                <div class="border-l-2 border-amber-400/50 pl-5">
                    <div class="font-serif text-4xl sm:text-5xl text-white font-normal mb-1">
                        {{ __('site.about_page.stats.turnaround') }}
                    </div>
                    <div class="text-xs tracking-wider uppercase text-stone-400 font-medium">
                        {{ __('site.about_page.stats.turnaround_label') }}
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. Core Guiding Principles (4 Pillars) -->
    <section class="py-20 md:py-28 border-b border-stone-200/80 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <div class="max-w-2xl mb-14">
                <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                    {{ __('site.about_page.pillars_badge') }}
                </span>
                <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal mb-3">
                    {{ __('site.about_page.pillars_title') }}
                </h2>
                <p class="text-stone-600 text-sm md:text-base font-light leading-relaxed">
                    {{ __('site.about_page.process_desc') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @for($i = 1; $i <= 4; $i++)
                    <div class="pt-6 border-t-2 border-stone-900 flex flex-col justify-between">
                        <div>
                            <span class="font-serif text-3xl text-stone-400 font-light block mb-3">
                                0{{ $i }}
                            </span>
                            <h3 class="font-serif text-xl text-stone-900 font-medium mb-3">
                                {{ __("site.about_page.pillars.$i.title") }}
                            </h3>
                            <p class="text-stone-600 text-xs sm:text-sm leading-relaxed font-light">
                                {{ __("site.about_page.pillars.$i.desc") }}
                            </p>
                        </div>
                    </div>
                @endfor
            </div>

        </div>
    </section>

    <!-- 5. Material & Workshop Gallery Mosaic -->
    <section class="py-16 md:py-20 border-b border-stone-200/80 bg-[#F4EFEA]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                        ARCHIVES
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl text-stone-900 font-normal">
                        Materials, Workshops, and Finished Collections
                    </h2>
                </div>
                <a href="{{ route('home') }}#categories" class="text-xs font-semibold tracking-[0.16em] uppercase text-stone-900 hover:text-stone-600 transition-colors">
                    Explore Categories &rarr;
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="aspect-square overflow-hidden bg-stone-200">
                    <img 
                        src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=800&q=80" 
                        alt="Teak dining table craft" 
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                        loading="lazy"
                    >
                </div>
                <div class="aspect-square overflow-hidden bg-stone-200">
                    <img 
                        src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80" 
                        alt="Rattan pendant lighting" 
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                        loading="lazy"
                    >
                </div>
                <div class="aspect-square overflow-hidden bg-stone-200">
                    <img 
                        src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80" 
                        alt="Hand-carved stone bathtub" 
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                        loading="lazy"
                    >
                </div>
                <div class="aspect-square overflow-hidden bg-stone-200">
                    <img 
                        src="https://images.unsplash.com/photo-1606744824163-985d376605aa?auto=format&fit=crop&w=800&q=80" 
                        alt="Artisanal ceramics and tableware" 
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                        loading="lazy"
                    >
                </div>
            </div>

        </div>
    </section>

    <!-- 6. Bottom Call to Action -->
    <section class="py-20 md:py-24 bg-stone-900 text-stone-100">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <span class="text-xs font-semibold tracking-[0.25em] text-amber-300 uppercase block mb-3">
                LET'S COLLABORATE
            </span>
            <h2 class="font-serif text-3xl sm:text-5xl text-white font-normal mb-5 leading-tight">
                {{ __('site.about_page.cta_title') }}
            </h2>
            <p class="text-stone-300 text-sm md:text-base font-light leading-relaxed mb-8">
                {{ __('site.about_page.cta_desc') }}
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center px-8 py-3.5 bg-white text-stone-900 text-xs font-semibold uppercase tracking-[0.18em] hover:bg-stone-100 transition-colors">
                    {{ __('site.about_page.cta_btn') }}
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-8 py-3.5 border border-stone-700 text-stone-200 text-xs font-semibold uppercase tracking-[0.18em] hover:border-white hover:text-white transition-colors">
                    {{ __('site.bottom_cta.btn_whatsapp') }}
                </a>
            </div>
        </div>
    </section>

@endsection
