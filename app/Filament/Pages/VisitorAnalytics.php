<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\RecentVisitorsWidget;
use App\Filament\Widgets\TopPagesWidget;
use App\Filament\Widgets\VisitorDevicesChart;
use App\Filament\Widgets\VisitorOverviewWidget;
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

    /**
     * Header widgets are rendered inside the custom view to ensure exact grid layout
     */
    protected function getHeaderWidgets(): array
    {
        return [];
    }
}
