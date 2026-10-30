<?php

namespace App\Filament\Resources\Quotations\Tables;

use App\Models\Category;
use App\Models\Quotation;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class QuotationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Ref #')
                    ->badge()
                    ->color('gray')
                    ->copyable()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Client Name')
                    ->description(fn (Quotation $record): ?string => $record->company)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-m-phone')
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('country')
                    ->label('Country')
                    ->badge()
                    ->color('info')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->placeholder('General inquiry')
                    ->sortable(),

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
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state)))
                    ->sortable(),

                TextColumn::make('target_date')
                    ->label('Target Date')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('-'),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'contacted' => 'Contacted',
                        'quoted' => 'Quoted',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('mark_contacted')
                    ->label('Contacted')
                    ->icon('heroicon-m-chat-bubble-left')
                    ->color('info')
                    ->visible(fn (Quotation $record): bool => $record->status === 'pending')
                    ->action(fn (Quotation $record) => $record->update(['status' => 'contacted'])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
