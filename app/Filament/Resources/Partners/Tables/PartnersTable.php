<?php

namespace App\Filament\Resources\Partners\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PartnersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order', 'asc')
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Photo')
                    ->square()
                    ->defaultImageUrl(asset('images/placeholder.jpg')),

                TextColumn::make('type')
                    ->label('Category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'stay' => 'indigo',
                        'eat' => 'emerald',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'stay' => 'Where to Stay',
                        'eat' => 'Where to Eat',
                        default => ucfirst($state),
                    })
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Venue Name')
                    ->description(fn ($record): ?string => $record->area)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price_range')
                    ->label('Price Guide')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('phone')
                    ->label('Contact')
                    ->placeholder('-')
                    ->toggleable(),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Category')
                    ->options([
                        'stay' => 'Where to Stay',
                        'eat' => 'Where to Eat',
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                Action::make('view_public')
                    ->label('Lihat di Web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn ($record): string => route('stay-eat', ['type' => $record->type]), shouldOpenInNewTab: true),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
