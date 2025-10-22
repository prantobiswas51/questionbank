<?php

namespace App\Filament\Resources\Partbs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class PartbForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('story_id')->options(function () {
                    return \App\Models\Story::all()->pluck('story_name', 'id');
                })->label('Story')->required(),
                TextInput::make('part_b_qs')->label('Part B Question')
                    ->required(),
                RichEditor::make('part_b_ans')->label('Part B Answer')
                    ->required(),
                RichEditor::make('part_b_note')->label('Part B Note')
            ])->columns(1);
    }
}
