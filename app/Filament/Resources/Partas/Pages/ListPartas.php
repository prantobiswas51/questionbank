<?php

namespace App\Filament\Resources\Partas\Pages;

use App\Filament\Resources\Partas\PartaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPartas extends ListRecords
{
    protected static string $resource = PartaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
