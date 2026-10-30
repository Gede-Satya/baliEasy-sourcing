<?php

namespace App\Filament\Resources\Quotations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuotationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Client Information')
                    ->icon('heroicon-m-user')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('reference_no')
                                ->label('Reference #')
                                ->badge()
                                ->color('primary'),
                            TextEntry::make('name')
                                ->label('Client Name'),
                            TextEntry::make('company')
                                ->label('Company')
                                ->placeholder('-'),
                            TextEntry::make('email')
                                ->label('Email Address')
                                ->copyable(),
                            TextEntry::make('whatsapp')
                                ->label('WhatsApp')
                                ->copyable()
                                ->placeholder('-'),
                            TextEntry::make('country')
                                ->label('Country')
                                ->badge()
                                ->color('info')
                                ->placeholder('-'),
                        ]),
                    ]),

                Section::make('Sourcing Requirements')
                    ->icon('heroicon-m-clipboard-document-list')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('category.name')
                                ->label('Category')
                                ->placeholder('General Sourcing'),
                            TextEntry::make('product.name')
                                ->label('Product')
                                ->placeholder('-'),
                            TextEntry::make('quantity')
                                ->label('Requested Volume')
                                ->placeholder('-'),
                            TextEntry::make('target_date')
                                ->label('Target Date')
                                ->date('d M Y')
                                ->placeholder('Flexible'),
                            TextEntry::make('created_at')
                                ->label('Date Submitted')
                                ->dateTime('d M Y, H:i'),
                            TextEntry::make('status')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'pending' => 'warning',
                                    'contacted' => 'info',
                                    'quoted' => 'primary',
                                    'in_progress' => 'purple',
                                    'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'gray',
                                }),
                        ]),
                        TextEntry::make('description')
                            ->label('Project Description')
                            ->columnSpanFull()
                            ->placeholder('-'),
                        TextEntry::make('notes')
                            ->label('Client Notes')
                            ->columnSpanFull()
                            ->placeholder('-'),
                    ]),

                Section::make('Internal Team Notes')
                    ->icon('heroicon-m-lock-closed')
                    ->schema([
                        TextEntry::make('internal_notes')
                            ->label('Staff Remarks')
                            ->columnSpanFull()
                            ->placeholder('No internal notes recorded yet.'),
                    ]),
            ]);
    }
}
