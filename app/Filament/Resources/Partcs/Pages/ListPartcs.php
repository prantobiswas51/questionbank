<?php

namespace App\Filament\Resources\Partcs\Pages;

use App\Filament\Resources\Partcs\PartcResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPartcs extends ListRecords
{
    protected static string $resource = PartcResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
