<?php $h = request()->routeIs('home') ? '' : route('home'); ?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ($settings['site_name'] ?? 'Bali Easy Sourcing') . ' | ' . __('site.hero.eyebrow'))</title>
    <meta name="description" content="@yield('meta_description', __('site.hero.description'))">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF8F5] text-stone-900 antialiased font-sans selection:bg-stone-900 selection:text-white">

    <!-- Top Notification Banner (if Quote submitted) -->
    @if(session('rfq_success'))
        <div id="quote-success" class="bg-stone-900 text-stone-50 px-6 py-4 text-center text-sm font-medium sticky top-0 z-50 border-b border-stone-800 flex items-center justify-center gap-3">
            <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('rfq_success') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="ml-4 text-stone-400 hover:text-white" aria-label="Close notification">✕</button>
        </div>
    @endif

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-40 bg-[#FAF8F5]/90 backdrop-blur-md border-b border-stone-200/70 transition-colors">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="group flex flex-col tracking-wider font-serif">
                <span class="text-xl md:text-2xl font-bold tracking-[0.12em] text-stone-900">{{ strtoupper($settings['site_name'] ?? 'BALI EASY') }}</span>
                <span class="text-[9px] tracking-[0.35em] font-sans font-semibold text-stone-500 uppercase -mt-0.5">{{ strtoupper($settings['tagline'] ?? 'SOURCING AGENCY') }}</span>
            </a>

            <!-- Desktop Nav Links (Ordered matching section flow) -->
            <nav class="hidden lg:flex items-center space-x-7 text-xs font-medium uppercase tracking-[0.16em] text-stone-600" aria-label="Main Navigation">
                <a href="{{ $h }}#home" class="hover:text-stone-950 transition-colors">{{ __('site.nav.home') }}</a>
                <a href="{{ route('about') }}" class="hover:text-stone-950 transition-colors {{ request()->routeIs('about') ? 'text-stone-950 font-bold border-b border-stone-950 pb-0.5' : '' }}">{{ __('site.nav.about') }}</a>
                <a href="{{ route('categories.index') }}" class="hover:text-stone-950 transition-colors {{ request()->routeIs('categories.*') ? 'text-stone-950 font-bold border-b border-stone-950 pb-0.5' : '' }}">{{ __('site.nav.categories') }}</a>
                <a href="{{ route('stay-eat') }}" class="hover:text-stone-950 transition-colors {{ request()->routeIs('stay-eat') ? 'text-stone-950 font-bold border-b border-stone-950 pb-0.5' : '' }}">{{ __('site.nav.stay_eat') }}</a>
                <a href="{{ route('contact') }}" class="hover:text-stone-950 transition-colors {{ request()->routeIs('contact') ? 'text-stone-950 font-bold border-b border-stone-950 pb-0.5' : '' }}">{{ __('site.nav.contact') }}</a>
            </nav>

            <!-- Language Switcher & Right CTA Button -->
            <div class="hidden lg:flex items-center space-x-4">
                <!-- EN / ID Switcher -->
                <div class="inline-flex items-center text-xs font-medium tracking-wider bg-stone-100 border border-stone-200/90 rounded px-2.5 py-1">
                    <a href="{{ route('locale.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'text-stone-950 font-bold' : 'text-stone-400 hover:text-stone-700' }} transition-colors" title="Switch to English">
                        EN
                    </a>
                    <span class="mx-1 text-stone-300">/</span>
                    <a href="{{ route('locale.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'text-stone-950 font-bold' : 'text-stone-400 hover:text-stone-700' }} transition-colors" title="Ganti ke Bahasa Indonesia">
                        ID
                    </a>
                </div>

                <a href="{{ $h }}#contact" class="inline-flex items-center justify-center px-6 py-2.5 bg-stone-900 text-stone-50 text-xs font-medium uppercase tracking-[0.16em] hover:bg-stone-800 transition-colors">
                    {{ __('site.nav.request_quote') }}
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="lg:hidden flex items-center space-x-3">
                <!-- Mobile EN / ID Switcher -->
                <div class="inline-flex items-center text-xs font-medium tracking-wider bg-stone-100 border border-stone-200 rounded px-2 py-0.5">
                    <a href="{{ route('locale.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'text-stone-950 font-bold' : 'text-stone-400' }}">EN</a>
                    <span class="mx-1 text-stone-300">/</span>
                    <a href="{{ route('locale.switch', 'id') }}" class="{{ app()->getLocale() === 'id' ? 'text-stone-950 font-bold' : 'text-stone-400' }}">ID</a>
                </div>

                <button type="button" id="mobile-menu-btn" class="p-2.5 text-stone-800 hover:text-stone-950 inline-flex items-center justify-center min-w-[44px] min-h-[44px]" aria-label="Toggle Navigation Menu" aria-expanded="false" aria-controls="mobile-nav">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path id="menu-icon-bars" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16" />
                        <path id="menu-icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Nav Menu Drawer -->
        <div id="mobile-nav" class="hidden lg:hidden bg-[#FAF8F5] border-b border-stone-200 px-6 py-6 transition-all">
            <nav class="flex flex-col space-y-4 text-sm font-medium uppercase tracking-[0.15em] text-stone-700">
                <a href="{{ $h }}#home" class="py-1 hover:text-stone-950" onclick="toggleMobileMenu()">{{ __('site.nav.home') }}</a>
                <a href="{{ route('about') }}" class="py-1 hover:text-stone-950" onclick="toggleMobileMenu()">{{ __('site.nav.about') }}</a>
                <a href="{{ route('categories.index') }}" class="py-1 hover:text-stone-950" onclick="toggleMobileMenu()">{{ __('site.nav.categories') }}</a>
                <a href="{{ route('stay-eat') }}" class="py-1 hover:text-stone-950 {{ request()->routeIs('stay-eat') ? 'font-bold text-stone-950' : '' }}" onclick="toggleMobileMenu()">{{ __('site.nav.stay_eat') }}</a>
                <a href="{{ route('contact') }}" class="py-1 hover:text-stone-950 {{ request()->routeIs('contact') ? 'font-bold text-stone-950' : '' }}" onclick="toggleMobileMenu()">{{ __('site.nav.contact') }}</a>
                <div class="pt-4 border-t border-stone-200">
                    <a href="{{ $h }}#contact" class="block w-full py-3 text-center bg-stone-900 text-stone-50 text-xs font-medium uppercase tracking-[0.18em]" onclick="toggleMobileMenu()">
                        {{ __('site.nav.request_quote') }}
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <main id="main-content">
        @yield('content')
    </main>

    <!-- 9. Footer -->
    <footer class="bg-[#12100E] text-stone-400 text-xs border-t border-stone-800/60 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-stone-800">
                
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-4 space-y-4">
                    <a href="{{ route('home') }}" class="flex flex-col tracking-wider font-serif">
                        <span class="text-xl font-bold tracking-[0.12em] text-white">{{ strtoupper($settings['site_name'] ?? 'BALI EASY') }}</span>
                        <span class="text-[9px] tracking-[0.35em] font-sans font-semibold text-stone-400 uppercase">{{ strtoupper($settings['tagline'] ?? 'SOURCING AGENCY') }}</span>
                    </a>
                    <p class="text-stone-400 leading-relaxed font-light max-w-sm">
                        {{ __('site.footer.description') }}
                    </p>
                    <div class="text-stone-400 text-xs space-y-1 font-light pt-2">
                        <div>{{ $settings['address'] ?? 'Jl. Pantai Batu Bolong, Canggu, Bali 80361, Indonesia' }}</div>
                        <div>Email: <a href="mailto:{{ $settings['contact_email'] ?? 'hello@balieasysourcing.com' }}" class="text-stone-200 hover:underline">{{ $settings['contact_email'] ?? 'hello@balieasysourcing.com' }}</a></div>
                        <div>WhatsApp: <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890') }}" target="_blank" rel="noopener noreferrer" class="text-stone-200 hover:underline">{{ $settings['whatsapp_number'] ?? '+62 812 3456 7890' }}</a></div>
                        @if(!empty($settings['instagram_url']))
                            <div>Instagram: <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer" class="text-stone-200 hover:underline">{{ $settings['instagram_url'] }}</a></div>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Categories -->
                <div class="lg:col-span-3 space-y-3">
                    <div class="text-white font-semibold tracking-[0.16em] uppercase text-xs mb-4">
                        {{ __('site.footer.categories_title') }}
                    </div>
                    <ul class="space-y-2 text-stone-400">
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ $h }}#categories" class="hover:text-stone-200 transition-colors">
                                    {{ __("site.categories.items.{$cat->slug}.name") !== "site.categories.items.{$cat->slug}.name" ? __("site.categories.items.{$cat->slug}.name") : $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Col 3: Navigation Menu -->
                <div class="lg:col-span-2 space-y-3">
                    <div class="text-white font-semibold tracking-[0.16em] uppercase text-xs mb-4">
                        {{ __('site.footer.nav_title') }}
                    </div>
                    <ul class="space-y-2 text-stone-400">
                        <li><a href="{{ $h }}#home" class="hover:text-stone-200 transition-colors">{{ __('site.nav.home') }}</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-stone-200 transition-colors">{{ __('site.nav.about') }}</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-stone-200 transition-colors">{{ __('site.nav.categories') }}</a></li>
                        <li><a href="{{ $h }}#how-it-works" class="hover:text-stone-200 transition-colors">{{ __('site.nav.how_it_works') }}</a></li>
                        <li><a href="{{ route('stay-eat') }}" class="hover:text-stone-200 transition-colors">{{ __('site.nav.stay_eat') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-stone-200 transition-colors">{{ __('site.nav.contact') }}</a></li>
                        <li><a href="{{ url('/admin') }}" class="hover:text-stone-200 transition-colors">{{ __('site.footer.staff_login') }}</a></li>
                    </ul>
                </div>

                <!-- Col 4: Newsletter -->
                <div id="newsletter" class="lg:col-span-3 space-y-4">
                    <div class="text-white font-semibold tracking-[0.16em] uppercase text-xs mb-2">
                        {{ __('site.footer.newsletter_title') }}
                    </div>
                    <p class="text-stone-400 text-xs font-light leading-relaxed">
                        {{ __('site.footer.newsletter_text') }}
                    </p>

                    @if(session('newsletter_success'))
                        <div class="p-2.5 bg-stone-800 text-emerald-400 text-xs border border-stone-700">
                            {{ session('newsletter_success') }}
                        </div>
                    @endif

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col gap-2">
                        @csrf
                        <input 
                            type="email" 
                            name="email" 
                            required 
                            placeholder="{{ __('site.footer.newsletter_placeholder') }}" 
                            class="px-3.5 py-2.5 bg-stone-900 text-white placeholder-stone-500 border border-stone-800 text-xs focus:outline-none focus:border-stone-400"
                        >
                        <button type="submit" class="w-full py-2.5 bg-stone-200 text-stone-900 text-xs font-semibold uppercase tracking-[0.15em] hover:bg-white transition-colors">
                            {{ __('site.footer.btn_subscribe') }}
                        </button>
                    </form>
                </div>

            </div>

            <!-- Bottom Copyright & Policies -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-stone-500 text-[11px] gap-4">
                <div class="text-center sm:text-left">
                    &copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Bali Easy Sourcing' }}. {{ __('site.footer.copyright') }}
                </div>
                <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2">
                    <a href="{{ url('/admin') }}" class="hover:text-stone-300 transition-colors">{{ __('site.footer.staff_login') }}</a>
                    <a href="{{ $h }}#contact" class="hover:text-stone-300 transition-colors">{{ __('site.footer.terms') }}</a>
                    <a href="{{ $h }}#contact" class="hover:text-stone-300 transition-colors">{{ __('site.footer.privacy') }}</a>
                </div>
            </div>

        </div>
    </footer>

    <!-- Accessible Scripts for Mobile Menu Toggle -->
    <script>
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileNav = document.getElementById('mobile-nav');
        const iconBars = document.getElementById('menu-icon-bars');
        const iconClose = document.getElementById('menu-icon-close');

        function toggleMobileMenu() {
            const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
            menuBtn.setAttribute('aria-expanded', !isExpanded);
            mobileNav.classList.toggle('hidden');
            iconBars.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        }

        if (menuBtn) {
            menuBtn.addEventListener('click', toggleMobileMenu);
        }

        // Close mobile menu on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !mobileNav.classList.contains('hidden')) {
                toggleMobileMenu();
            }
        });
    </script>
</body>
</html>
