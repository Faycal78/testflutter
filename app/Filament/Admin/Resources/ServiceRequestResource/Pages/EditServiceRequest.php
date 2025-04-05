<?php

namespace App\Filament\Admin\Resources\ServiceRequestResource\Pages;

use App\Filament\Admin\Resources\ServiceRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceRequest extends EditRecord
{
    protected static string $resource = ServiceRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
