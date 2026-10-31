<?php

namespace App\Filament\Resources\SourcingProjects\Pages;

use App\Filament\Resources\SourcingProjects\SourcingProjectResource;
use App\Models\SourcingProject;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSourcingProject extends ViewRecord
{
    protected static string $resource = SourcingProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('chat_wa')
                ->label('Kirim Update WhatsApp ke Klien')
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

            Action::make('view_tracking')
                ->label('Buka Link Pelacak Klien')
                ->icon('heroicon-m-arrow-top-right-on-square')
                ->color('info')
                ->url(fn (SourcingProject $record): string => $record->tracking_url, shouldOpenInNewTab: true),

            EditAction::make()
                ->label('Ubah Proyek'),
        ];
    }
}

