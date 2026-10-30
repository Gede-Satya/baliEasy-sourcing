<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Quotations\Pages\ViewQuotation;
use App\Models\Quotation;
use Filament\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestQuotations extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Latest RFQ & Quote Inquiries';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Quotation::query()->latest()->limit(8)
            )
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Ref #')
                    ->badge()
                    ->color('gray')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Client Name')
                    ->description(fn (Quotation $record): ?string => $record->company)
                    ->searchable(),

                TextColumn::make('country')
                    ->label('Country')
                    ->badge()
                    ->color('info')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->placeholder('General inquiry'),

                TextColumn::make('target_date')
                    ->label('Target Date')
                    ->date('d M Y')
                    ->placeholder('Flexible'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'contacted' => 'info',
                        'quoted' => 'primary',
                        'in_progress' => 'purple',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state))),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View RFQ')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Quotation $record): string => ViewQuotation::getUrl(['record' => $record])),
                Action::make('mark_contacted')
                    ->label('Mark Contacted')
                    ->icon('heroicon-m-chat-bubble-left-ellipsis')
                    ->color('info')
                    ->visible(fn (Quotation $record): bool => $record->status === 'pending')
                    ->action(fn (Quotation $record) => $record->update(['status' => 'contacted'])),
            ]);
    }
}
