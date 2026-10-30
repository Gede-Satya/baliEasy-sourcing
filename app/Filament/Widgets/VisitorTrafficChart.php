<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class VisitorTrafficChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Tren Pengunjung Website (14 Hari Terakhir)';

    protected ?string $maxHeight = '280px';

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 2,
    ];

    protected function getData(): array
    {
        $days = 14;
        $labels = [];
        $pageViewsData = [];
        $uniqueVisitorsData = [];

        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();

        // Fetch aggregated records for the last 14 days
        $views = PageView::where('created_at', '>=', $startDate)
            ->get(['created_at', 'ip_hash']);

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $labels[] = $date->translatedFormat('d M');

            $dayViews = $views->filter(fn ($v) => $v->created_at->format('Y-m-d') === $dateStr);

            $pageViewsData[] = $dayViews->count();
            $uniqueVisitorsData[] = $dayViews->pluck('ip_hash')->unique()->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Tayangan Halaman (Pageviews)',
                    'data' => $pageViewsData,
                    'borderColor' => '#D97706', // amber-600
                    'backgroundColor' => 'rgba(217, 119, 6, 0.1)',
                    'fill' => 'start',
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Pengunjung Unik (Unique Visitors)',
                    'data' => $uniqueVisitorsData,
                    'borderColor' => '#2563EB', // blue-600
                    'backgroundColor' => 'rgba(37, 99, 235, 0.05)',
                    'fill' => 'start',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
