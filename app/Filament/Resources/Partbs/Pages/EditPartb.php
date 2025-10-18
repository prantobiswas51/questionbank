<?php

namespace App\Filament\Resources\Partbs\Pages;

use App\Filament\Resources\Partbs\PartbResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPartb extends EditRecord
{
    protected static string $resource = PartbResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
