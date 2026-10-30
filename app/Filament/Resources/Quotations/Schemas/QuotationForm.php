<?php

namespace App\Filament\Resources\Quotations\Schemas;

use App\Models\Quotation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(['lg' => 3])
            ->components([
                // Main / Left Column (2 Cols wide on desktop)
                Group::make([
                    Section::make('Informasi Klien & Kontak')
                        ->description('Identitas dan saluran kontak pemohon inquiry')
                        ->icon('heroicon-m-user')
                        ->schema([
                            Grid::make(2)->schema([
                                TextInput::make('reference_no')
                                    ->label('Nomor Referensi (Ref #)')
                                    ->disabled()
                                    ->dehydrated(false),
                                TextInput::make('country')
                                    ->label('Negara Tujuan')
                                    ->placeholder('cth. Australia, United States'),
                            ]),
                            Grid::make(2)->schema([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required(),
                                TextInput::make('company')
                                    ->label('Perusahaan / Studio Desain')
                                    ->placeholder('cth. Bali Villa Concepts'),
                            ]),
                            Grid::make(2)->schema([
                                TextInput::make('email')
                                    ->label('Alamat Email')
                                    ->email()
                                    ->required(),
                                TextInput::make('whatsapp')
                                    ->label('WhatsApp / Telepon')
                                    ->tel()
                                    ->helperText('Gunakan format internasional, cth: +6281234567890'),
                            ]),
                        ]),

                    Section::make('Spesifikasi Kebutuhan Sourcing')
                        ->description('Kategori produk, kuantitas perkiraan, dan tenggat waktu')
                        ->icon('heroicon-m-clipboard-document-list')
                        ->schema([
                            Grid::make(2)->schema([
                                Select::make('category_id')
                                    ->label('Kategori Utama')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload(),
                                Select::make('product_id')
                                    ->label('Produk Spesifik (Opsional)')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->preload(),
                            ]),
                            Grid::make(2)->schema([
                                TextInput::make('quantity')
                                    ->label('Estimasi Volume / Jumlah')
                                    ->placeholder('cth. 50 pcs, 1 kontainer 20ft'),
                                DatePicker::make('target_date')
                                    ->label('Target Pengiriman / Selesai'),
                            ]),
                            Textarea::make('description')
                                ->label('Deskripsi Kebutuhan & Spesifikasi Proyek')
                                ->placeholder('Rincian dimensi, material kayu/rotan/batu, finishing, referensi visual...')
                                ->rows(4)
                                ->columnSpanFull(),
                            Textarea::make('notes')
                                ->label('Catatan Tambahan dari Klien')
                                ->rows(2)
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 2]),

                // Sidebar / Right Column (1 Col wide on desktop)
                Group::make([
                    Section::make('Status & Tindak Lanjut')
                        ->description('Progres penanganan oleh tim sourcing')
                        ->icon('heroicon-m-cog-6-tooth')
                        ->schema([
                            Select::make('status')
                                ->label('Status RFQ')
                                ->options([
                                    'new' => 'Baru Masuk (Perlu Ditinjau)',
                                    'contacted' => 'Dihubungi (Sedang Diskusi)',
                                    'quoted' => 'Penawaran Terkirim (Quoted)',
                                    'closed' => 'Selesai (Closed Deal)',
                                    'lost' => 'Batal / Tidak Lanjut (Lost)',
                                ])
                                ->required()
                                ->default('new'),
                            Textarea::make('internal_notes')
                                ->label('Catatan Internal Staf')
                                ->placeholder('Kontak pengrajin/supplier, estimasi biaya logistik, progres sampling...')
                                ->rows(6)
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ]);
    }
}
