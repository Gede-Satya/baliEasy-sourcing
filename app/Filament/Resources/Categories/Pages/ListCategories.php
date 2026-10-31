<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use App\Models\Category;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Kategori Baru')
                ->icon('heroicon-m-plus'),
        ];
    }

    public function getTabs(): array
    {
        $totalCount = Category::count();
        $rootCount = Category::whereNull('parent_id')->count();
        $childCount = Category::whereNotNull('parent_id')->count();

        return [
            'all' => Tab::make('Semua')
                ->badge($totalCount),

            'roots' => Tab::make('Kategori Induk Utama')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('parent_id'))
                ->badge($rootCount)
                ->badgeColor('primary'),

            'children' => Tab::make('Sub-kategori Turunan')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('parent_id'))
                ->badge($childCount)
                ->badgeColor('info'),
        ];
    }
}
