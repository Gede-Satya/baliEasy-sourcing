<?php

namespace App\Filament\Resources\Quotations\Pages;

use App\Filament\Resources\Quotations\QuotationResource;
use App\Filament\Resources\SourcingProjects\SourcingProjectResource;
use App\Models\Quotation;
use App\Models\SourcingProject;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Str;

class ViewQuotation extends ViewRecord
{
    protected static string $resource = QuotationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('convert_to_project')
                ->label('Konversi ke Proyek Sourcing')
                ->icon('heroicon-m-briefcase')
                ->color('primary')
                ->requiresConfirmation()
                ->modalHeading('Konversi RFQ Menjadi Proyek Sourcing Aktif')
                ->modalDescription('Tindakan ini akan membuat Proyek Sourcing baru yang terhubung ke klien ini dan menghasilkan tautan pelacakan langsung.')
                ->action(function (Quotation $record) {
                    $project = SourcingProject::create([
                        'quotation_id' => $record->id,
                        'title' => $record->description ? Str::limit($record->description, 80) : "Sourcing Project for {$record->name}",
                        'category_id' => $record->category_id,
                        'client_name' => $record->name,
                        'client_company' => $record->company,
                        'client_email' => $record->email,
                        'client_whatsapp' => $record->whatsapp,
                        'client_country' => $record->country,
                        'client_notes' => $record->description,
                        'stage' => SourcingProject::STAGE_SAMPLING,
                        'progress_percent' => 15,
                        'target_completion_date' => $record->target_date,
                    ]);

                    $record->update(['status' => 'closed']);

                    Notification::make()
                        ->title('Proyek Sourcing Berhasil Dibuat')
                        ->body("Proyek {$project->project_code} telah dibuat.")
                        ->success()
                        ->send();

                    return redirect(SourcingProjectResource::getUrl('view', ['record' => $project]));
                }),

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
