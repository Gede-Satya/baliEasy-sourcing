<?php

namespace App\Filament\Resources\Quotations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Client Information')
                    ->description('Contact details submitted by the client')
                    ->icon('heroicon-m-user')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('reference_no')
                                ->label('Reference Number')
                                ->disabled()
                                ->dehydrated(false),
                            TextInput::make('country')
                                ->label('Destination Country')
                                ->placeholder('e.g. Australia, United States'),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Full Name')
                                ->required(),
                            TextInput::make('company')
                                ->label('Company / Studio Name')
                                ->placeholder('e.g. Bali Villa Concepts'),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->required(),
                            TextInput::make('whatsapp')
                                ->label('WhatsApp / Phone')
                                ->tel(),
                        ]),
                    ]),

                Section::make('Sourcing Specifications')
                    ->description('Client project requirements, volumes, and timeline')
                    ->icon('heroicon-m-clipboard-document-list')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('category_id')
                                ->label('Primary Category')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->preload(),
                            Select::make('product_id')
                                ->label('Specific Product (Optional)')
                                ->relationship('product', 'name')
                                ->searchable()
                                ->preload(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('quantity')
                                ->label('Estimated Quantity / Volume')
                                ->placeholder('e.g. 50 pcs, 1 x 20ft Container'),
                            DatePicker::make('target_date')
                                ->label('Target Delivery / Completion Date'),
                        ]),
                        Textarea::make('description')
                            ->label('Project Description & Requirements')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('notes')
                            ->label('Additional Client Notes')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),

                Section::make('Admin & Processing')
                    ->description('Status and internal notes for the sourcing team')
                    ->icon('heroicon-m-cog-6-tooth')
                    ->schema([
                        Select::make('status')
                            ->label('Quotation Status')
                            ->options([
                                'pending' => 'Pending (New Inquiry)',
                                'contacted' => 'Contacted (Client in touch)',
                                'quoted' => 'Quoted (Price provided)',
                                'in_progress' => 'In Progress (Sampling/Production)',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->default('pending'),
                        Textarea::make('internal_notes')
                            ->label('Internal Notes (Staff only)')
                            ->placeholder('Supplier contacts, negotiated prices, freight remarks...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
