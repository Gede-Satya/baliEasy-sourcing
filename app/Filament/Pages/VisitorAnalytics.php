<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TopPagesWidget;
use App\Filament\Widgets\VisitorDevicesChart;
use App\Filament\Widgets\VisitorTrafficChart;
use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class VisitorAnalytics extends Page
{
    protected static string | UnitEnum | null $navigationGroup = 'Ringkasan & Analisis';

    protected static ?int $navigationSort = 2;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-chart-pie';

    protected static ?string $navigationLabel = 'Analisis Pengunjung';

    protected static ?string $title = 'Statistik & Analisis Pengunjung Website';

    protected string $view = 'filament.pages.visitor-analytics';

    protected function getHeaderWidgets(): array
    {
        return [
            VisitorTrafficChart::class,
            VisitorDevicesChart::class,
            TopPagesWidget::class,
        ];
    }
}
