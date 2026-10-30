<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
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
                                'hero_image' => 'Unggah file gambar dari komputer Anda (JPG, PNG, WebP) atau masukkan tautan URL gambar.',
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

                        Placeholder::make('current_image_preview')
                            ->label('Pratinjau Gambar Saat Ini')
                            ->content(fn ($record) => $record?->value ? new \Illuminate\Support\HtmlString('<div class="mt-1"><img src="' . (str_starts_with($record->value, 'http') ? e($record->value) : e(asset('storage/' . $record->value))) . '" alt="Pratinjau Banner" class="h-40 w-auto rounded border border-stone-200 shadow-sm object-cover" /></div>') : 'Belum ada gambar')
                            ->visible(fn ($record) => $record?->key === 'hero_image'),

                        FileUpload::make('value')
                            ->label('Unggah Foto Hero Banner Baru')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->imageEditor()
                            ->helperText('Pilih atau seret gambar dari komputer Anda (JPG, PNG, WebP). Gambar ini akan otomatis muncul di banner atas website.')
                            ->columnSpanFull()
                            ->visible(fn ($record) => $record?->key === 'hero_image'),

                        Textarea::make('value')
                            ->label('Isi Nilai Pengaturan (Yang Tampil di Website)')
                            ->helperText('Edit teks di atas, lalu klik tombol Simpan (Save changes) di bawah.')
                            ->rows(3)
                            ->columnSpanFull()
                            ->visible(fn ($record) => $record?->key !== 'hero_image')
                            ->required(fn ($record) => $record?->key !== 'hero_image'),
                    ]),
            ]);
    }
}
