<?php

namespace App\Filament\Resources\Quotations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('reference_no')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('company'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('whatsapp'),
                TextInput::make('country'),
                Select::make('category_id')
                    ->relationship('category', 'name'),
                Select::make('product_id')
                    ->relationship('product', 'name'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('quantity'),
                DatePicker::make('target_date'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('new'),
                Textarea::make('internal_notes')
                    ->columnSpanFull(),
                TextInput::make('ip_address'),
            ]);
    }
}
