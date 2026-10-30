<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Quotation;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalQuotations = Quotation::count();
        $pendingQuotations = Quotation::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalPartners = Partner::count();
        $totalSubscribers = NewsletterSubscriber::count();

        return [
            Stat::make('Total RFQ / Inquiries', (string) $totalQuotations)
                ->description($pendingQuotations > 0 ? "{$pendingQuotations} pending review" : 'All inquiries reviewed')
                ->descriptionIcon($pendingQuotations > 0 ? 'heroicon-m-exclamation-circle' : 'heroicon-m-check-circle')
                ->color($pendingQuotations > 0 ? 'warning' : 'success')
                ->chart([3, 7, 5, 8, 12, $totalQuotations]),

            Stat::make('Pending Quotes', (string) $pendingQuotations)
                ->description('Awaiting staff action')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingQuotations > 0 ? 'danger' : 'gray'),

            Stat::make('Catalog Products', (string) $totalProducts)
                ->description("Across {$totalCategories} categories")
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('primary'),

            Stat::make('Where to Stay & Eat', (string) $totalPartners)
                ->description('Curated Bali partners')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('info'),

            Stat::make('Newsletter Leads', (string) $totalSubscribers)
                ->description('Active catalog subscribers')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('success'),
        ];
    }
}
