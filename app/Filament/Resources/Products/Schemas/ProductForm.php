<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->icon('heroicon-m-information-circle')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                            TextInput::make('name')
                                ->label('Product Title')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                    if ($operation === 'create') {
                                        $set('slug', Str::slug($state));
                                    }
                                }),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('slug')
                                ->required(),
                            FileUpload::make('cover_image')
                                ->label('Cover Photo')
                                ->image()
                                ->disk('public')
                                ->visibility('public')
                                ->directory('products'),
                        ]),
                        Textarea::make('short_description')
                            ->label('Short Summary')
                            ->rows(2)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Full Description')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Craft & Material Specifications')
                    ->icon('heroicon-m-wrench-screwdriver')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('material')
                                ->label('Material')
                                ->placeholder('e.g. Solid Teak Wood, Grade A'),
                            TextInput::make('dimensions')
                                ->label('Dimensions')
                                ->placeholder('e.g. 200 x 90 x 76 cm'),
                            TextInput::make('finish')
                                ->label('Surface / Finish')
                                ->placeholder('e.g. Natural Matte, PU Sealed'),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('moq')
                                ->label('Minimum Order Quantity (MOQ)')
                                ->placeholder('e.g. 5 pcs'),
                            TextInput::make('sort_order')
                                ->label('Display Order')
                                ->numeric()
                                ->default(0),
                        ]),
                    ]),

                Section::make('Visibility & SEO')
                    ->icon('heroicon-m-globe-alt')
                    ->schema([
                        Grid::make(2)->schema([
                            Toggle::make('is_featured')
                                ->label('Feature on Homepage')
                                ->default(false),
                            Toggle::make('is_active')
                                ->label('Active / Visible')
                                ->default(true),
                        ]),
                        TextInput::make('meta_title')
                            ->label('SEO Meta Title'),
                        Textarea::make('meta_description')
                            ->label('SEO Meta Description')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
