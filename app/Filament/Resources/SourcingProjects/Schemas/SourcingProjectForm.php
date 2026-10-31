<?php

namespace App\Filament\Resources\SourcingProjects\Schemas;

use App\Models\SourcingProject;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SourcingProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(['lg' => 3])
            ->components([
                // Left Column (2 Cols)
                Group::make([
                    Section::make('Rincian Proyek & Klien')
                        ->description('Identitas proyek sourcing dan data kontak klien')
                        ->icon('heroicon-m-briefcase')
                        ->schema([
                            Grid::make(2)->schema([
                                TextInput::make('project_code')
                                    ->label('Kode Proyek')
                                    ->disabled()
                                    ->dehydrated(false),
                                TextInput::make('title')
                                    ->label('Judul / Deskripsi Ringkas Proyek')
                                    ->required()
                                    ->placeholder('cth. Custom Teak Dining Set & Rattan Chairs for Villa Canggu'),
                            ]),
                            Grid::make(2)->schema([
                                Select::make('category_id')
                                    ->label('Kategori Utama')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload(),
                                Select::make('quotation_id')
                                    ->label('Berasal dari Quotation / RFQ')
                                    ->relationship('quotation', 'reference_no')
                                    ->searchable()
                                    ->preload(),
                            ]),
                            Grid::make(2)->schema([
                                TextInput::make('client_name')
                                    ->label('Nama Klien')
                                    ->required(),
                                TextInput::make('client_company')
                                    ->label('Perusahaan / Studio')
                                    ->placeholder('cth. Studio Atelier Melbourne'),
                            ]),
                            Grid::make(3)->schema([
                                TextInput::make('client_email')
                                    ->label('Email Klien')
                                    ->email()
                                    ->required(),
                                TextInput::make('client_whatsapp')
                                    ->label('WhatsApp Klien')
                                    ->tel()
                                    ->placeholder('+62812...'),
                                TextInput::make('client_country')
                                    ->label('Negara Tujuan')
                                    ->placeholder('Australia'),
                            ]),
                        ]),

                    Section::make('Workshop Pengrajin Mitra')
                        ->description('Informasi pengrajin lokal dan lokasi pengerjaan fisik')
                        ->icon('heroicon-m-building-storefront')
                        ->schema([
                            Grid::make(2)->schema([
                                TextInput::make('workshop_name')
                                    ->label('Nama Workshop Mitra')
                                    ->placeholder('cth. Tegallalang Woodcarver Studio'),
                                TextInput::make('workshop_location')
                                    ->label('Lokasi Workshop')
                                    ->placeholder('cth. Gianyar, Bali'),
                            ]),
                        ]),

                    Section::make('Dokumentasi Foto Workshop & QC')
                        ->description('Foto pengerjaan fisik yang dapat dilihat oleh klien di halaman pelacak')
                        ->icon('heroicon-m-photo')
                        ->schema([
                            FileUpload::make('photos')
                                ->label('Unggah Foto Progres / QC')
                                ->multiple()
                                ->image()
                                ->directory('projects/photos')
                                ->reorderable()
                                ->columnSpanFull(),
                            Textarea::make('client_notes')
                                ->label('Spesifikasi / Catatan Tambahan untuk Klien')
                                ->rows(3)
                                ->placeholder('Rincian pengerjaan kayu, jenis finishing, atau catatan khusus...')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 2]),

                // Right Column (1 Col)
                Group::make([
                    Section::make('Tahapan & Progres Proyek')
                        ->description('Status terkini yang disinkronkan ke tautan pelacak klien')
                        ->icon('heroicon-m-signal')
                        ->schema([
                            Select::make('stage')
                                ->label('Tahapan Saat Ini')
                                ->options(SourcingProject::getStages())
                                ->required()
                                ->default(SourcingProject::STAGE_SAMPLING),

                            TextInput::make('progress_percent')
                                ->label('Persentase Progres (%)')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(100)
                                ->default(15)
                                ->required()
                                ->suffix('%'),

                            DatePicker::make('target_completion_date')
                                ->label('Target Selesai Produksi'),

                            DatePicker::make('estimated_shipping_date')
                                ->label('Estimasi Jadwal Pengapalan (Shipping)'),
                        ]),

                    Section::make('Inspeksi Kualitas (QC)')
                        ->icon('heroicon-m-check-badge')
                        ->schema([
                            DateTimePicker::make('qc_passed_at')
                                ->label('Tanggal & Waktu Lolos QC'),
                            Textarea::make('qc_notes')
                                ->label('Laporan / Catatan QC')
                                ->placeholder('Kelembapan kayu di bawah 12%, finishing clear matte rata, konstruksi kokoh...')
                                ->rows(3),
                        ]),

                    Section::make('Catatan Internal Staf')
                        ->icon('heroicon-m-lock-closed')
                        ->schema([
                            Textarea::make('internal_notes')
                                ->label('Catatan Rahasia Tim')
                                ->placeholder('Catatan harga dasar pengrajin, kontak sopir kargo, remarks...')
                                ->rows(4),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ]);
    }
}

