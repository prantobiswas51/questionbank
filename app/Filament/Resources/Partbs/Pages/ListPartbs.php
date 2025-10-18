<?php

namespace App\Filament\Resources\Partbs\Pages;

use App\Filament\Resources\Partbs\PartbResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPartbs extends ListRecords
{
    protected static string $resource = PartbResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
