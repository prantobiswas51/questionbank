<?php

namespace App\Filament\Resources\Summaries\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SummaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('story_id')->options(function () {
                    return \App\Models\Story::all()->pluck('story_name', 'id');
                })->required(),

                RichEditor::make('summary_content')->label('Summary Content')
                    ->required(),
            ])->columns(1);
    }
}
