@extends('layouts.site')

@section('title', 'Sourcing Tracking: ' . $project->project_code . ' | ' . ($settings['site_name'] ?? 'Bali Easy Sourcing'))
@section('meta_description', 'Live production and quality control tracking for project ' . $project->project_code)

@section('content')

    <!-- Header Section -->
    <section class="py-14 md:py-20 border-b border-stone-200/80 bg-[#F4EFEA]">
        <div class="max-w-6xl mx-auto px-6 lg:px-12">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-stone-900 text-stone-100 text-[10px] font-mono tracking-widest uppercase mb-3">
                        <span>LIVE SOURCING TRACKER</span>
                        <span>·</span>
                        <span class="text-amber-300">{{ $project->project_code }}</span>
                    </div>

                    <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-stone-900 font-normal leading-[1.2] mb-3">
                        {{ $project->title }}
                    </h1>

                    <p class="text-stone-600 text-sm md:text-base font-light">
                        Prepared for <strong class="text-stone-900 font-medium">{{ $project->client_name }}</strong>
                        @if($project->client_company)
                            <span>· {{ $project->client_company }}</span>
                        @endif
                        @if($project->client_country)
                            <span>({{ $project->client_country }})</span>
                        @endif
                    </p>
                </div>

                <!-- Direct WhatsApp Specialist Button -->
                <div class="shrink-0">
                    @php
                        $waDigits = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6281234567890');
                        $waText = urlencode("Hello Bali Easy Sourcing, I am checking the status for project [{$project->project_code}: {$project->title}].");
                    @endphp
                    <a 
                        href="https://wa.me/{{ $waDigits }}?text={{ $waText }}" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-stone-900 text-stone-50 text-xs font-semibold uppercase tracking-[0.15em] hover:bg-stone-800 transition-colors shadow-sm"
                    >
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.21 3.08c.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.41-.07-.12-.27-.2-.57-.35zM12.04 21.5h-.01a9.45 9.45 0 0 1-4.82-1.32l-.35-.21-3.58.94.96-3.49-.23-.36A9.43 9.43 0 0 1 2.56 12C2.56 6.78 6.8 2.54 12.04 2.54c2.53 0 4.91.99 6.7 2.78a9.4 9.4 0 0 1 2.77 6.7c0 5.23-4.25 9.48-9.47 9.48zM20.1 3.92A11.36 11.36 0 0 0 12.04.6C5.77.6.66 5.7.66 11.98c0 2.01.52 3.97 1.52 5.69L.57 23.4l5.86-1.54a11.34 11.34 0 0 0 5.6 1.43h.01c6.27 0 11.38-5.1 11.38-11.38 0-3.04-1.18-5.9-3.33-8.05z"/>
                        </svg>
                        <span>Chat Specialist</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- Main Tracking Details -->
    <section class="py-14 md:py-20 border-b border-stone-200/80">
        <div class="max-w-6xl mx-auto px-6 lg:px-12 space-y-12">

            <!-- Progress Card -->
            <div class="bg-white border border-stone-200 p-8 shadow-sm">
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <span class="text-xs uppercase font-semibold tracking-wider text-stone-500 block mb-1">Status Proyek Saat Ini</span>
                        <div class="font-serif text-2xl text-stone-900 font-medium">
                            {{ $project->stage_label }}
                        </div>
                    </div>

                    <div class="text-right">
                        <span class="text-xs uppercase font-semibold tracking-wider text-stone-500 block mb-1">Total Progres</span>
                        <div class="text-2xl font-bold font-mono text-stone-900">
                            {{ $project->progress_percent }}%
                        </div>
                    </div>
                </div>

                <!-- Visual Progress Bar -->
                <div class="w-full h-3 bg-stone-100 rounded-full overflow-hidden mb-8 border border-stone-200">
                    <div 
                        class="h-full bg-stone-900 transition-all duration-700 ease-out" 
                        style="width: {{ min(100, max(5, $project->progress_percent)) }}%;"
                    ></div>
                </div>

                <!-- 5-Stage Stepper -->
                @php
                    $stagesList = [
                        'sampling' => ['num' => '01', 'title' => 'Sampling & Prototype', 'desc' => 'Pengerjaan sampel fisik di workshop mitra'],
                        'production' => ['num' => '02', 'title' => 'Produksi Massal', 'desc' => 'Pemotongan, pembentukan, dan perakitan kriya'],
                        'quality_control' => ['num' => '03', 'title' => 'Quality Control (QC)', 'desc' => 'Inspeksi dimensi, kadar air kayu, dan finishing'],
                        'packing_stuffing' => ['num' => '04', 'title' => 'Packing & Stuffing', 'desc' => 'Kemasan standar ekspor dan muat kontainer'],
                        'shipping' => ['num' => '05', 'title' => 'Pengiriman & Tiba', 'desc' => 'Keberangkatan kargo laut hingga sampai di tujuan'],
                    ];

                    $stageOrder = ['sampling', 'production', 'quality_control', 'packing_stuffing', 'shipping', 'delivered'];
                    $currentIndex = array_search($project->stage, $stageOrder);
                    if ($currentIndex === false) { $currentIndex = 0; }
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 pt-6 border-t border-stone-200 text-xs">
                    @foreach($stagesList as $stageKey => $stageInfo)
                        @php
                            $stepIndex = array_search($stageKey, $stageOrder);
                            $isDone = $stepIndex < $currentIndex;
                            $isCurrent = $stepIndex === $currentIndex;
                        @endphp
                        <div class="p-3 border {{ $isCurrent ? 'border-stone-900 bg-[#FAF8F5]' : ($isDone ? 'border-emerald-200 bg-emerald-50/40' : 'border-stone-200 bg-stone-50/60') }} flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="font-mono text-[10px] {{ $isCurrent ? 'text-amber-700 font-bold' : ($isDone ? 'text-emerald-700 font-bold' : 'text-stone-400') }}">
                                        {{ $stageInfo['num'] }}
                                    </span>
                                    @if($isDone)
                                        <span class="text-emerald-600 text-[10px] font-semibold">Selesai</span>
                                    @elseif($isCurrent)
                                        <span class="text-amber-700 text-[10px] font-semibold uppercase">Aktif</span>
                                    @endif
                                </div>
                                <div class="font-semibold text-stone-900 mb-1 leading-snug">
                                    {{ $stageInfo['title'] }}
                                </div>
                                <div class="text-[11px] text-stone-500 font-light leading-relaxed">
                                    {{ $stageInfo['desc'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- 2-Column Details: Workshop & Schedule -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Workshop Partner Details -->
                <div class="bg-white border border-stone-200 p-8 shadow-sm">
                    <h2 class="font-serif text-2xl text-stone-900 font-normal mb-4">
                        Workshop Pengrajin Mitra
                    </h2>
                    
                    <dl class="space-y-4 text-xs">
                        <div>
                            <dt class="text-stone-400 uppercase tracking-wider font-semibold text-[10px] mb-0.5">Nama Workshop</dt>
                            <dd class="text-stone-900 font-medium text-sm">{{ $project->workshop_name ?: 'Mitra Terverifikasi Bali Easy Sourcing' }}</dd>
                        </div>
                        <div>
                            <dt class="text-stone-400 uppercase tracking-wider font-semibold text-[10px] mb-0.5">Lokasi Pengerjaan Fisik</dt>
                            <dd class="text-stone-700 text-sm">{{ $project->workshop_location ?: 'Gianyar & Sukawati, Bali, Indonesia' }}</dd>
                        </div>
                        <div>
                            <dt class="text-stone-400 uppercase tracking-wider font-semibold text-[10px] mb-0.5">Kategori Kurasi</dt>
                            <dd class="text-stone-700 text-sm">{{ $project->category?->name ?: 'Kriya & Furnitur Kustom' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Schedule & Quality Control -->
                <div class="bg-white border border-stone-200 p-8 shadow-sm">
                    <h2 class="font-serif text-2xl text-stone-900 font-normal mb-4">
                        Jadwal & Standar Kualitas (QC)
                    </h2>

                    <dl class="space-y-4 text-xs">
                        <div>
                            <dt class="text-stone-400 uppercase tracking-wider font-semibold text-[10px] mb-0.5">Target Selesai Produksi</dt>
                            <dd class="text-stone-900 font-medium text-sm">{{ $project->target_completion_date ? $project->target_completion_date->format('d F Y') : 'Sesuai kesepakatan' }}</dd>
                        </div>
                        <div>
                            <dt class="text-stone-400 uppercase tracking-wider font-semibold text-[10px] mb-0.5">Estimasi Pengapalan Kontainer</dt>
                            <dd class="text-stone-700 text-sm">{{ $project->estimated_shipping_date ? $project->estimated_shipping_date->format('d F Y') : 'Dijadwalkan pasca inspeksi QC' }}</dd>
                        </div>
                        <div>
                            <dt class="text-stone-400 uppercase tracking-wider font-semibold text-[10px] mb-0.5">Status Inspeksi QC</dt>
                            <dd class="text-stone-700 text-sm">
                                @if($project->qc_passed_at)
                                    <span class="inline-flex items-center text-emerald-700 font-semibold gap-1">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Lolos QC ({{ $project->qc_passed_at->format('d M Y') }})
                                    </span>
                                    @if($project->qc_notes)
                                        <p class="text-xs text-stone-500 mt-1 font-light italic">"{{ $project->qc_notes }}"</p>
                                    @endif
                                @else
                                    <span class="text-stone-500 font-light">Inspeksi fisik dijadwalkan menjelang akhir masa produksi.</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>

            </div>

            <!-- Workshop & Production Photo Gallery -->
            @if(!empty($project->photos) && is_array($project->photos) && count($project->photos) > 0)
                <div class="bg-white border border-stone-200 p-8 shadow-sm">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-stone-200">
                        <div>
                            <h2 class="font-serif text-2xl text-stone-900 font-normal">
                                Dokumentasi Foto Workshop & QC Langsung
                            </h2>
                            <p class="text-stone-500 text-xs font-light mt-0.5">
                                Foto asli hasil kunjungan inspeksi lapangan tim Bali Easy Sourcing ke bengkel pengrajin.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($project->photos as $photo)
                            @php
                                $photoUrl = str_starts_with($photo, 'http') ? $photo : asset('storage/' . $photo);
                            @endphp
                            <div class="aspect-square bg-stone-100 overflow-hidden border border-stone-200 group">
                                <img 
                                    src="{{ $photoUrl }}" 
                                    alt="Dokumentasi pengerjaan proyek {{ $project->project_code }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection

