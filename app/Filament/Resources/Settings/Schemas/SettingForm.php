<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Configuration Detail')
                    ->description('Changes here take effect immediately across all public web pages.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('key')
                                ->label('Configuration Key')
                                ->disabled(fn (?string $operation): bool => $operation === 'edit')
                                ->required(),
                            Select::make('group')
                                ->options([
                                    'general' => 'General (Contact, Address, Site Info)',
                                    'hero' => 'Hero & Homepage',
                                    'social' => 'Social Media & External Links',
                                    'notification' => 'Notifications & Emails',
                                ])
                                ->required()
                                ->default('general'),
                        ]),
                        Textarea::make('value')
                            ->label('Setting Value (Content displayed on website)')
                            ->rows(4)
                            ->columnSpanFull()
                            ->required(),
                    ]),
            ]);
    }
}
