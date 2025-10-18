<?php

namespace App\Filament\Resources\Partcs\Pages;

use App\Filament\Resources\Partcs\PartcResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPartc extends EditRecord
{
    protected static string $resource = PartcResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
