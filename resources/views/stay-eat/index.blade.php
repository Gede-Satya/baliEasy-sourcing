@extends('layouts.site')

@section('title', __('site.stay_eat_page.title') . ' | ' . ($settings['site_name'] ?? 'Bali Easy Sourcing'))

@section('content')

    <!-- Header Section -->
    <section class="py-16 md:py-24 border-b border-stone-200/80 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="max-w-3xl">
                <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-3">
                    {{ __('site.stay_eat_page.eyebrow') }}
                </span>
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-stone-900 leading-[1.15] mb-6 font-normal">
                    {{ __('site.stay_eat_page.title') }}
                </h1>
                <p class="text-stone-600 text-base md:text-lg leading-relaxed font-light">
                    {{ __('site.stay_eat_page.subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Filter & Catalog Section -->
    <section class="py-12 md:py-20 border-b border-stone-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">

            <!-- Filter Controls -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 pb-8 border-b border-stone-200 mb-12">
                <!-- Type Filter Tabs -->
                <div class="inline-flex items-center gap-2 p-1 bg-stone-100 rounded border border-stone-200 text-xs">
                    <a href="{{ route('stay-eat') }}" class="px-4 py-2 font-medium uppercase tracking-wider transition-all {{ empty($type) ? 'bg-stone-900 text-white shadow-sm' : 'text-stone-600 hover:text-stone-900' }}">
                        {{ __('site.stay_eat_page.filter_all') }} ({{ count($stays) + count($eats) }})
                    </a>
                    <a href="{{ route('stay-eat', ['type' => 'stay', 'area' => $area]) }}" class="px-4 py-2 font-medium uppercase tracking-wider transition-all {{ $type === 'stay' ? 'bg-stone-900 text-white shadow-sm' : 'text-stone-600 hover:text-stone-900' }}">
                        🏨 {{ __('site.stay_eat_page.filter_stay') }} ({{ count($stays) }})
                    </a>
                    <a href="{{ route('stay-eat', ['type' => 'eat', 'area' => $area]) }}" class="px-4 py-2 font-medium uppercase tracking-wider transition-all {{ $type === 'eat' ? 'bg-stone-900 text-white shadow-sm' : 'text-stone-600 hover:text-stone-900' }}">
                        🍽️ {{ __('site.stay_eat_page.filter_eat') }} ({{ count($eats) }})
                    </a>
                </div>

                <!-- Area Quick Filters -->
                <div class="flex items-center gap-2 text-xs text-stone-500 font-light flex-wrap">
                    <span class="uppercase tracking-wider text-[11px] font-semibold text-stone-400 mr-1">Area:</span>
                    <a href="{{ route('stay-eat', array_filter(['type' => $type])) }}" class="px-3 py-1.5 border {{ empty($area) ? 'border-stone-900 text-stone-900 font-medium bg-stone-50' : 'border-stone-200 text-stone-600 hover:border-stone-400' }} transition-colors">
                        {{ __('site.stay_eat_page.filter_area_all') }}
                    </a>
                    @foreach(['Canggu', 'Ubud', 'Seminyak'] as $loc)
                        <a href="{{ route('stay-eat', array_filter(['type' => $type, 'area' => $loc])) }}" class="px-3 py-1.5 border {{ $area === $loc ? 'border-stone-900 text-stone-900 font-medium bg-stone-50' : 'border-stone-200 text-stone-600 hover:border-stone-400' }} transition-colors">
                            {{ $loc }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Partners Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                @forelse($partners as $partner)
                    @php
                        $pName = __("site.stay_eat.items.{$partner->slug}.name");
                        if ($pName === "site.stay_eat.items.{$partner->slug}.name") {
                            $pName = $partner->name;
                        }
                        $pDesc = __("site.stay_eat.items.{$partner->slug}.description");
                        if ($pDesc === "site.stay_eat.items.{$partner->slug}.description") {
                            $pDesc = $partner->description;
                        }
                        $typeLabel = $partner->type === 'stay' ? __('site.stay_eat.badge_stay') : __('site.stay_eat.badge_eat');
                        $coverUrl = str_starts_with($partner->cover_image ?? '', 'http') ? $partner->cover_image : asset('storage/' . ($partner->cover_image ?? ''));
                    @endphp
                    <article class="bg-[#FAF8F5] border border-stone-200/80 flex flex-col justify-between group overflow-hidden transition-shadow hover:shadow-md">
                        <div>
                            <!-- Cover Image -->
                            <div class="aspect-16/10 overflow-hidden bg-stone-100 relative">
                                <img 
                                    src="{{ $coverUrl }}" 
                                    alt="{{ $pName }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                    loading="lazy"
                                >
                                <div class="absolute top-3 left-3 flex items-center gap-2">
                                    <span class="text-[10px] font-semibold uppercase tracking-widest px-2.5 py-1 {{ $partner->type === 'stay' ? 'bg-amber-900/90 text-amber-100' : 'bg-emerald-900/90 text-emerald-100' }}">
                                        {{ $typeLabel }}
                                    </span>
                                </div>
                                <span class="absolute top-3 right-3 bg-stone-900/80 text-stone-100 text-[11px] font-mono px-2 py-0.5">
                                    {{ $partner->price_range ?? '$$' }}
                                </span>
                            </div>

                            <!-- Content Details -->
                            <div class="p-6">
                                <div class="text-[11px] font-medium tracking-[0.15em] text-stone-500 uppercase mb-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-stone-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>{{ $partner->area }}</span>
                                </div>

                                <h2 class="font-serif text-2xl text-stone-900 font-medium mb-3">
                                    {{ $pName }}
                                </h2>

                                <p class="text-stone-600 text-sm leading-relaxed font-light mb-6">
                                    {{ $pDesc }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-6 py-4 border-t border-stone-200/60 bg-white flex items-center justify-between text-xs">
                            @if(!empty($partner->website_url))
                                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="font-semibold uppercase tracking-[0.14em] text-stone-900 hover:text-amber-800 transition-colors inline-flex items-center gap-1">
                                    <span>{{ __('site.stay_eat_page.visit_website') }}</span>
                                    <span aria-hidden="true">&nearr;</span>
                                </a>
                            @else
                                <span class="text-stone-400 font-light">&mdash;</span>
                            @endif

                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890') }}?text={{ urlencode('Hello Bali Easy Sourcing, I am planning a sourcing visit to Bali and would like recommendations for ' . $pName) }}" target="_blank" rel="noopener noreferrer" class="text-stone-500 hover:text-stone-900 font-medium transition-colors">
                                Ask Concierge &rarr;
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-16 text-center bg-stone-50 border border-stone-200">
                        <p class="text-stone-500 text-sm font-light">Tidak ada rekomendasi yang sesuai dengan filter.</p>
                        <a href="{{ route('stay-eat') }}" class="inline-block mt-4 text-xs font-semibold uppercase tracking-wider text-stone-900 underline">Lihat Semua Rekomendasi</a>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- Sourcing Concierge Banner -->
    <section class="py-16 md:py-24 bg-[#181614] text-stone-100">
        <div class="max-w-5xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-8">
                    <span class="text-xs font-semibold tracking-[0.22em] text-stone-400 uppercase block mb-3">
                        VIP SOURCING VISIT CONCIERGE
                    </span>
                    <h3 class="font-serif text-3xl sm:text-4xl text-white font-normal mb-4">
                        {{ __('site.stay_eat_page.concierge_title') }}
                    </h3>
                    <p class="text-stone-300 text-sm sm:text-base font-light leading-relaxed max-w-xl">
                        {{ __('site.stay_eat_page.concierge_text') }}
                    </p>
                </div>
                <div class="md:col-span-4 flex flex-col gap-3">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890') }}?text={{ urlencode('Hello Bali Easy Sourcing, I would like assistance planning an artisan workshop sourcing visit in Bali.') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-6 py-4 bg-white text-stone-900 text-xs font-medium uppercase tracking-[0.18em] hover:bg-stone-100 transition-colors shadow-sm text-center">
                        {{ __('site.stay_eat_page.concierge_btn') }}
                    </a>
                    <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center px-6 py-3.5 border border-stone-700 text-stone-300 text-xs font-medium uppercase tracking-[0.18em] hover:border-stone-400 hover:text-white transition-colors text-center">
                        {{ __('site.hero.btn_quote') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
