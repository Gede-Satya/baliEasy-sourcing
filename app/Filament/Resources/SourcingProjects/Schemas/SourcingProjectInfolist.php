<?php

namespace App\Filament\Resources\SourcingProjects\Schemas;

use App\Models\SourcingProject;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SourcingProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(['lg' => 3])
            ->components([
                // Left Column (2 Cols)
                Group::make([
                    Section::make('Rincian Proyek Sourcing')
                        ->icon('heroicon-m-briefcase')
                        ->schema([
                            Grid::make(2)->schema([
                                TextEntry::make('project_code')
                                    ->label('Kode Proyek')
                                    ->fontFamily('mono')
                                    ->weight('bold')
                                    ->copyable(),

                                TextEntry::make('category.name')
                                    ->label('Kategori Utama')
                                    ->badge()
                                    ->color('gray')
                                    ->placeholder('Umum'),
                            ]),

                            TextEntry::make('title')
                                ->label('Judul Proyek')
                                ->weight('semibold')
                                ->columnSpanFull(),

                            Grid::make(2)->schema([
                                TextEntry::make('workshop_name')
                                    ->label('Workshop Pengrajin')
                                    ->placeholder('Belum Ditugaskan'),

                                TextEntry::make('workshop_location')
                                    ->label('Lokasi Workshop')
                                    ->placeholder('Bali'),
                            ]),

                            TextEntry::make('client_notes')
                                ->label('Spesifikasi Kebutuhan Proyek')
                                ->placeholder('Tidak ada catatan khusus.')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Dokumentasi Foto Workshop & Inspeksi QC')
                        ->icon('heroicon-m-photo')
                        ->schema([
                            ImageEntry::make('photos')
                                ->label('Galeri Foto Produksi')
                                ->columnSpanFull(),

                            TextEntry::make('qc_notes')
                                ->label('Catatan Inspeksi Quality Control (QC)')
                                ->placeholder('Belum ada catatan inspeksi QC.')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Catatan Internal Staf')
                        ->icon('heroicon-m-lock-closed')
                        ->schema([
                            TextEntry::make('internal_notes')
                                ->label('Catatan Rahasia Tim')
                                ->placeholder('Belum ada catatan internal staf.')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 2]),

                // Right Column (1 Col)
                Group::make([
                    Section::make('Status & Progres Pengerjaan')
                        ->icon('heroicon-m-signal')
                        ->schema([
                            TextEntry::make('stage')
                                ->label('Tahapan Saat Ini')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'sampling' => 'warning',
                                    'production' => 'info',
                                    'quality_control' => 'purple',
                                    'packing_stuffing' => 'primary',
                                    'shipping' => 'indigo',
                                    'delivered' => 'success',
                                    'on_hold' => 'danger',
                                    default => 'gray',
                                })
                                ->formatStateUsing(fn (string $state): string => SourcingProject::getStages()[$state] ?? ucfirst($state)),

                            TextEntry::make('progress_percent')
                                ->label('Persentase Progres')
                                ->formatStateUsing(fn (int $state): string => "{$state}%")
                                ->badge()
                                ->color(fn (int $state): string => $state >= 100 ? 'success' : 'info'),

                            TextEntry::make('target_completion_date')
                                ->label('Target Selesai')
                                ->date('d M Y')
                                ->placeholder('-'),

                            TextEntry::make('estimated_shipping_date')
                                ->label('Estimasi Pengapalan')
                                ->date('d M Y')
                                ->placeholder('-'),
                        ]),

                    Section::make('Kontak Klien')
                        ->icon('heroicon-m-user')
                        ->schema([
                            TextEntry::make('client_name')
                                ->label('Nama Klien')
                                ->weight('medium'),

                            TextEntry::make('client_company')
                                ->label('Perusahaan / Studio')
                                ->placeholder('-'),

                            TextEntry::make('client_email')
                                ->label('Email')
                                ->copyable(),

                            TextEntry::make('client_whatsapp')
                                ->label('WhatsApp')
                                ->copyable()
                                ->placeholder('-')
                                ->url(function (SourcingProject $record): ?string {
                                    $phone = preg_replace('/[^0-9]/', '', $record->client_whatsapp ?: '');
                                    return $phone ? "https://wa.me/{$phone}" : null;
                                }, shouldOpenInNewTab: true),

                            TextEntry::make('client_country')
                                ->label('Negara Tujuan')
                                ->placeholder('-'),
                        ]),

                    Section::make('Tautan Pelacak Klien (Secret URL)')
                        ->description('Bagikan tautan ini kepada klien untuk memantau pengerjaan secara langsung')
                        ->icon('heroicon-m-link')
                        ->schema([
                            TextEntry::make('tracking_url')
                                ->label('URL Pelacakan')
                                ->copyable()
                                ->url(fn (SourcingProject $record): string => $record->tracking_url, shouldOpenInNewTab: true)
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ]);
    }
}
