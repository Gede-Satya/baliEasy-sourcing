<?php

namespace App\Filament\Widgets;

use App\Models\Quotation;
use Filament\Widgets\ChartWidget;

class QuotationStatusChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Quotation Status Breakdown';

    protected ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $statuses = [
            'pending' => 'Pending',
            'contacted' => 'Contacted',
            'quoted' => 'Quoted',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];

        $counts = [];
        $labels = [];

        foreach ($statuses as $key => $label) {
            $count = Quotation::where('status', $key)->count();
            $counts[] = $count;
            $labels[] = "{$label} ({$count})";
        }

        return [
            'datasets' => [
                [
                    'label' => 'Quotations',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#F59E0B', // pending - amber
                        '#3B82F6', // contacted - blue
                        '#D97706', // quoted - primary amber-600
                        '#8B5CF6', // in_progress - purple
                        '#10B981', // completed - green
                        '#EF4444', // cancelled - red
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
