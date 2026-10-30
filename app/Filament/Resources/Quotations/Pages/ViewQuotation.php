<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\Quotations\QuotationResource;
use App\Models\Quotation;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuotation extends ViewRecord
{
    protected static string $resource = QuotationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('chat_wa')
                ->label('Hubungi via WhatsApp')
                ->icon('heroicon-m-chat-bubble-oval-left-ellipsis')
                ->color('success')
                ->url(function (Quotation $record): ?string {
                    $phone = preg_replace('/[^0-9]/', '', $record->whatsapp ?: '');
                    if (! $phone) {
                        return null;
                    }
                    $text = urlencode("Halo {$record->name}, terima kasih telah menghubungi Bali Easy Sourcing [Ref: {$record->reference_no}]. Kami siap membantu kebutuhan sourcing kriya dan furnitur Anda.");
                    return "https://wa.me/{$phone}?text={$text}";
                }, shouldOpenInNewTab: true)
                ->visible(fn (Quotation $record): bool => ! empty($record->whatsapp)),

            Action::make('mark_contacted')
                ->label('Tandai Telah Dihubungi')
                ->icon('heroicon-m-check')
                ->color('info')
                ->visible(fn (Quotation $record): bool => $record->status === 'new')
                ->action(fn (Quotation $record) => $record->update(['status' => 'contacted'])),

            EditAction::make()
                ->label('Ubah Quotation'),
        ];
    }
}
