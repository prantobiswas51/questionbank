<?php

namespace App\Filament\Resources\Summaries\Pages;

use App\Filament\Resources\Summaries\SummaryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSummary extends EditRecord
{
    protected static string $resource = SummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
