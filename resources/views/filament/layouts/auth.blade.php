@props([
    'livewire' => null,
])

<x-filament-panels::layout.base :livewire="$livewire">
    <div class="min-h-screen w-full flex bg-[#FAF7F2] text-stone-800 antialiased selection:bg-amber-200 selection:text-stone-900">
        <div class="w-full flex flex-col lg:flex-row min-h-screen">
            
            <!-- Left Branding & Atmospheric Side (Visible on lg+) -->
            <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 relative bg-stone-900 text-stone-100 flex-col justify-between p-12 xl:p-16 overflow-hidden">
                <!-- Background Image with Dark Vignette & Warm Tint -->
                <div class="absolute inset-0 z-0">
                    <img 
                        src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1600&q=80" 
                        alt="Bali Sourcing Craftsmanship" 
                        class="w-full h-full object-cover opacity-35 scale-105"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/70 to-stone-900/60"></div>
                </div>

                <!-- Top Brand Header -->
                <div class="relative z-10 flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-lg bg-amber-500/10 border border-amber-400/30 text-amber-300 flex items-center justify-center font-serif text-lg font-bold tracking-widest shadow-inner">
                        BE
                    </div>
                    <div class="flex flex-col">
                        <span class="font-serif text-lg tracking-[0.22em] text-stone-100 uppercase font-medium">
                            BALI EASY SOURCING
                        </span>
                        <span class="text-[9px] tracking-[0.35em] text-amber-200/70 uppercase font-semibold">
                            MANAGEMENT & OPERATIONAL PORTAL
                        </span>
                    </div>
                </div>

                <!-- Mid Editorial Quote -->
                <div class="relative z-10 max-w-lg my-auto py-12">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/15 border border-amber-500/25 text-amber-300 text-xs tracking-wider uppercase font-medium mb-6">
                        <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Hospitality & FF&E Procurement
                    </div>

                    <h2 class="font-serif text-3xl xl:text-4xl leading-tight font-normal text-stone-100 mb-6">
                        Bridging global vision with authentic Balinese craftsmanship.
                    </h2>

                    <p class="text-stone-300 text-sm leading-relaxed font-light">
                        Direct factory access, strict quality inspection, and consolidated export shipping for luxury villas, hospitality resorts, and interior designers worldwide.
                    </p>

                    <!-- Key Value Metrics -->
                    <div class="grid grid-cols-3 gap-6 mt-10 pt-8 border-t border-stone-800">
                        <div>
                            <div class="font-serif text-2xl font-normal text-amber-300">500+</div>
                            <div class="text-[11px] text-stone-400 uppercase tracking-wider mt-1">Verified Artisans</div>
                        </div>
                        <div>
                            <div class="font-serif text-2xl font-normal text-amber-300">100%</div>
                            <div class="text-[11px] text-stone-400 uppercase tracking-wider mt-1">On-Site Inspected</div>
                        </div>
                        <div>
                            <div class="font-serif text-2xl font-normal text-amber-300">Global</div>
                            <div class="text-[11px] text-stone-400 uppercase tracking-wider mt-1">Freight Ready</div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Copyright -->
                <div class="relative z-10 flex items-center justify-between text-xs text-stone-500">
                    <span>&copy; {{ date('Y') }} Bali Easy Sourcing</span>
                    <span class="tracking-widest uppercase text-[10px]">Staff Gateway</span>
                </div>
            </div>

            <!-- Right Form Side -->
            <div class="flex-1 flex flex-col justify-between p-6 sm:p-12 lg:p-14 xl:p-18 bg-[#FAF7F2] overflow-y-auto">
                <!-- Top Nav / Back to Site Link -->
                <div class="flex items-center justify-between mb-8">
                    <a href="/" class="inline-flex items-center gap-2 text-xs font-semibold tracking-wider uppercase text-stone-600 hover:text-stone-900 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Website
                    </a>

                    <!-- Mobile Brand Logo (hidden on lg) -->
                    <div class="flex lg:hidden items-center gap-2">
                        <div class="w-8 h-8 rounded bg-stone-900 text-amber-200 flex items-center justify-center font-serif text-xs font-bold">
                            BE
                        </div>
                        <span class="font-serif text-sm tracking-wider uppercase font-semibold text-stone-900">Bali Easy</span>
                    </div>
                </div>

                <!-- Center Content Box -->
                <div class="w-full max-w-md mx-auto my-auto">
                    <!-- Heading -->
                    <div class="mb-7">
                        <span class="text-[11px] font-semibold tracking-[0.25em] text-amber-700 uppercase block mb-1">
                            Staff & Administrator Access
                        </span>
                        <h1 class="font-serif text-3xl text-stone-900 font-normal mb-2">
                            Sign In to Portal
                        </h1>
                        <p class="text-xs text-stone-600 leading-relaxed font-light">
                            Enter your credentials to access inquiries, catalog, and directory controls.
                        </p>
                    </div>

                    <!-- Login Card -->
                    <div class="bg-white p-7 sm:p-8 rounded-xl border border-stone-200/90 shadow-sm">
                        {{ $slot }}
                    </div>

                    <!-- Quick Demo Credentials Hint Box -->
                    <div class="mt-6 p-4 rounded-lg bg-[#F2ECE3] border border-stone-300/80 text-xs text-stone-700">
                        <div class="flex items-center gap-2 font-medium text-stone-900 mb-1.5">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Administrator Credentials</span>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-[11px] text-stone-600 font-mono mt-2 pt-2 border-t border-stone-300/60">
                            <div>Email: <strong class="text-stone-900 select-all">admin@balieasy.com</strong></div>
                            <div>Password: <strong class="text-stone-900 select-all">password</strong></div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Security Info -->
                <div class="mt-8 pt-6 border-t border-stone-200/70 text-center text-[11px] text-stone-500">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-stone-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                        Protected Management Environment · SSL 256-Bit Encrypted
                    </span>
                </div>
            </div>

        </div>
    </div>
</x-filament-panels::layout.base>

