<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kategori')
                    ->description('Detail nama kategori material dan struktur hirarki katalog.')
                    ->icon('heroicon-m-squares-2x2')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Kategori')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                    if ($operation === 'create') {
                                        $set('slug', Str::slug($state));
                                    }
                                }),

                            TextInput::make('slug')
                                ->label('Slug URL Publik')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->helperText('Contoh: solid-wood (akan membentuk URL /categories/solid-wood)'),
                        ]),

                        Grid::make(3)->schema([
                            Select::make('parent_id')
                                ->label('Kategori Induk (Parent)')
                                ->relationship('parent', 'name')
                                ->placeholder('Paling Atas (Top-level)')
                                ->searchable()
                                ->preload(),

                            TextInput::make('sort_order')
                                ->label('Urutan Tampilan')
                                ->required()
                                ->numeric()
                                ->default(0),

                            Toggle::make('is_active')
                                ->label('Status Aktif')
                                ->helperText('Tampilkan di website publik')
                                ->default(true)
                                ->required(),
                        ]),
                    ]),

                Section::make('Foto Sampul & Deskripsi')
                    ->description('Foto representasi material kriya dan keterangan singkat.')
                    ->icon('heroicon-m-photo')
                    ->schema([
                        FileUpload::make('cover_image')
                            ->label('Foto Sampul Kategori')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('categories')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Deskripsi Material & Workshop')
                            ->placeholder('Jelaskan jenis material, karakter pengerjaan, dan standar workshop di Bali/Jepara...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
