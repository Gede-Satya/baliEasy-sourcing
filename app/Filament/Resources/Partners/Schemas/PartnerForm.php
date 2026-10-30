<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Venue Overview')
                    ->icon('heroicon-m-building-storefront')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('type')
                                ->label('Directory Category')
                                ->options([
                                    'stay' => 'Where to Stay (Hotels, Villas, Resorts)',
                                    'eat' => 'Where to Eat (Restaurants, Cafes, Beach Clubs)',
                                ])
                                ->required()
                                ->default('stay'),
                            TextInput::make('name')
                                ->label('Venue Name')
                                ->required(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('slug')
                                ->required(),
                            TextInput::make('area')
                                ->label('Neighborhood / Area')
                                ->placeholder('e.g. Seminyak, Canggu, Ubud')
                                ->required(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('price_range')
                                ->label('Price Range Guide')
                                ->placeholder('e.g. $$$ · Luxury / $$ · Moderate'),
                            FileUpload::make('cover_image')
                                ->label('Cover Image')
                                ->image()
                                ->directory('partners'),
                        ]),
                        Textarea::make('description')
                            ->label('Description & Atmosphere')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Contact & Web Links')
                    ->icon('heroicon-m-link')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('phone')
                                ->label('Contact Phone / WhatsApp')
                                ->tel(),
                            TextInput::make('website_url')
                                ->label('Official Website URL')
                                ->url(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('instagram_url')
                                ->label('Instagram URL')
                                ->url(),
                            TextInput::make('maps_url')
                                ->label('Google Maps URL')
                                ->url(),
                        ]),
                    ]),

                Section::make('Settings & Visibility')
                    ->icon('heroicon-m-eye')
                    ->schema([
                        Grid::make(3)->schema([
                            Toggle::make('is_featured')
                                ->label('Featured Partner')
                                ->default(false),
                            Toggle::make('is_active')
                                ->label('Active on Website')
                                ->default(true),
                            TextInput::make('sort_order')
                                ->label('Sort Order')
                                ->numeric()
                                ->default(0),
                        ]),
                    ]),
            ]);
    }
}
