<?php

namespace App\Filament\Resources\SourcingProjects\Pages;

use App\Filament\Resources\SourcingProjects\SourcingProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSourcingProject extends EditRecord
{
    protected static string $resource = SourcingProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

