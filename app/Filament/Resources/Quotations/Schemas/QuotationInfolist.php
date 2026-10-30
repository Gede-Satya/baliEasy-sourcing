<?php

namespace App\Filament\Resources\Quotations\Schemas;

use App\Models\Quotation;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuotationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(['lg' => 3])
            ->components([
                // Left Column (2 Cols): Project Sourcing Details & Internal Team Notes
                Group::make([
                    Section::make('Kebutuhan Sourcing & Spesifikasi')
                        ->icon('heroicon-m-clipboard-document-list')
                        ->schema([
                            Grid::make(2)->schema([
                                TextEntry::make('category.name')
                                    ->label('Kategori Utama')
                                    ->placeholder('Sourcing Umum / Belum Ditentukan')
                                    ->badge()
                                    ->color('gray'),

                                TextEntry::make('product.name')
                                    ->label('Produk Spesifik')
                                    ->placeholder('-'),

                                TextEntry::make('quantity')
                                    ->label('Estimasi Volume / Jumlah')
                                    ->placeholder('-')
                                    ->weight('medium'),

                                TextEntry::make('target_date')
                                    ->label('Target Pengiriman')
                                    ->date('d M Y')
                                    ->placeholder('Fleksibel'),
                            ]),

                            TextEntry::make('description')
                                ->label('Rincian Kebutuhan Proyek')
                                ->placeholder('-')
                                ->columnSpanFull(),

                            TextEntry::make('notes')
                                ->label('Catatan Tambahan dari Klien')
                                ->placeholder('-')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Catatan Internal Tim')
                        ->description('Catatan komunikasi supplier, penawaran harga, dan logistik')
                        ->icon('heroicon-m-lock-closed')
                        ->schema([
                            TextEntry::make('internal_notes')
                                ->label('Catatan Staf')
                                ->placeholder('Belum ada catatan internal tim.')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 2]),

                // Right Column (1 Col): Status & Client Information
                Group::make([
                    Section::make('Status RFQ')
                        ->icon('heroicon-m-signal')
                        ->schema([
                            TextEntry::make('status')
                                ->label('Status Saat Ini')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'new' => 'warning',
                                    'contacted' => 'info',
                                    'quoted' => 'primary',
                                    'closed' => 'success',
                                    'lost' => 'danger',
                                    default => 'gray',
                                })
                                ->formatStateUsing(fn (string $state): string => match ($state) {
                                    'new' => 'Baru Masuk',
                                    'contacted' => 'Dihubungi',
                                    'quoted' => 'Penawaran Terkirim',
                                    'closed' => 'Selesai (Deal)',
                                    'lost' => 'Batal / Lost',
                                    default => ucfirst($state),
                                }),

                            TextEntry::make('reference_no')
                                ->label('Ref #')
                                ->fontFamily('mono')
                                ->copyable(),

                            TextEntry::make('created_at')
                                ->label('Waktu Masuk')
                                ->dateTime('d M Y, H:i'),
                        ]),

                    Section::make('Informasi Klien')
                        ->icon('heroicon-m-user')
                        ->schema([
                            TextEntry::make('name')
                                ->label('Nama Klien')
                                ->weight('semibold'),

                            TextEntry::make('company')
                                ->label('Perusahaan / Studio')
                                ->placeholder('-'),

                            TextEntry::make('email')
                                ->label('Email')
                                ->copyable(),

                            TextEntry::make('whatsapp')
                                ->label('WhatsApp')
                                ->copyable()
                                ->placeholder('-')
                                ->url(function (Quotation $record): ?string {
                                    $phone = preg_replace('/[^0-9]/', '', $record->whatsapp ?: '');
                                    return $phone ? "https://wa.me/{$phone}" : null;
                                }, shouldOpenInNewTab: true),

                            TextEntry::make('country')
                                ->label('Negara Tujuan')
                                ->placeholder('-'),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ]);
    }
}
