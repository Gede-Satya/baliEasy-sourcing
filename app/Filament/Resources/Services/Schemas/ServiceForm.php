<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Layanan & Nilai Sourcing')
                    ->description('Layanan atau pilar keunggulan yang ditampilkan pada halaman About Us & How It Works.')
                    ->icon('heroicon-m-shield-check')
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama Layanan / Nilai')
                            ->placeholder('Contoh: Quality Control Inspection, Transparent Pricing')
                            ->required(),

                        Textarea::make('description')
                            ->label('Uraian Layanan')
                            ->placeholder('Jelaskan bagaimana layanan ini melindungi kepentingan buyer...')
                            ->rows(3)
                            ->columnSpanFull(),

                        Grid::make(3)->schema([
                            TextInput::make('icon')
                                ->label('Kode Ikon (Heroicons)')
                                ->placeholder('heroicon-o-check-badge'),

                            TextInput::make('sort_order')
                                ->label('Urutan')
                                ->required()
                                ->numeric()
                                ->default(0),

                            Toggle::make('is_active')
                                ->label('Aktif')
                                ->default(true)
                                ->required(),
                        ]),
                    ]),
            ]);
    }
}
