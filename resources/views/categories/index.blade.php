@extends('layouts.site')

@section('title', __('site.categories_page.title') . ' | ' . ($settings['site_name'] ?? 'Bali Easy Sourcing'))
@section('meta_description', __('site.categories_page.subtitle'))

@section('content')

    <!-- 1. Header Hero Banner -->
    <section class="py-16 md:py-24 border-b border-stone-200/80 bg-[#F4EFEA]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <div class="max-w-3xl">
                <span class="text-xs font-semibold tracking-[0.25em] text-stone-500 uppercase block mb-3">
                    {{ __('site.categories_page.overview_eyebrow') }}
                </span>
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-stone-900 font-normal leading-[1.15] mb-5">
                    {{ __('site.categories_page.title') }}
                </h1>
                <p class="text-stone-600 text-base md:text-lg font-light leading-relaxed">
                    {{ __('site.categories_page.subtitle') }}
                </p>
            </div>

        </div>
    </section>

    <!-- 2. Categories In-Depth List -->
    <section class="py-20 md:py-28 border-b border-stone-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 space-y-24">
            
            @foreach($categories as $index => $cat)
                @php
                    $catName = __("site.categories.items.{$cat->slug}.name");
                    if ($catName === "site.categories.items.{$cat->slug}.name") {
                        $catName = $cat->name;
                    }
                    $catDesc = __("site.categories.items.{$cat->slug}.description");
                    if ($catDesc === "site.categories.items.{$cat->slug}.description") {
                        $catDesc = $cat->description;
                    }
                    $isReversed = $index % 2 !== 0;
                @endphp

                <article id="{{ $cat->slug }}" class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center pt-10 border-t border-stone-200 first:pt-0 first:border-t-0">
                    
                    <!-- Image Column -->
                    <div class="lg:col-span-6 {{ $isReversed ? 'lg:order-2' : '' }}">
                        <div class="aspect-4/3 overflow-hidden bg-stone-200 border border-stone-300/80 shadow-sm relative group">
                            <img 
                                src="{{ str_starts_with($cat->cover_image ?? '', 'http') ? $cat->cover_image : asset('storage/' . ($cat->cover_image ?? '')) }}" 
                                alt="{{ $catName }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                loading="lazy"
                            >
                            <span class="absolute top-4 left-4 bg-stone-900/90 text-amber-200 text-[10px] font-semibold tracking-widest uppercase px-3 py-1">
                                0{{ $index + 1 }} · {{ strtoupper($cat->slug) }}
                            </span>
                        </div>
                    </div>

                    <!-- Details Column -->
                    <div class="lg:col-span-6 space-y-6 {{ $isReversed ? 'lg:order-1' : '' }}">
                        <div>
                            <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                                {{ __('site.categories.category_badge', ['num' => $index + 1]) }}
                            </span>
                            <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal mb-4">
                                {{ $catName }}
                            </h2>
                            <p class="text-stone-600 text-sm md:text-base leading-relaxed font-light">
                                {{ $catDesc }}
                            </p>
                        </div>

                        <!-- Highlights Specs -->
                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-stone-200 text-xs">
                            <div>
                                <span class="text-stone-400 uppercase tracking-wider block font-semibold text-[10px]">{{ __('site.categories_page.moq_label') }}</span>
                                <span class="font-serif text-stone-900 text-base">5 - 10 pcs</span>
                            </div>
                            <div>
                                <span class="text-stone-400 uppercase tracking-wider block font-semibold text-[10px]">{{ __('site.categories_page.lead_time') }}</span>
                                <span class="font-serif text-stone-900 text-base">{{ __('site.categories_page.lead_time_val') }}</span>
                            </div>
                        </div>

                        <!-- Sub-categories / Child Collections -->
                        @if($cat->children && $cat->children->isNotEmpty())
                            <div class="pt-3 border-t border-stone-200">
                                <span class="text-[10px] uppercase font-semibold text-stone-400 block mb-2 tracking-wider">Sub-kategori Turunan:</span>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($cat->children as $child)
                                        <a href="{{ route('categories.show', $child->slug) }}" class="inline-flex items-center gap-1.5 px-3 py-1 bg-stone-100 hover:bg-stone-200 text-stone-800 text-xs font-medium border border-stone-200 transition-colors">
                                            <span>{{ $child->name }}</span>
                                            <span class="text-stone-400" aria-hidden="true">&rarr;</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="pt-4 flex flex-wrap items-center gap-4">
                            <a href="{{ route('categories.show', $cat->slug) }}" class="inline-flex items-center justify-center px-6 py-3 bg-stone-900 text-stone-50 text-xs font-semibold uppercase tracking-[0.16em] hover:bg-stone-800 transition-colors">
                                {{ __('site.categories.btn_view') }} &rarr;
                            </a>
                            <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center px-6 py-3 border border-stone-300 text-stone-800 text-xs font-semibold uppercase tracking-[0.16em] hover:border-stone-900 transition-colors">
                                {{ __('site.categories_page.inquire_btn') }}
                            </a>
                        </div>
                    </div>

                </article>
            @endforeach

        </div>
    </section>

    <!-- 3. Bottom Sourcing CTA -->
    <section class="py-20 md:py-24 bg-stone-900 text-stone-100">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <span class="text-xs font-semibold tracking-[0.25em] text-amber-300 uppercase block mb-3">
                BESPOKE SOURCING
            </span>
            <h2 class="font-serif text-3xl sm:text-5xl text-white font-normal mb-5 leading-tight">
                Looking for a material not listed here?
            </h2>
            <p class="text-stone-300 text-sm md:text-base font-light leading-relaxed mb-8">
                {{ __('site.categories_page.rfq_hint') }}
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center px-8 py-3.5 bg-white text-stone-900 text-xs font-semibold uppercase tracking-[0.18em] hover:bg-stone-100 transition-colors">
                    {{ __('site.categories_page.custom_btn') }}
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-8 py-3.5 border border-stone-700 text-stone-200 text-xs font-semibold uppercase tracking-[0.18em] hover:border-white hover:text-white transition-colors">
                    {{ __('site.bottom_cta.btn_whatsapp') }}
                </a>
            </div>
        </div>
    </section>

@endsection

