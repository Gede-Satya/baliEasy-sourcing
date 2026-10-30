<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Akun Pengguna')
                    ->description('Kelola akun staf dan administrator yang dapat mengakses panel admin.')
                    ->icon('heroicon-m-user')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->required(),

                            TextInput::make('email')
                                ->label('Alamat Email')
                                ->email()
                                ->required()
                                ->unique(ignoreRecord: true),
                        ]),

                        Grid::make(2)->schema([
                            Select::make('role')
                                ->label('Peran / Hak Akses (Role)')
                                ->options([
                                    User::ROLE_SUPER_ADMIN => 'Super Administrator (Akses Penuh)',
                                    User::ROLE_ADMIN => 'Administrator',
                                    User::ROLE_STAFF => 'Staf Operasional',
                                ])
                                ->required()
                                ->default(User::ROLE_STAFF),

                            TextInput::make('password')
                                ->label('Kata Sandi')
                                ->password()
                                ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                                ->dehydrated(fn ($state) => filled($state))
                                ->required(fn (string $operation): bool => $operation === 'create')
                                ->helperText('Biarkan kosong jika tidak ingin mengubah kata sandi.'),
                        ]),
                    ]),
            ]);
    }
}
