@extends('layouts.site')

@section('title', __('site.about_page.breadcrumb') . ' | ' . ($settings['site_name'] ?? 'Bali Easy Sourcing'))
@section('meta_description', __('site.about_page.hero_subtitle'))

@section('content')

    <!-- 1. Page Hero / Header Banner -->
    <section class="py-16 md:py-24 border-b border-stone-200/80 bg-[#F4EFEA]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
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
                            {{ $settings['site_name'] ?? 'Bali Easy Sourcing' }} Principles
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
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 md:gap-12 text-left">
                
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
                <h2 class="font-poppins text-3xl sm:text-4xl text-stone-900 font-semibold tracking-tight mb-3">
                    {{ __('site.about_page.pillars_title') }}
                </h2>
                <p class="text-stone-600 text-sm md:text-base font-light leading-relaxed">
                    {{ __('site.about_page.process_desc') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($services as $index => $service)
                    @php
                        $isIndonesian = app()->getLocale() === 'id';
                        $title = $service->title;
                        $desc = $service->description;

                        $defaultTranslations = [
                            'Handpicked Workshops' => [
                                'title' => 'Workshop Terpilih',
                                'desc' => 'Kami hanya bermitra dengan pengrajin terpercaya yang mematuhi legalitas kayu (SVLK), kesejahteraan pekerja, dan ketepatan waktu pengiriman.',
                            ],
                            'Rigorous Inspection Protocol' => [
                                'title' => 'Inspeksi Mutu Ketat',
                                'desc' => 'Pengujian kadar air kayu, kekuatan konstruksi sambungan, kemasan peti standar ekspor, serta persetujuan foto resolusi tinggi.',
                            ],
                            'Fluent, Fast Communication' => [
                                'title' => 'Komunikasi Cepat & Lancar',
                                'desc' => 'Pembaruan langsung via WhatsApp dan email dalam bahasa yang jelas. Respons cepat untuk menjawab kebutuhan Anda lintas zona waktu.',
                            ],
                            'Full Container Consolidation' => [
                                'title' => 'Konsolidasi Satu Kontainer',
                                'desc' => 'Pesan dari berbagai workshop berbeda di Bali dan Jawa, disatukan rapi dalam satu kontainer dari gudang pusat kami.',
                            ],
                        ];

                        if ($isIndonesian && isset($defaultTranslations[$service->title])) {
                            $title = $defaultTranslations[$service->title]['title'];
                            if ($service->description === 'We only partner with established makers who respect legal timber laws (SVLK), artisan welfare, and delivery timelines.'
                                || $service->description === 'Wood moisture content testing, joint strength checks, drop-tested export crating, and high-resolution photo sign-offs.'
                                || $service->description === 'Direct WhatsApp and email updates in clear English. Real-time answers when you need them across all time zones.'
                                || $service->description === 'Order from ten different workshops and ship them all inside one container from our central Bali warehouse.') {
                                $desc = $defaultTranslations[$service->title]['desc'];
                            }
                        }

                        $icon = $service->icon;
                    @endphp
                    <div class="pt-6 border-t-2 border-stone-900 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-poppins text-2xl sm:text-3xl text-amber-800 font-bold tracking-tight block">
                                    0{{ $index + 1 }}
                                </span>
                                @if($icon)
                                    <div class="text-stone-400">
                                        @if(str_contains($icon, 'shield'))
                                            <svg class="w-6 h-6 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                        @elseif(str_contains($icon, 'check') || str_contains($icon, 'badge'))
                                            <svg class="w-6 h-6 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                                        @elseif(str_contains($icon, 'chat') || str_contains($icon, 'communication'))
                                            <svg class="w-6 h-6 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-.642 0-1.272-.033-1.894-.096A48.51 48.51 0 016.75 16.5m10.5-8.989A48.243 48.243 0 0012 7.5a48.27 48.27 0 00-5.25.289c-1.133.093-1.98 1.057-1.98 2.193v4.286c0 .97.616 1.813 1.5 2.097m10.5-8.989l-.001.002M12 7.5v-3.75a2.25 2.25 0 00-2.25-2.25H4.5A2.25 2.25 0 002.25 3.75v10.5a2.25 2.25 0 002.25 2.25h1.5"/></svg>
                                        @elseif(str_contains($icon, 'truck') || str_contains($icon, 'shipping') || str_contains($icon, 'container'))
                                            <svg class="w-6 h-6 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25V18.75m0-11.25H3.375c-.621 0-1.125.504-1.125 1.125v6.75c0 .621.504 1.125 1.125 1.125h1.5"/></svg>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <h3 class="font-poppins text-lg sm:text-xl text-stone-900 font-semibold tracking-tight mb-2">
                                {{ $title }}
                            </h3>
                            <p class="text-stone-600 text-xs sm:text-sm leading-relaxed font-light">
                                {{ $desc }}
                            </p>
                        </div>
                    </div>
                @empty
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
                @endforelse
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
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4">
                <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-3.5 bg-white text-stone-900 text-xs font-semibold uppercase tracking-[0.18em] hover:bg-stone-100 transition-colors text-center">
                    {{ __('site.about_page.cta_btn') }}
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-3.5 border border-stone-700 text-stone-200 text-xs font-semibold uppercase tracking-[0.18em] hover:border-white hover:text-white transition-colors text-center">
                    {{ __('site.bottom_cta.btn_whatsapp') }}
                </a>
            </div>
        </div>
    </section>

@endsection

