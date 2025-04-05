<?php

namespace App\Filament\Admin\Resources\DashboardResource\Pages;

use App\Filament\Admin\Resources\DashboardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDashboards extends ListRecords
{
    protected static string $resource = DashboardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
