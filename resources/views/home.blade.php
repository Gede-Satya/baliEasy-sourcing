<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_name'] ?? 'Bali Easy Sourcing' }} | Sourcing &amp; Quality Control Agency in Bali</title>
    <meta name="description" content="{{ $settings['hero_description'] ?? 'Your trusted boots-on-the-ground sourcing agency in Bali. We connect international buyers with vetted Indonesian artisans.' }}">

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
                <span class="text-xl md:text-2xl font-bold tracking-[0.12em] text-stone-900">BALI EASY</span>
                <span class="text-[9px] tracking-[0.35em] font-sans font-semibold text-stone-500 uppercase -mt-0.5">SOURCING AGENCY</span>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center space-x-7 text-xs font-medium uppercase tracking-[0.16em] text-stone-600" aria-label="Main Navigation">
                <a href="#home" class="hover:text-stone-950 transition-colors">Home</a>
                <a href="#about" class="hover:text-stone-950 transition-colors">About Us</a>
                <a href="#categories" class="hover:text-stone-950 transition-colors">Categories</a>
                <a href="#how-it-works" class="hover:text-stone-950 transition-colors">How It Works</a>
                <a href="#stay-eat" class="hover:text-stone-950 transition-colors">Stay &amp; Eat</a>
                <a href="#contact" class="hover:text-stone-950 transition-colors">Contact</a>
            </nav>

            <!-- Right CTA Button -->
            <div class="hidden sm:flex items-center space-x-4">
                <a href="#contact" class="inline-flex items-center justify-center px-6 py-2.5 bg-stone-900 text-stone-50 text-xs font-medium uppercase tracking-[0.16em] hover:bg-stone-800 transition-colors">
                    Request a Quote
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="md:hidden flex items-center">
                <button type="button" id="mobile-menu-btn" class="p-2 text-stone-800 hover:text-stone-950" aria-label="Toggle Navigation Menu" aria-expanded="false" aria-controls="mobile-nav">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path id="menu-icon-bars" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16" />
                        <path id="menu-icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Nav Menu Drawer -->
        <div id="mobile-nav" class="hidden md:hidden bg-[#FAF8F5] border-b border-stone-200 px-6 py-6 transition-all">
            <nav class="flex flex-col space-y-4 text-sm font-medium uppercase tracking-[0.15em] text-stone-700">
                <a href="#home" class="py-1 hover:text-stone-950" onclick="toggleMobileMenu()">Home</a>
                <a href="#about" class="py-1 hover:text-stone-950" onclick="toggleMobileMenu()">About Us</a>
                <a href="#categories" class="py-1 hover:text-stone-950" onclick="toggleMobileMenu()">Categories</a>
                <a href="#how-it-works" class="py-1 hover:text-stone-950" onclick="toggleMobileMenu()">How It Works</a>
                <a href="#stay-eat" class="py-1 hover:text-stone-950" onclick="toggleMobileMenu()">Where to Stay &amp; Eat</a>
                <a href="#contact" class="py-1 hover:text-stone-950" onclick="toggleMobileMenu()">Contact Us</a>
                <div class="pt-4 border-t border-stone-200">
                    <a href="#contact" class="block w-full py-3 text-center bg-stone-900 text-stone-50 text-xs font-medium uppercase tracking-[0.18em]" onclick="toggleMobileMenu()">
                        Request a Quote
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <main id="main-content">

        <!-- 1. Hero Section -->
        <section id="home" class="py-12 md:py-20 border-b border-stone-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    
                    <!-- Left Hero Content -->
                    <div class="lg:col-span-6 flex flex-col justify-center">
                        <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase mb-4">
                            {{ $settings['hero_eyebrow'] ?? 'BALI SOURCING & QUALITY CONTROL AGENCY' }}
                        </span>
                        
                        <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-stone-900 leading-[1.1] mb-6 font-normal">
                            Source from Indonesia. <span class="italic font-normal">Without the headache.</span>
                        </h1>

                        <p class="text-stone-600 text-base md:text-lg leading-relaxed mb-8 max-w-xl font-light">
                            {{ $settings['hero_description'] ?? 'We find vetted artisan workshops, negotiate honest local prices, and inspect every single item before it ships. You get exceptional craftsmanship without ever leaving your desk.' }}
                        </p>

                        <!-- Actions -->
                        <div class="flex flex-wrap items-center gap-4 mb-12">
                            <a href="#contact" class="inline-flex items-center justify-center px-7 py-3.5 bg-stone-900 text-stone-50 text-xs font-medium uppercase tracking-[0.18em] hover:bg-stone-800 transition-colors shadow-sm">
                                {{ $settings['cta_text'] ?? 'Request a Quote' }}
                            </a>
                            <a href="#categories" class="inline-flex items-center justify-center px-7 py-3.5 border border-stone-300 text-stone-800 text-xs font-medium uppercase tracking-[0.18em] hover:border-stone-900 transition-colors">
                                Explore Catalog
                            </a>
                        </div>

                        <!-- Trust Metrics / Stats -->
                        <div class="grid grid-cols-3 gap-6 pt-8 border-t border-stone-200">
                            <div>
                                <div class="font-serif text-2xl sm:text-3xl font-bold text-stone-900">
                                    {{ $settings['stat_1_number'] ?? '100+' }}
                                </div>
                                <div class="text-[11px] text-stone-500 font-medium tracking-wide mt-1 uppercase">
                                    {{ $settings['stat_1_label'] ?? 'Vetted Workshops' }}
                                </div>
                            </div>
                            <div>
                                <div class="font-serif text-2xl sm:text-3xl font-bold text-stone-900">
                                    {{ $settings['stat_2_number'] ?? '0%' }}
                                </div>
                                <div class="text-[11px] text-stone-500 font-medium tracking-wide mt-1 uppercase">
                                    {{ $settings['stat_2_label'] ?? 'Hidden Markups' }}
                                </div>
                            </div>
                            <div>
                                <div class="font-serif text-2xl sm:text-3xl font-bold text-stone-900">
                                    {{ $settings['stat_3_number'] ?? '100%' }}
                                </div>
                                <div class="text-[11px] text-stone-500 font-medium tracking-wide mt-1 uppercase">
                                    {{ $settings['stat_3_label'] ?? 'Inspected Before Shipping' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Hero Image -->
                    <div class="lg:col-span-6">
                        <div class="relative bg-stone-100 overflow-hidden shadow-sm">
                            <img 
                                src="{{ $settings['hero_image'] ?? 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=80' }}" 
                                alt="Master woodcarver shaping seasoned plantation teak in traditional Indonesian workshop" 
                                class="w-full h-auto aspect-4/5 object-cover object-center"
                                width="640" 
                                height="800"
                                fetchpriority="high"
                            >
                        </div>
                        <p class="mt-3 text-xs text-stone-500 font-serif italic text-left">
                            {{ $settings['hero_image_caption'] ?? 'Master woodcarver shaping seasoned plantation teak in our partner workshop.' }}
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- 2. Product Categories Section -->
        <section id="categories" class="py-16 md:py-24 border-b border-stone-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 pb-6 border-b border-stone-200 gap-6">
                    <div>
                        <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                            WHAT WE SOURCE
                        </span>
                        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal">
                            Curated Indonesian Craftsmanship
                        </h2>
                    </div>
                    <p class="text-stone-600 text-sm md:text-base max-w-md font-light leading-relaxed">
                        Direct access to master woodworkers, stone carvers, weavers, and textile studios across Bali and Java.
                    </p>
                </div>

                <!-- 4-Column Categories Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($categories as $index => $category)
                        <article class="group flex flex-col justify-between">
                            <div>
                                <!-- Image Container -->
                                <div class="overflow-hidden bg-stone-100 aspect-3/4 mb-5">
                                    <img 
                                        src="{{ $category->cover_image }}" 
                                        alt="{{ $category->name }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                        width="400" 
                                        height="533" 
                                        loading="lazy"
                                    >
                                </div>

                                <!-- Index & Slug -->
                                <span class="text-[10px] font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                                    CATEGORY 0{{ $index + 1 }}
                                </span>

                                <!-- Title -->
                                <h3 class="font-serif text-xl text-stone-900 mb-2 font-medium">
                                    {{ $category->name }}
                                </h3>

                                <!-- Description -->
                                <p class="text-stone-600 text-xs leading-relaxed font-light mb-4">
                                    {{ $category->description }}
                                </p>
                            </div>

                            <!-- Link Action -->
                            <div class="pt-3 border-t border-stone-200">
                                <a href="#contact" class="inline-flex items-center text-xs font-medium tracking-[0.15em] uppercase text-stone-900 hover:text-stone-600 transition-colors">
                                    <span>View Details</span>
                                    <span class="ml-1 text-sm font-sans" aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- 3. How It Works Section -->
        <section id="how-it-works" class="py-16 md:py-24 border-b border-stone-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                
                <!-- Section Header -->
                <div class="max-w-2xl mb-14">
                    <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                        HOW IT WORKS
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal mb-3">
                        From initial sketch to your warehouse door
                    </h2>
                    <p class="text-stone-600 text-sm md:text-base font-light leading-relaxed">
                        A straightforward 4-step process designed for remote buyers, interior designers, and hospitality brands.
                    </p>
                </div>

                <!-- 4 Steps Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
                    @foreach($steps as $index => $step)
                        <div class="flex flex-col justify-between pt-6 border-t border-stone-200">
                            <div>
                                <!-- Step Number -->
                                <div class="font-serif text-4xl text-stone-400 font-light mb-4">
                                    0{{ $index + 1 }}
                                </div>

                                <!-- Step Title -->
                                <h3 class="font-serif text-xl text-stone-900 font-medium mb-3">
                                    {{ $step->title }}
                                </h3>

                                <!-- Step Description -->
                                <p class="text-stone-600 text-xs leading-relaxed font-light mb-6">
                                    {{ $step->description }}
                                </p>
                            </div>

                            <!-- Step Stage Tag -->
                            <div class="pt-3 border-t border-stone-100">
                                <span class="text-[10px] tracking-[0.16em] uppercase font-semibold text-stone-400">
                                    Step 0{{ $index + 1 }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- 4. Mid Callout Banner -->
        <section class="py-14 bg-[#EDE6DC] border-b border-stone-200">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                    <div class="max-w-2xl">
                        <span class="text-xs font-semibold tracking-[0.22em] text-stone-600 uppercase block mb-2">
                            CUSTOM &amp; HOSPITALITY PROJECTS
                        </span>
                        <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl text-stone-950 font-normal mb-3">
                            Furnishing a villa, boutique resort, or retail brand?
                        </h2>
                        <p class="text-stone-700 text-sm sm:text-base font-light leading-relaxed">
                            Custom dimensions, special timber finishes, or mixed-material assemblies. If Indonesian artisans can make it, we will source, inspect, and ship it for you.
                        </p>
                    </div>

                    <div class="shrink-0">
                        <a href="#contact" class="inline-flex items-center justify-center px-8 py-4 bg-stone-900 text-stone-50 text-xs font-medium uppercase tracking-[0.18em] hover:bg-stone-800 transition-colors shadow-sm">
                            Tell Us About Your Project
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. About Us / Why Work With Us -->
        <section id="about" class="py-16 md:py-24 border-b border-stone-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
                    
                    <!-- Left Anchor Column -->
                    <div class="lg:col-span-5 flex flex-col justify-start">
                        <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                            WHY CHOOSE US
                        </span>
                        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal mb-4">
                            Your eyes, ears, and hands in Bali
                        </h2>
                        <h3 class="font-serif text-xl italic text-stone-700 font-normal mb-5">
                            No language barriers. No surprise defects. No mystery markups.
                        </h3>
                        <p class="text-stone-600 text-sm leading-relaxed font-light mb-8">
                            Buying overseas can feel like a gamble when you cannot inspect goods in person. We act as your dedicated local team on the ground, walking the factory floors, testing wood moisture, and protecting your investment from day one.
                        </p>

                        <!-- Transparent Highlight Box -->
                        <div class="bg-[#F2ECE3] p-6 border-l-2 border-stone-900">
                            <div class="font-serif text-base font-semibold text-stone-900 mb-1">
                                100% Transparent Direct Pricing
                            </div>
                            <p class="text-xs text-stone-600 leading-relaxed font-light">
                                You pay the actual workshop production cost. We charge a flat, transparent service fee for our sourcing, QC, and logistics management.
                            </p>
                        </div>
                    </div>

                    <!-- Right Column: 4 Value Pillars -->
                    <div class="lg:col-span-7 space-y-8">
                        @foreach($services as $index => $service)
                            <div class="pb-8 border-b border-stone-200 last:border-b-0 last:pb-0">
                                <span class="text-[10px] font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-1">
                                    WHY WORK WITH US 0{{ $index + 1 }}
                                </span>
                                <h3 class="font-serif text-2xl text-stone-900 font-medium mb-2">
                                    {{ $service->title }}
                                </h3>
                                <p class="text-stone-600 text-sm leading-relaxed font-light">
                                    {{ $service->description }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>

        <!-- 6. Where to Stay & Where to Eat -->
        <section id="stay-eat" class="py-16 md:py-24 border-b border-stone-200/80">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                
                <!-- Section Header -->
                <div class="max-w-xl mb-12">
                    <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                        VISITING BALI?
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal mb-2">
                        Where to Stay &amp; Where to Eat
                    </h2>
                    <p class="text-stone-600 text-sm font-light">
                        Planning an inspection trip? Here are two of our favorite vetted spots in Bali.
                    </p>
                </div>

                <!-- 2 Simple Clean Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                    @foreach($partners as $partner)
                        <article class="group bg-white border border-stone-200/70 p-6 flex flex-col justify-between">
                            <div>
                                <!-- Image Container -->
                                <div class="overflow-hidden bg-stone-100 aspect-16/10 mb-5">
                                    <img 
                                        src="{{ $partner->cover_image }}" 
                                        alt="{{ $partner->name }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                        width="600" 
                                        height="375" 
                                        loading="lazy"
                                    >
                                </div>

                                <!-- Label: Where to Stay / Where to Eat -->
                                <div class="text-[11px] font-semibold tracking-[0.18em] text-stone-500 uppercase mb-2">
                                    {{ $partner->type === 'stay' ? 'Where to Stay' : 'Where to Eat' }} &middot; {{ $partner->area }}
                                </div>

                                <!-- Partner Title -->
                                <h3 class="font-serif text-2xl text-stone-900 mb-2 font-medium">
                                    {{ $partner->name }}
                                </h3>

                                <!-- Description -->
                                <p class="text-stone-600 text-xs sm:text-sm leading-relaxed font-light mb-4">
                                    {{ $partner->description }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-stone-100 flex items-center justify-between text-xs">
                                <span class="text-stone-400 font-light">{{ $partner->price_range ?? '$$' }}</span>
                                <a href="#contact" class="inline-flex items-center font-medium tracking-[0.12em] uppercase text-stone-900 hover:text-stone-600 transition-colors">
                                    <span>Learn More</span>
                                    <span class="ml-1 text-sm font-sans" aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- 7. Contact Us & Request a Quote Form -->
        <section id="contact" class="py-16 md:py-24 bg-[#FAF7F2] border-b border-stone-200">
            <div class="max-w-4xl mx-auto px-6 lg:px-12">
                
                <div class="text-center mb-12">
                    <span class="text-xs font-semibold tracking-[0.22em] text-stone-500 uppercase block mb-2">
                        START A CONVERSATION
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-normal mb-3">
                        Tell us what you want to make
                    </h2>
                    <p class="text-stone-600 text-sm sm:text-base font-light max-w-xl mx-auto">
                        Got a mood board, a sketch, or an order list? Send it over. We will assess workshop availability and reply with a transparent quote in 48 hours.
                    </p>
                </div>

                <form action="{{ route('rfq.submit') }}" method="POST" class="bg-white p-8 md:p-10 border border-stone-200 shadow-sm space-y-6">
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
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                placeholder="Your Name"
                                class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                            >
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                placeholder="buyer@example.com"
                                class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                            >
                        </div>

                        <!-- Company / Brand -->
                        <div>
                            <label for="company" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                Company or Brand Name
                            </label>
                            <input 
                                type="text" 
                                id="company" 
                                name="company" 
                                value="{{ old('company') }}" 
                                placeholder="Studio / Boutique / Hotel Name"
                                class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                            >
                        </div>

                        <!-- WhatsApp Phone -->
                        <div>
                            <label for="whatsapp" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                WhatsApp / Phone Number
                            </label>
                            <input 
                                type="text" 
                                id="whatsapp" 
                                name="whatsapp" 
                                value="{{ old('whatsapp') }}" 
                                placeholder="+1 234 567 8900"
                                class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                            >
                        </div>

                        <!-- Product Category Selector -->
                        <div>
                            <label for="category_id" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                Product Category
                            </label>
                            <select 
                                id="category_id" 
                                name="category_id" 
                                class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                            >
                                <option value="">Select a category...</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Estimated Quantity -->
                        <div>
                            <label for="quantity" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                                Estimated Order Quantity
                            </label>
                            <input 
                                type="text" 
                                id="quantity" 
                                name="quantity" 
                                value="{{ old('quantity') }}" 
                                placeholder="e.g. 50 pcs / 1x 20ft Container"
                                class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                            >
                        </div>
                    </div>

                    <!-- Project Scope & Description -->
                    <div>
                        <label for="description" class="block text-xs font-semibold uppercase tracking-[0.15em] text-stone-700 mb-2">
                            Project Details &amp; Specifications <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="4" 
                            required 
                            placeholder="Tell us what you want to produce: product types, materials, target dimensions, finishes, or custom designs..."
                            class="w-full px-4 py-3 text-sm bg-stone-50 border border-stone-200 focus:border-stone-900 focus:bg-white focus:outline-none transition-colors"
                        >{{ old('description') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="w-full py-4 bg-stone-900 text-stone-50 text-xs font-medium uppercase tracking-[0.18em] hover:bg-stone-800 transition-colors shadow-sm">
                            Send My Sourcing Request
                        </button>
                    </div>
                </form>

            </div>
        </section>

        <!-- 8. Dark Bottom CTA -->
        <section class="py-20 md:py-28 bg-[#181614] text-stone-100 border-t border-stone-900">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <span class="text-xs font-semibold tracking-[0.22em] text-stone-400 uppercase block mb-3">
                    READY TO START?
                </span>
                
                <h2 class="font-serif text-3xl sm:text-5xl lg:text-6xl text-white font-normal mb-6">
                    Let us build your next collection in Indonesia.
                </h2>

                <p class="text-stone-300 text-sm sm:text-base md:text-lg font-light leading-relaxed max-w-2xl mx-auto mb-10">
                    Zero commitment to inquire. Send your ideas today and see how simple sourcing in Bali can be.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="#contact" class="inline-flex items-center justify-center px-8 py-4 bg-white text-stone-900 text-xs font-medium uppercase tracking-[0.18em] hover:bg-stone-100 transition-colors">
                        Request a Free Quote
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-8 py-4 border border-stone-600 text-stone-200 text-xs font-medium uppercase tracking-[0.18em] hover:border-white hover:text-white transition-colors">
                        Chat on WhatsApp
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- 9. Footer -->
    <footer class="bg-[#12100E] text-stone-400 text-xs border-t border-stone-800/60 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-stone-800">
                
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-4 space-y-4">
                    <a href="{{ route('home') }}" class="flex flex-col tracking-wider font-serif">
                        <span class="text-xl font-bold tracking-[0.12em] text-white">BALI EASY</span>
                        <span class="text-[9px] tracking-[0.35em] font-sans font-semibold text-stone-400 uppercase">SOURCING AGENCY</span>
                    </a>
                    <p class="text-stone-400 leading-relaxed font-light max-w-sm">
                        Dedicated procurement, quality inspection, and export container shipping agency based in Bali, Indonesia.
                    </p>
                    <div class="text-stone-400 text-xs space-y-1 font-light pt-2">
                        <div>{{ $settings['address'] ?? 'Jl. Pantai Batu Bolong, Canggu, Bali 80361, Indonesia' }}</div>
                        <div>Email: <a href="mailto:{{ $settings['contact_email'] ?? 'hello@balieasysourcing.com' }}" class="text-stone-200 hover:underline">{{ $settings['contact_email'] ?? 'hello@balieasysourcing.com' }}</a></div>
                        <div>WhatsApp: <span class="text-stone-200">{{ $settings['whatsapp_number'] ?? '+62 812 3456 7890' }}</span></div>
                    </div>
                </div>

                <!-- Col 2: Categories -->
                <div class="lg:col-span-3 space-y-3">
                    <div class="text-white font-semibold tracking-[0.16em] uppercase text-xs mb-4">
                        Product Categories
                    </div>
                    <ul class="space-y-2 text-stone-400">
                        @foreach($categories as $cat)
                            <li>
                                <a href="#categories" class="hover:text-stone-200 transition-colors">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Col 3: Navigation Menu -->
                <div class="lg:col-span-2 space-y-3">
                    <div class="text-white font-semibold tracking-[0.16em] uppercase text-xs mb-4">
                        Navigation
                    </div>
                    <ul class="space-y-2 text-stone-400">
                        <li><a href="#home" class="hover:text-stone-200 transition-colors">Home</a></li>
                        <li><a href="#about" class="hover:text-stone-200 transition-colors">About Us</a></li>
                        <li><a href="#categories" class="hover:text-stone-200 transition-colors">Categories</a></li>
                        <li><a href="#how-it-works" class="hover:text-stone-200 transition-colors">How It Works</a></li>
                        <li><a href="#stay-eat" class="hover:text-stone-200 transition-colors">Where to Stay &amp; Eat</a></li>
                        <li><a href="#contact" class="hover:text-stone-200 transition-colors">Contact Us</a></li>
                        <li><a href="{{ url('/admin') }}" class="hover:text-stone-200 transition-colors">Admin Login</a></li>
                    </ul>
                </div>

                <!-- Col 4: Newsletter -->
                <div id="newsletter" class="lg:col-span-3 space-y-4">
                    <div class="text-white font-semibold tracking-[0.16em] uppercase text-xs mb-2">
                        Newsletter
                    </div>
                    <p class="text-stone-400 text-xs font-light leading-relaxed">
                        Subscribe for seasonal updates on Indonesian craftsmanship, workshop visits, and shipping news.
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
                            placeholder="Enter your email" 
                            class="px-3.5 py-2.5 bg-stone-900 text-white placeholder-stone-500 border border-stone-800 text-xs focus:outline-none focus:border-stone-400"
                        >
                        <button type="submit" class="w-full py-2.5 bg-stone-200 text-stone-900 text-xs font-semibold uppercase tracking-[0.15em] hover:bg-white transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>

            </div>

            <!-- Bottom Copyright & Policies -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-stone-500 text-[11px] gap-4">
                <div>
                    &copy; {{ date('Y') }} Bali Easy Sourcing Agency. All rights reserved.
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ url('/admin') }}" class="hover:text-stone-300 transition-colors">Staff Login</a>
                    <a href="#contact" class="hover:text-stone-300 transition-colors">Terms of Service</a>
                    <a href="#contact" class="hover:text-stone-300 transition-colors">Privacy Policy</a>
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
