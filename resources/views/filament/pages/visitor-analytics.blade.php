<x-filament-panels::page>
    <div class="space-y-6">
        
        <!-- Live Visits Feed / Log Kunjungan Terakhir -->
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                        Log Kunjungan Langsung (Real-time Visitors Log)
                    </h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        20 aktivitas kunjungan halaman publik terbaru yang tercatat oleh sistem.
                    </p>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Pelacak Aktif
                </span>
            </div>

            @php
                $recentVisits = \App\Models\PageView::orderBy('created_at', 'desc')->take(20)->get();
            @endphp

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-gray-800/50 text-gray-700 dark:text-gray-200 uppercase tracking-wider text-[11px] font-semibold">
                        <tr>
                            <th class="px-4 py-3">Waktu</th>
                            <th class="px-4 py-3">Halaman Dikunjungi</th>
                            <th class="px-4 py-3">Perangkat</th>
                            <th class="px-4 py-3">Browser / OS</th>
                            <th class="px-4 py-3">Sumber Rujukan (Referer)</th>
                            <th class="px-4 py-3">Bahasa</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($recentVisits as $visit)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap text-gray-500">
                                    {{ $visit->created_at->diffForHumans() }}
                                    <span class="block text-[10px] text-gray-400">{{ $visit->created_at->format('d M H:i:s') }}</span>
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                    <div>{{ $visit->page_title ?: $visit->path }}</div>
                                    <a href="{{ url($visit->path) }}" target="_blank" class="text-[11px] text-amber-600 hover:underline">
                                        {{ $visit->path }} &nearr;
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium {{ $visit->device === 'Mobile' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                                        {{ $visit->device }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-gray-900 dark:text-white">{{ $visit->browser }}</div>
                                    <div class="text-[10px] text-gray-400">{{ $visit->platform }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($visit->referer)
                                        <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $visit->referer }}</span>
                                    @else
                                        <span class="text-gray-400 italic">Langsung (Direct / Bookmark)</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 uppercase text-[11px] font-mono text-gray-500">
                                    {{ $visit->locale ?: 'en' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-400">
                                    Belum ada data kunjungan yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-filament-panels::page>

