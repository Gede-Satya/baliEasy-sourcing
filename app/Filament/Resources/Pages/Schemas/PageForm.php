<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten Halaman Statis')
                    ->description('Kelola teks halaman kebijakan, syarat & ketentuan, atau profil.')
                    ->icon('heroicon-m-document-text')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('Judul Halaman')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                    if ($operation === 'create') {
                                        $set('slug', Str::slug($state));
                                    }
                                }),

                            TextInput::make('slug')
                                ->label('Slug URL')
                                ->required()
                                ->unique(ignoreRecord: true),
                        ]),

                        Textarea::make('content')
                            ->label('Isi Konten Halaman')
                            ->rows(8)
                            ->columnSpanFull()
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Status Publikasi')
                            ->default(true)
                            ->required(),
                    ]),

                Section::make('Search Engine Optimization (SEO)')
                    ->description('Pengaturan meta title dan deskripsi untuk hasil pencarian Google.')
                    ->icon('heroicon-m-magnifying-glass')
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->placeholder('Judul yang muncul di tab browser & Google')
                            ->columnSpanFull(),

                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->placeholder('Ringkasan 1-2 kalimat untuk snippet Google...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
