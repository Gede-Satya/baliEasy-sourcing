<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VisitorOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $todayStart = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();

        $todayViews = PageView::where('created_at', '>=', $todayStart)->count();
        $todayUniques = PageView::where('created_at', '>=', $todayStart)->distinct('ip_hash')->count('ip_hash');

        $monthViews = PageView::where('created_at', '>=', $monthStart)->count();
        $totalUniques = PageView::distinct('ip_hash')->count('ip_hash');

        // Top page
        $topPage = PageView::selectRaw('path, count(*) as count')
            ->groupBy('path')
            ->orderByDesc('count')
            ->first();

        $topPageLabel = $topPage ? ($topPage->path === '/' ? 'Beranda (Home)' : $topPage->path) : 'Belum Ada';
        $topPageCount = $topPage ? $topPage->count : 0;

        // 7-day trend sparkline
        $sparkline = [];
        for ($i = 6; $i >= 0; $i--) {
            $sparkline[] = PageView::whereDate('created_at', Carbon::now()->subDays($i))->count();
        }

        return [
            Stat::make('Kunjungan Hari Ini', number_format($todayViews))
                ->description("{$todayUniques} pengunjung unik hari ini")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart($sparkline),

            Stat::make('Pengunjung Unik Total', number_format($totalUniques))
                ->description('Berdasarkan identifikasi anonim aman')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Total Kunjungan Bulan Ini', number_format($monthViews))
                ->description(Carbon::now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success'),

            Stat::make('Halaman Terpopuler', $topPageLabel)
                ->description($topPageCount > 0 ? "{$topPageCount} total kunjungan tercatat" : 'Belum ada kunjungan')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
}
