<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TopPagesWidget extends TableWidget
{
    protected static ?int $sort = 5;

    protected static ?string $heading = 'Halaman Paling Banyak Dikunjungi (Top Pages)';

    protected int | string | array $columnSpan = 'full';

    public function getTableRecordKey(Model | array $record): string
    {
        return (string) ($record->path ?? $record->id ?? spl_object_hash($record));
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PageView::query()
                    ->select(DB::raw('MIN(id) as id'), 'path', 'page_title', DB::raw('COUNT(*) as total_views'), DB::raw('COUNT(DISTINCT ip_hash) as unique_visitors'), DB::raw('MAX(created_at) as last_visited_at'))
                    ->groupBy('path', 'page_title')
                    ->orderByDesc('total_views')
            )
            ->columns([
                TextColumn::make('page_title')
                    ->label('Nama Halaman')
                    ->description(fn ($record): string => $record->path)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('total_views')
                    ->label('Total Kunjungan')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('unique_visitors')
                    ->label('Pengunjung Unik')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('last_visited_at')
                    ->label('Kunjungan Terakhir')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->paginated([5, 10]);
    }
}
