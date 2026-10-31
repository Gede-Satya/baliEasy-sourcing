<?php

namespace App\Filament\Resources\SourcingProjects\Pages;

use App\Filament\Resources\SourcingProjects\SourcingProjectResource;
use App\Models\SourcingProject;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSourcingProjects extends ListRecords
{
    protected static string $resource = SourcingProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Proyek Baru')
                ->icon('heroicon-m-plus'),
        ];
    }

    public function getTabs(): array
    {
        $activeCount = SourcingProject::whereNotIn('stage', [SourcingProject::STAGE_DELIVERED, SourcingProject::STAGE_ON_HOLD])->count();
        $qcCount = SourcingProject::where('stage', SourcingProject::STAGE_QUALITY_CONTROL)->count();
        $deliveredCount = SourcingProject::where('stage', SourcingProject::STAGE_DELIVERED)->count();
        $totalCount = SourcingProject::count();

        return [
            'all' => Tab::make('Semua')
                ->badge($totalCount),

            'active' => Tab::make('Sedang Berjalan')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotIn('stage', [SourcingProject::STAGE_DELIVERED, SourcingProject::STAGE_ON_HOLD]))
                ->badge($activeCount)
                ->badgeColor($activeCount > 0 ? 'info' : 'gray'),

            'qc' => Tab::make('Tahap QC')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('stage', SourcingProject::STAGE_QUALITY_CONTROL))
                ->badge($qcCount)
                ->badgeColor($qcCount > 0 ? 'warning' : 'gray'),

            'delivered' => Tab::make('Selesai Terkirim')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('stage', SourcingProject::STAGE_DELIVERED))
                ->badge($deliveredCount)
                ->badgeColor('success'),
        ];
    }
}

