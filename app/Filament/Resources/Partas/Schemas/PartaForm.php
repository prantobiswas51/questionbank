<?php

namespace App\Filament\Resources\Partas\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PartaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('story_id')->options(function () {
                    return \App\Models\Story::all()->pluck('story_name', 'id');
                })->label('Story')->required(),
                TextInput::make('part_a_qs')->label('Part A Question')
                    ->required(),
                RichEditor::make('part_a_ans')->label('Part A Answer')
                    ->required(),
                RichEditor::make('part_a_note')->label('Part A Note')
            ]);
    }
}
