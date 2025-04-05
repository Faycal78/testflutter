<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Builder;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery();
    }
}
