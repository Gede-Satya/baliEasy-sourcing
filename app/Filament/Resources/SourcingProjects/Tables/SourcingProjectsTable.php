<?php

namespace App\Filament\Resources\SourcingProjects\Tables;

use App\Models\SourcingProject;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SourcingProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('project_code')
                    ->label('Kode Proyek')
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->copyable()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Judul Proyek & Klien')
                    ->weight('semibold')
                    ->description(function (SourcingProject $record): string {
                        $parts = array_filter([$record->client_name, $record->client_company, $record->client_country]);
                        return implode(' · ', $parts);
                    })
                    ->searchable(['title', 'client_name', 'client_company', 'client_country'])
                    ->sortable(),

                TextColumn::make('workshop_name')
                    ->label('Workshop Mitra')
                    ->placeholder('Belum Ditugaskan')
                    ->description(fn (SourcingProject $record): ?string => $record->workshop_location),

                TextColumn::make('stage')
                    ->label('Tahapan')
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
                    ->formatStateUsing(fn (string $state): string => SourcingProject::getStages()[$state] ?? ucfirst($state))
                    ->sortable(),

                TextColumn::make('progress_percent')
                    ->label('Progres')
                    ->formatStateUsing(fn (int $state): string => "{$state}%")
                    ->badge()
                    ->color(fn (int $state): string => $state >= 100 ? 'success' : ($state >= 60 ? 'info' : 'warning'))
                    ->sortable(),

                TextColumn::make('target_completion_date')
                    ->label('Target Selesai')
                    ->date('d M Y')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->dateTimeTooltip('d M Y, H:i:s')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('stage')
                    ->label('Tahapan Proyek')
                    ->options(SourcingProject::getStages()),
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
            ])
            ->recordActions([
                Action::make('chat_wa')
                    ->label('WhatsApp')
                    ->icon('heroicon-m-chat-bubble-oval-left-ellipsis')
                    ->color('success')
                    ->url(function (SourcingProject $record): ?string {
                        $phone = preg_replace('/[^0-9]/', '', $record->client_whatsapp ?: '');
                        if (! $phone) {
                            return null;
                        }
                        $text = urlencode($record->getWhatsAppUpdateText());
                        return "https://wa.me/{$phone}?text={$text}";
                    }, shouldOpenInNewTab: true)
                    ->visible(fn (SourcingProject $record): bool => ! empty($record->client_whatsapp)),

                Action::make('tracking_link')
                    ->label('Pelacak')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('info')
                    ->url(fn (SourcingProject $record): string => $record->tracking_url, shouldOpenInNewTab: true),

                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

