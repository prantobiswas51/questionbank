<?php

namespace App\Filament\Resources\Partas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class PartaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('story_id')
                    ->label('Story')
                    ->options(\App\Models\Story::pluck('story_name', 'id'))
                    ->required(),

                Repeater::make('questions')
                    ->label('Part A Questions')
                    ->schema([
                        TextInput::make('part_a_qs')
                            ->label('Question'),

                        RichEditor::make('part_a_ans')
                            ->label('Answer'),

                        RichEditor::make('part_a_note')
                            ->label('Note'),
                    ])
                    ->defaultItems(2)         // show 3 items initially :contentReference[oaicite:2]{index=2}
                    ->minItems(0)             // allow 0 filled (so you can ignore empty) 
                    ->maxItems(10)
                    ->addActionLabel('Add Another Question')
                    ->columns(1),
            ])
            ->columns(1);
    }
}
