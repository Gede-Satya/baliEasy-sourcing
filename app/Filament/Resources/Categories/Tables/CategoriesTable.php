<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Models\Category;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order', 'asc')
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Thumbnail')
                    ->square()
                    ->defaultImageUrl(asset('images/placeholder.jpg')),

                TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->formatStateUsing(function (Category $record): string {
                        return $record->parent_id ? "↳ {$record->name}" : $record->name;
                    })
                    ->description(function (Category $record): ?string {
                        return $record->parent_id ? "Sub-kategori dari: {$record->parent?->name}" : $record->slug;
                    })
                    ->weight(fn (Category $record): string => $record->parent_id ? 'medium' : 'bold')
                    ->color(fn (Category $record): ?string => $record->parent_id ? 'primary' : null)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('parent.name')
                    ->label('Kategori Induk')
                    ->badge()
                    ->color(fn (?string $state): string => $state ? 'info' : 'gray')
                    ->placeholder('Paling Atas (Top-level)'),

                TextColumn::make('children_count')
                    ->label('Sub-kategori')
                    ->counts('children')
                    ->badge()
                    ->color(fn (int $state): string => $state > 0 ? 'success' : 'gray')
                    ->sortable(),

                TextColumn::make('products_count')
                    ->label('Produk')
                    ->counts('products')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('parent_id')
                    ->label('Filter Kategori Induk')
                    ->relationship('parent', 'name')
                    ->placeholder('Semua Induk'),
            ])
            ->recordActions([
                Action::make('view_public')
                    ->label('Lihat di Web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn ($record): string => route('categories.show', $record->slug), shouldOpenInNewTab: true),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
