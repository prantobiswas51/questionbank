<?php

namespace App\Filament\Resources\Partas\Pages;

use App\Filament\Resources\Partas\PartaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditParta extends EditRecord
{
    protected static string $resource = PartaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
