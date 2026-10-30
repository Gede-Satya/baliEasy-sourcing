<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('group', 'asc')
            ->columns([
                TextColumn::make('key')
                    ->label('Nama Pengaturan')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'whatsapp_number' => '💬 Nomor WhatsApp',
                        'contact_email' => '✉️ Email Publik Perusahaan',
                        'rfq_notification_email' => '🔔 Email Notifikasi Admin (RFQ)',
                        'address' => '📍 Alamat Kantor / Gudang',
                        'instagram_url' => '📸 Link Akun Instagram',
                        'site_name' => '🏢 Nama Website / Brand',
                        'tagline' => '🏷️ Slogan / Tagline Website',
                        'hero_image' => '🖼️ Foto Utama Hero Banner',
                        'hero_image_caption' => '📝 Keterangan Foto Hero',
                        default => ucwords(str_replace('_', ' ', $state)),
                    })
                    ->description(fn ($record): string => match ($record->key) {
                        'whatsapp_number' => 'Target tombol chat WhatsApp di website publik',
                        'contact_email' => 'Tampil di footer untuk klien mengirim email',
                        'rfq_notification_email' => 'Tujuan pengiriman notifikasi saat ada order/quote baru',
                        'address' => 'Ditampilkan di footer dan halaman Tentang Kami',
                        'instagram_url' => 'Tautan ke profil Instagram resmi',
                        'site_name' => 'Muncul di logo, tab browser (SEO), dan hak cipta',
                        'tagline' => 'Slogan singkat identitas perusahaan',
                        'hero_image' => 'Unggah atau ganti foto banner di bagian teratas website',
                        'hero_image_caption' => 'Teks kecil di bawah foto utama',
                        default => "Kunci konfigurasi teknis: {$record->key}",
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('value')
                    ->label('Nilai yang Aktif Sekarang')
                    ->limit(55)
                    ->tooltip(fn ($record): ?string => $record->value)
                    ->color('primary')
                    ->weight('medium')
                    ->searchable(),

                TextColumn::make('group')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'general' => 'info',
                        'hero' => 'warning',
                        'social' => 'purple',
                        'notification' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'general' => 'Kontak & Info Umum',
                        'hero' => 'Tampilan Beranda',
                        'social' => 'Media Sosial',
                        'notification' => 'Notifikasi Tim',
                        default => ucfirst($state),
                    })
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->since()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah Nilai')
                    ->button()
                    ->color('primary'),
            ])
            ->toolbarActions([]);
    }
}
