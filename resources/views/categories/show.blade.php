@extends('layouts.site')

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

@section('title', $catName . ' | ' . ($settings['site_name'] ?? 'Bali Easy Sourcing'))
@section('meta_description', $catDesc)

@section('content')

    <!-- 1. Header Banner -->
    <section class="py-16 md:py-24 border-b border-stone-200/80 bg-[#F4EFEA]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <a href="{{ route('categories.index') }}" class="inline-flex items-center text-xs font-semibold tracking-widest uppercase text-stone-500 hover:text-stone-900 transition-colors mb-6">
                &larr; {{ __('site.categories_page.back_to_catalog') }}
            </a>

            <div class="max-w-3xl">
                <span class="text-xs font-semibold tracking-[0.25em] text-stone-500 uppercase block mb-3">
                    {{ __('site.categories.eyebrow') }}
                </span>
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-stone-900 font-normal leading-[1.15] mb-5">
                    {{ $catName }}
                </h1>
                <p class="text-stone-600 text-base md:text-lg font-light leading-relaxed">
                    {{ $catDesc }}
                </p>
            </div>

        </div>
    </section>

    <!-- 2. Products Grid in this Category -->
    <section class="py-16 md:py-24 border-b border-stone-200/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <div class="flex items-center justify-between mb-10 pb-4 border-b border-stone-200">
                <h2 class="font-serif text-2xl sm:text-3xl text-stone-900 font-normal">
                    {{ __('site.categories_page.available_products') }}
                </h2>
                <span class="text-xs text-stone-500 font-medium">
                    {{ $products->count() }} {{ $products->count() > 1 ? 'items' : 'item' }}
                </span>
            </div>

            @if($products->isEmpty())
                <div class="p-12 text-center bg-stone-100 border border-dashed border-stone-300">
                    <p class="text-stone-600 text-sm font-light mb-4">
                        Custom workshop catalogs are curated per project inquiry.
                    </p>
                    <a href="{{ route('home') }}#contact" class="inline-flex items-center px-6 py-2.5 bg-stone-900 text-white text-xs font-medium uppercase tracking-wider">
                        Request Sourcing Catalog
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($products as $prod)
                        <article class="bg-[#FAF8F5] border border-stone-200 flex flex-col justify-between group">
                            <div>
                                <div class="aspect-4/3 overflow-hidden bg-stone-100">
                                    <img 
                                        src="{{ $prod->cover_image ?? $category->cover_image }}" 
                                        alt="{{ $prod->name }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="p-6">
                                    <h3 class="font-serif text-2xl text-stone-900 font-medium mb-2">
                                        {{ $prod->name }}
                                    </h3>
                                    <p class="text-stone-600 text-xs sm:text-sm leading-relaxed font-light mb-4">
                                        {{ $prod->short_description ?? $prod->description }}
                                    </p>

                                    <div class="space-y-1.5 pt-3 border-t border-stone-200 text-xs text-stone-600 font-light">
                                        @if($prod->material)
                                            <div><strong class="text-stone-900 font-medium">Material:</strong> {{ $prod->material }}</div>
                                        @endif
                                        @if($prod->dimensions)
                                            <div><strong class="text-stone-900 font-medium">Dimensions:</strong> {{ $prod->dimensions }}</div>
                                        @endif
                                        @if($prod->moq)
                                            <div><strong class="text-stone-900 font-medium">MOQ:</strong> {{ $prod->moq }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 pt-0">
                                <a href="{{ route('home') }}#contact" class="block w-full text-center py-2.5 bg-stone-900 text-white text-xs font-medium uppercase tracking-[0.15em] hover:bg-stone-800 transition-colors">
                                    Inquire on this item
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    <!-- 3. Other Categories Navigation Strip -->
    <section class="py-14 bg-[#F2ECE3] border-b border-stone-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <h3 class="font-serif text-xl text-stone-900 mb-6 font-medium">
                Explore Other Categories
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($otherCategories as $other)
                    @php
                        $otherName = __("site.categories.items.{$other->slug}.name");
                        if ($otherName === "site.categories.items.{$other->slug}.name") {
                            $otherName = $other->name;
                        }
                    @endphp
                    <a href="{{ route('categories.show', $other->slug) }}" class="flex items-center gap-4 p-4 bg-white border border-stone-200 hover:border-stone-900 transition-colors group">
                        <img src="{{ $other->cover_image }}" alt="{{ $otherName }}" class="w-14 h-14 object-cover shrink-0">
                        <div>
                            <div class="font-serif text-base text-stone-900 group-hover:text-amber-800 transition-colors font-medium">{{ $otherName }}</div>
                            <span class="text-[10px] uppercase tracking-wider text-stone-500">View Category &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

@endsection

