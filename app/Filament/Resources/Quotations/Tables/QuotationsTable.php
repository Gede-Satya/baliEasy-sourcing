<?php

namespace App\Filament\Resources\Quotations\Tables;

use App\Models\Category;
use App\Models\Quotation;
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

class QuotationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('reference_no')
                    ->label('Ref #')
                    ->fontFamily('mono')
                    ->weight('medium')
                    ->copyable()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Klien & Perusahaan')
                    ->weight('semibold')
                    ->description(function (Quotation $record): ?string {
                        $parts = array_filter([$record->company, $record->country]);
                        return count($parts) ? implode(' · ', $parts) : null;
                    })
                    ->searchable(['name', 'company', 'country'])
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->placeholder('-')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->placeholder('Umum / General')
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('quantity')
                    ->label('Estimasi Volume')
                    ->placeholder('-')
                    ->limit(20)
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Status')
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
                    })
                    ->sortable(),

                TextColumn::make('target_date')
                    ->label('Target Selesai')
                    ->date('d M Y')
                    ->placeholder('Fleksibel')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Masuk')
                    ->since()
                    ->dateTimeTooltip('d M Y, H:i:s')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'new' => 'Baru Masuk',
                        'contacted' => 'Dihubungi',
                        'quoted' => 'Penawaran Terkirim',
                        'closed' => 'Selesai (Deal)',
                        'lost' => 'Batal / Lost',
                    ]),
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
            ])
            ->recordActions([
                Action::make('chat_wa')
                    ->label('WhatsApp')
                    ->icon('heroicon-m-chat-bubble-oval-left-ellipsis')
                    ->color('success')
                    ->url(function (Quotation $record): ?string {
                        $phone = preg_replace('/[^0-9]/', '', $record->whatsapp ?: '');
                        if (! $phone) {
                            return null;
                        }
                        $text = urlencode("Halo {$record->name}, terima kasih telah mengajukan Request for Quote di Bali Easy Sourcing [Ref: {$record->reference_no}]. Kami ingin mendiskusikan rincian kebutuhan sourcing Anda.");
                        return "https://wa.me/{$phone}?text={$text}";
                    }, shouldOpenInNewTab: true)
                    ->visible(fn (Quotation $record): bool => ! empty($record->whatsapp)),

                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    Action::make('convert_to_project')
                        ->label('Konversi ke Proyek Sourcing')
                        ->icon('heroicon-m-briefcase')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->modalHeading('Konversi RFQ Menjadi Proyek Sourcing Aktif')
                        ->modalDescription('Tindakan ini akan membuat Proyek Sourcing baru yang terhubung ke klien ini dan menghasilkan tautan pelacakan langsung.')
                        ->action(function (Quotation $record) {
                            $project = \App\Models\SourcingProject::create([
                                'quotation_id' => $record->id,
                                'title' => $record->description ? \Illuminate\Support\Str::limit($record->description, 80) : "Sourcing Project for {$record->name}",
                                'category_id' => $record->category_id,
                                'client_name' => $record->name,
                                'client_company' => $record->company,
                                'client_email' => $record->email,
                                'client_whatsapp' => $record->whatsapp,
                                'client_country' => $record->country,
                                'client_notes' => $record->description,
                                'stage' => \App\Models\SourcingProject::STAGE_SAMPLING,
                                'progress_percent' => 15,
                                'target_completion_date' => $record->target_date,
                            ]);

                            $record->update(['status' => 'closed']);

                            \Filament\Notifications\Notification::make()
                                ->title('Proyek Sourcing Berhasil Dibuat')
                                ->body("Proyek {$project->project_code} telah dibuat.")
                                ->success()
                                ->send();

                            return redirect(\App\Filament\Resources\SourcingProjects\SourcingProjectResource::getUrl('view', ['record' => $project]));
                        }),
                    Action::make('mark_contacted')
                        ->label('Tandai Dihubungi')
                        ->icon('heroicon-m-check')
                        ->color('info')
                        ->visible(fn (Quotation $record): bool => $record->status === 'new')
                        ->action(fn (Quotation $record) => $record->update(['status' => 'contacted'])),
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
