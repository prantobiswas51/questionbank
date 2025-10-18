<?php

namespace App\Filament\Resources\Words\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('english_word')
                    ->required(),
                TextInput::make('meaning')
                    ->required(),
                TextInput::make('notes'),
            ]);
    }
}
