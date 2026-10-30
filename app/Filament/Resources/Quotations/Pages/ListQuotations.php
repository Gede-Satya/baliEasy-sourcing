<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\Quotations\QuotationResource;
use App\Models\Quotation;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListQuotations extends ListRecords
{
    protected static string $resource = QuotationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Quotation Baru')
                ->icon('heroicon-m-plus'),
        ];
    }

    public function getTabs(): array
    {
        $newCount = Quotation::where('status', Quotation::STATUS_NEW)->count();
        $inProgressCount = Quotation::whereIn('status', [Quotation::STATUS_CONTACTED, Quotation::STATUS_QUOTED])->count();
        $closedCount = Quotation::where('status', Quotation::STATUS_CLOSED)->count();
        $totalCount = Quotation::count();

        return [
            'all' => Tab::make('Semua')
                ->badge($totalCount),

            'new' => Tab::make('Perlu Ditindak')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Quotation::STATUS_NEW))
                ->badge($newCount)
                ->badgeColor($newCount > 0 ? 'warning' : 'gray'),

            'in_progress' => Tab::make('Sedang Diproses')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('status', [Quotation::STATUS_CONTACTED, Quotation::STATUS_QUOTED]))
                ->badge($inProgressCount)
                ->badgeColor($inProgressCount > 0 ? 'info' : 'gray'),

            'closed' => Tab::make('Selesai (Deal)')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Quotation::STATUS_CLOSED))
                ->badge($closedCount)
                ->badgeColor('success'),
        ];
    }
}
