<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;

class VisitorDevicesChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected ?string $heading = 'Perangkat Pengunjung (Device Breakdown)';

    protected ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $desktop = PageView::where('device', 'Desktop')->count();
        $mobile = PageView::where('device', 'Mobile')->count();
        $tablet = PageView::where('device', 'Tablet')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Perangkat',
                    'data' => [$desktop, $mobile, $tablet],
                    'backgroundColor' => [
                        '#10B981', // emerald-500
                        '#F59E0B', // amber-500
                        '#6366F1', // indigo-500
                    ],
                ],
            ],
            'labels' => [
                "Desktop ({$desktop})",
                "Mobile ({$mobile})",
                "Tablet ({$tablet})",
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
