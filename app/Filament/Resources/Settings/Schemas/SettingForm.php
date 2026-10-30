<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\Placeholder;
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
                Section::make('Ubah Informasi Website')
                    ->description('Setiap perubahan pada nilai ini akan langsung otomatis tampil di halaman depan website publik.')
                    ->icon('heroicon-m-cog-6-tooth')
                    ->schema([
                        Placeholder::make('penjelasan')
                            ->label('Petunjuk Penggunaan')
                            ->content(fn ($record): string => match ($record?->key) {
                                'whatsapp_number' => 'Masukkan nomor WhatsApp resmi bisnis Anda (disarankan format internasional, misal: +62 812 3456 7890). Nomor ini yang akan dibuka klien saat mengklik tombol WhatsApp di web.',
                                'contact_email' => 'Alamat email publik resmi Anda yang tampil di footer. Klien akan mengirimkan surat pertanyaan ke email ini.',
                                'rfq_notification_email' => 'Alamat email tim internal Anda. Sistem akan mengirim peringatan ke email ini setiap ada klien yang mengisi formulir Request a Quote.',
                                'address' => 'Alamat lengkap kantor, studio kurasi, atau gudang Anda di Bali.',
                                'instagram_url' => 'Tautan profil Instagram bisnis Anda (contoh: https://instagram.com/balieasysourcing).',
                                'site_name' => 'Nama brand bisnis Anda (contoh: Bali Easy Sourcing).',
                                'tagline' => 'Slogan singkat yang mendeskripsikan layanan sourcing Anda.',
                                'hero_image' => 'Link URL foto beresolusi tinggi yang menjadi gambar utama di bagian paling atas beranda web.',
                                'hero_image_caption' => 'Keterangan teks kecil di bawah foto utama hero banner.',
                                default => 'Pastikan nilai yang Anda masukkan sesuai format yang diharapkan oleh halaman web publik.',
                            }),

                        Grid::make(2)->schema([
                            TextInput::make('key')
                                ->label('Kunci Teknis (Sistem)')
                                ->disabled()
                                ->dehydrated(false),

                            Select::make('group')
                                ->label('Kategori Pengaturan')
                                ->options([
                                    'general' => 'Kontak & Info Umum',
                                    'hero' => 'Tampilan Beranda',
                                    'social' => 'Media Sosial',
                                    'notification' => 'Notifikasi Tim',
                                ])
                                ->disabled()
                                ->dehydrated(false),
                        ]),

                        Textarea::make('value')
                            ->label('Isi Nilai Pengaturan (Yang Tampil di Website)')
                            ->helperText('Edit teks di atas, lalu klik tombol Simpan (Save changes) di bawah.')
                            ->rows(3)
                            ->columnSpanFull()
                            ->required(),
                    ]),
            ]);
    }
}
