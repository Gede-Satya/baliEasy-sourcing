@extends('layouts.site')

@section('title', __('site.contact_page.title') . ' | ' . ($settings['site_name'] ?? 'Bali Easy Sourcing'))

@php
    $waNumber = $settings['whatsapp_number'] ?? '+62 812 3456 7890';
    $waDigits = preg_replace('/[^0-9]/', '', $waNumber);
    $waText = urlencode('Hello Bali Easy Sourcing, I would like to inquire about your sourcing and quality inspection services.');
    $email = $settings['contact_email'] ?? 'hello@balieasysourcing.com';
    $address = $settings['address'] ?? 'Jl. Pantai Batu Bolong, Canggu, Bali 80361, Indonesia';
    $inputClass = 'w-full px-4 py-3 text-sm text-stone-900 bg-stone-50 border border-stone-300 placeholder-stone-500 focus:border-stone-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-stone-900/10 transition-colors';
    $labelClass = 'block text-xs font-semibold uppercase tracking-[0.12em] text-stone-700 mb-2';
@endphp

@section('content')

    <!-- Header -->
    <section class="pt-12 pb-10 md:pt-20 md:pb-14 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="max-w-3xl">
                <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-3">
                    {{ __('site.contact_page.eyebrow') }}
                </span>
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-stone-900 leading-[1.1] mb-5 font-normal">
                    {{ __('site.contact_page.title') }}
                </h1>
                <p class="text-stone-600 text-base md:text-lg leading-relaxed font-light max-w-2xl">
                    {{ __('site.contact_page.subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Channels & Form -->
    <section class="pb-16 md:pb-24 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                <!-- Left: direct channels. Sticky on desktop so contact details stay visible while filling the long form -->
                <aside class="lg:col-span-5 lg:sticky lg:top-28 space-y-6">

                    <div class="bg-white border border-stone-200">

                        <!-- WhatsApp -->
                        <div class="p-6 sm:p-8 border-b border-stone-200">
                            <h2 class="font-serif text-2xl text-stone-900 font-normal mb-1">
                                {{ __('site.contact_page.whatsapp_direct') }}
                            </h2>
                            <p class="text-stone-600 text-sm font-light mb-5">
                                {{ __('site.contact_page.whatsapp_note') }}
                            </p>
                            <a
                                href="https://wa.me/{{ $waDigits }}?text={{ $waText }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex sm:inline-flex items-center justify-center gap-2.5 w-full sm:w-auto min-h-[48px] px-6 py-3 bg-stone-900 text-stone-50 text-sm font-medium hover:bg-stone-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-stone-900 transition-colors"
                            >
                                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.21 3.08c.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.41-.07-.12-.27-.2-.57-.35zM12.04 21.5h-.01a9.45 9.45 0 0 1-4.82-1.32l-.35-.21-3.58.94.96-3.49-.23-.36A9.43 9.43 0 0 1 2.56 12C2.56 6.78 6.8 2.54 12.04 2.54c2.53 0 4.91.99 6.7 2.78a9.4 9.4 0 0 1 2.77 6.7c0 5.23-4.25 9.48-9.47 9.48zM20.1 3.92A11.36 11.36 0 0 0 12.04.6C5.77.6.66 5.7.66 11.98c0 2.01.52 3.97 1.52 5.69L.57 23.4l5.86-1.54a11.34 11.34 0 0 0 5.6 1.43h.01c6.27 0 11.38-5.1 11.38-11.38 0-3.04-1.18-5.9-3.33-8.05z"/>
                                </svg>
                                <span>{{ $waNumber }}</span>
                            </a>
                        </div>

                        <!-- Details list -->
                        <dl class="p-6 sm:p-8 space-y-6">
                            <div class="flex gap-4">
                                <svg class="w-5 h-5 mt-0.5 shrink-0 text-stone-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                                </svg>
                                <div class="min-w-0">
                                    <dt class="text-xs font-semibold uppercase tracking-[0.12em] text-stone-500 mb-1">
                                        {{ __('site.contact_page.email_direct') }}
                                    </dt>
                                    <dd>
                                        <a href="mailto:{{ $email }}" class="text-stone-900 text-sm font-medium underline-offset-4 hover:underline break-all">
                                            {{ $email }}
                                        </a>
                                    </dd>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <svg class="w-5 h-5 mt-0.5 shrink-0 text-stone-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                </svg>
                                <div class="min-w-0">
                                    <dt class="text-xs font-semibold uppercase tracking-[0.12em] text-stone-500 mb-1">
                                        {{ __('site.contact_page.office_title') }}
                                    </dt>
                                    <dd class="text-stone-800 text-sm leading-relaxed">
                                        {{ $address }}
                                    </dd>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <svg class="w-5 h-5 mt-0.5 shrink-0 text-stone-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <div class="min-w-0">
                                    <dt class="text-xs font-semibold uppercase tracking-[0.12em] text-stone-500 mb-1">
                                        {{ __('site.contact_page.hours_title') }}
                                    </dt>
                                    <dd class="text-stone-800 text-sm">
                                        {{ __('site.contact_page.hours_value') }}
                                        <span class="block text-stone-500 text-xs mt-1">{{ __('site.contact_page.hours_note') }}</span>
                                    </dd>
                                </div>
                            </div>

                            @if(!empty($settings['instagram_url']))
                                <div class="flex gap-4">
                                    <svg class="w-5 h-5 mt-0.5 shrink-0 text-stone-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                        <rect x="3" y="3" width="18" height="18" rx="5"/>
                                        <circle cx="12" cy="12" r="4"/>
                                        <circle cx="17.5" cy="6.5" r="0.75" fill="currentColor"/>
                                    </svg>
                                    <div class="min-w-0">
                                        <dt class="text-xs font-semibold uppercase tracking-[0.12em] text-stone-500 mb-1">
                                            Instagram
                                        </dt>
                                        <dd>
                                            <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="text-stone-900 text-sm font-medium underline-offset-4 hover:underline">
                                                {{ '@' . ltrim(basename(rtrim(parse_url($settings['instagram_url'], PHP_URL_PATH) ?: 'balieasysourcing', '/')), '@') }}
                                            </a>
                                        </dd>
                                    </div>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <!-- 48-hour commitment -->
                    <div class="p-6 sm:p-8 bg-[#181614] text-stone-100">
                        <p class="font-serif text-xl text-white mb-2">
                            {{ __('site.contact_page.guarantee_title') }}
                        </p>
                        <p class="text-stone-300 text-sm font-light leading-relaxed">
                            {{ __('site.contact_page.guarantee_text') }}
                        </p>
                    </div>
                </aside>

                <!-- Right: RFQ form -->
                <div class="lg:col-span-7">
                    <div class="bg-white p-6 sm:p-10 md:p-12 border border-stone-200">

                        <div class="mb-8">
                            <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal mb-3">
                                {{ __('site.contact.title') }}
                            </h2>
                            <p class="text-stone-600 text-sm sm:text-base font-light leading-relaxed">
                                {{ __('site.contact.subtitle') }}
                            </p>
                        </div>

                        @if(session('rfq_success'))
                            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-300 text-emerald-900 text-sm" role="status">
                                <p class="font-semibold mb-0.5">{{ __('site.contact_page.success_title') }}</p>
                                <p>{{ session('rfq_success') }}</p>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-8 p-4 bg-red-50 border border-red-300 text-red-900 text-sm" role="alert">
                                <p class="font-semibold mb-1">{{ __('site.contact_page.error_title') }}</p>
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('rfq.submit') }}" method="POST" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">
                                <div>
                                    <label for="name" class="{{ $labelClass }}">
                                        {{ __('site.contact.name_label') }} <span class="text-red-700" aria-hidden="true">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                                        placeholder="{{ __('site.contact.name_placeholder') }}" class="{{ $inputClass }}">
                                </div>

                                <div>
                                    <label for="email" class="{{ $labelClass }}">
                                        {{ __('site.contact.email_label') }} <span class="text-red-700" aria-hidden="true">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="{{ __('site.contact.email_placeholder') }}" class="{{ $inputClass }}">
                                </div>

                                <div>
                                    <label for="company" class="{{ $labelClass }}">
                                        {{ __('site.contact.company_label') }}
                                    </label>
                                    <input type="text" id="company" name="company" value="{{ old('company') }}" autocomplete="organization"
                                        placeholder="{{ __('site.contact.company_placeholder') }}" class="{{ $inputClass }}">
                                </div>

                                <div>
                                    <label for="whatsapp" class="{{ $labelClass }}">
                                        {{ __('site.contact.whatsapp_label') }}
                                    </label>
                                    <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" autocomplete="tel"
                                        placeholder="{{ __('site.contact.whatsapp_placeholder') }}" class="{{ $inputClass }}">
                                </div>

                                <div>
                                    <label for="category_id" class="{{ $labelClass }}">
                                        {{ __('site.contact.category_label') }}
                                    </label>
                                    <select id="category_id" name="category_id" class="{{ $inputClass }} cursor-pointer">
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

                                <div>
                                    <label for="quantity" class="{{ $labelClass }}">
                                        {{ __('site.contact.quantity_label') }}
                                    </label>
                                    <input type="text" id="quantity" name="quantity" value="{{ old('quantity') }}"
                                        placeholder="{{ __('site.contact.quantity_placeholder') }}" class="{{ $inputClass }}">
                                </div>
                            </div>

                            <div>
                                <label for="description" class="{{ $labelClass }}">
                                    {{ __('site.contact.description_label') }} <span class="text-red-700" aria-hidden="true">*</span>
                                </label>
                                <textarea id="description" name="description" rows="5" required
                                    placeholder="{{ __('site.contact.description_placeholder') }}"
                                    class="{{ $inputClass }} resize-y min-h-[140px]">{{ old('description') }}</textarea>
                            </div>

                            <div class="pt-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <p class="text-xs text-stone-500 order-2 sm:order-1">
                                    <span class="text-red-700" aria-hidden="true">*</span> {{ __('site.contact_page.required_note') }}
                                </p>
                                <button type="submit" class="order-1 sm:order-2 w-full sm:w-auto min-h-[48px] px-8 py-3.5 bg-stone-900 text-stone-50 text-xs font-semibold uppercase tracking-[0.16em] hover:bg-stone-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-stone-900 transition-colors cursor-pointer">
                                    {{ __('site.contact.btn_submit') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
