<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        
        <!-- Row 1: Charts (Traffic Trend & Device Breakdown) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
            @livewire(\App\Filament\Widgets\VisitorTrafficChart::class)
            @livewire(\App\Filament\Widgets\VisitorDevicesChart::class)
        </div>

        <!-- Row 2: Top Visited Pages Widget -->
        <div>
            @livewire(\App\Filament\Widgets\TopPagesWidget::class)
        </div>

        <!-- Row 3: Live Real-time Visitors Feed -->
        <x-filament::section>
            <x-slot name="heading">
                Log Kunjungan Langsung (Real-time Visitors Log)
            </x-slot>
            <x-slot name="description">
                20 aktivitas kunjungan halaman publik terbaru yang tercatat oleh sistem pelacak.
            </x-slot>
            <x-slot name="headerEnd">
                <span style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; background-color: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                    <span style="width: 8px; height: 8px; border-radius: 9999px; background-color: #10b981;"></span>
                    Pelacak Aktif
                </span>
            </x-slot>

            @php
                $recentVisits = \App\Models\PageView::orderBy('created_at', 'desc')->take(20)->get();
            @endphp

            <div style="overflow-x: auto; margin: -1rem; margin-top: 0.5rem;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.8125rem;">
                    <thead>
                        <tr style="border-bottom: 1px solid #e7e5e4; background-color: #fafaf9; color: #78716c; text-transform: uppercase; font-size: 0.6875rem; letter-spacing: 0.05em; font-weight: 600;">
                            <th style="padding: 0.75rem 1rem;">Waktu</th>
                            <th style="padding: 0.75rem 1rem;">Halaman Dikunjungi</th>
                            <th style="padding: 0.75rem 1rem;">Perangkat</th>
                            <th style="padding: 0.75rem 1rem;">Browser / OS</th>
                            <th style="padding: 0.75rem 1rem;">Sumber Rujukan (Referer)</th>
                            <th style="padding: 0.75rem 1rem;">Bahasa</th>
                        </tr>
                    </thead>
                    <tbody style="color: #44403c;">
                        @forelse($recentVisits as $visit)
                            <tr style="border-bottom: 1px solid #f5f5f4;">
                                <td style="padding: 0.75rem 1rem; white-space: nowrap; color: #78716c;">
                                    <div style="font-weight: 500; color: #292524;">{{ $visit->created_at->diffForHumans() }}</div>
                                    <div style="font-size: 0.6875rem; color: #a8a29e;">{{ $visit->created_at->format('d M Y, H:i:s') }}</div>
                                </td>
                                <td style="padding: 0.75rem 1rem;">
                                    <div style="font-weight: 600; color: #1c1917;">{{ $visit->page_title ?: $visit->path }}</div>
                                    <a href="{{ url($visit->path) }}" target="_blank" style="font-size: 0.75rem; color: #d97706; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                                        {{ $visit->path }} &nearr;
                                    </a>
                                </td>
                                <td style="padding: 0.75rem 1rem;">
                                    <span style="display: inline-block; padding: 0.125rem 0.5rem; border-radius: 0.375rem; font-size: 0.75rem; font-weight: 500; background-color: {{ $visit->device === 'Mobile' ? '#fef3c7; color: #b45309; border: 1px solid #fde68a;' : '#dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe;' }}">
                                        {{ $visit->device }}
                                    </span>
                                </td>
                                <td style="padding: 0.75rem 1rem;">
                                    <div style="font-weight: 500; color: #292524;">{{ $visit->browser }}</div>
                                    <div style="font-size: 0.6875rem; color: #78716c;">{{ $visit->platform }}</div>
                                </td>
                                <td style="padding: 0.75rem 1rem;">
                                    @if($visit->referer)
                                        <span style="font-weight: 500; color: #292524;">{{ $visit->referer }}</span>
                                    @else
                                        <span style="color: #a8a29e; font-style: italic;">Langsung (Direct / Bookmark)</span>
                                    @endif
                                </td>
                                <td style="padding: 0.75rem 1rem; text-transform: uppercase; font-family: monospace; font-size: 0.75rem; color: #78716c;">
                                    {{ $visit->locale ?: 'en' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 2rem; text-align: center; color: #a8a29e;">
                                    Belum ada data kunjungan yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-filament::section>

    </div>
</x-filament-panels::page>
