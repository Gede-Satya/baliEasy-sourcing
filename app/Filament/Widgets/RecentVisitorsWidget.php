<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentVisitorsWidget extends TableWidget
{
    protected static ?int $sort = 6;

    protected static ?string $heading = 'Log Kunjungan Langsung (Real-time Visitors Log)';

    protected static ?string $description = 'Aktivitas kunjungan halaman publik terbaru yang tercatat secara otomatis oleh sistem pelacak.';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $pollingInterval = '15s';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PageView::query()->latest('created_at')
            )
            ->defaultPaginationPageOption(10)
            ->paginationPageOptions([10, 25, 50])
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu Kunjungan')
                    ->dateTime('d M Y, H:i:s')
                    ->description(fn (PageView $record): string => $record->created_at->diffForHumans())
                    ->sortable(),

                TextColumn::make('page_title')
                    ->label('Halaman Dikunjungi')
                    ->state(fn (PageView $record): string => $record->page_title ?: $record->path)
                    ->description(fn (PageView $record): string => $record->path)
                    ->url(fn (PageView $record): string => url($record->path), shouldOpenInNewTab: true)
                    ->searchable()
                    ->weight('medium'),

                TextColumn::make('device')
                    ->label('Perangkat')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Mobile' => 'warning',
                        'Tablet' => 'gray',
                        default => 'info',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'Mobile' => 'heroicon-m-device-phone-mobile',
                        'Tablet' => 'heroicon-m-device-tablet',
                        default => 'heroicon-m-computer-desktop',
                    }),

                TextColumn::make('browser')
                    ->label('Browser / OS')
                    ->state(fn (PageView $record): string => $record->browser ?: 'Browser')
                    ->description(fn (PageView $record): string => $record->platform ?: 'OS Tidak Diketahui'),

                TextColumn::make('referer')
                    ->label('Sumber Rujukan (Referer)')
                    ->state(fn (PageView $record): string => $record->referer ? parse_url($record->referer, PHP_URL_HOST) ?: $record->referer : 'Langsung (Direct / Bookmark)')
                    ->tooltip(fn (PageView $record): ?string => $record->referer)
                    ->limit(35),

                TextColumn::make('locale')
                    ->label('Bahasa')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn (?string $state): string => strtoupper($state ?: 'EN')),
            ])
            ->emptyStateHeading('Belum Ada Aktivitas Kunjungan')
            ->emptyStateDescription('Kunjungan dari pengunjung website publik akan langsung muncul di tabel ini.')
            ->emptyStateIcon('heroicon-o-signal');
    }
}

