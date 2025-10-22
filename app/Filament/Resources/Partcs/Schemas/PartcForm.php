<?php

namespace App\Filament\Resources\Partcs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class PartcForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('story_id')->options(function () {
                    return \App\Models\Story::all()->pluck('story_name', 'id');
                })->label('Story')->required(),
                TextInput::make('part_c_qs')->label('Part C Question')
                    ->required(),
                RichEditor::make('part_c_ans')->label('Part C Answer')
                    ->required(),
                RichEditor::make('part_c_note')->label('Part C Note')
            ])->columns(1);
    }
}
