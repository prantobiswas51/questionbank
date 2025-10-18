<?php

namespace App\Filament\Resources\Papers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaperForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('subject_id')
                    ->label('Subject')
                    ->relationship('subject', 'subject_name')
                    ->required(),
                TextInput::make('paper_name')
                    ->required(),
                TextInput::make('paper_code')
                    ->required(),
            ]);
    }
}
