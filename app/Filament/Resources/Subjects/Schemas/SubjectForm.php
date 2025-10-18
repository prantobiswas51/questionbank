<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Define form components here, e.g., TextInput, Select, etc.
                TextInput::make('subject_name')
                    ->label('Subject Name')
                    ->required(),
                Select::make('year_id')
                    ->label('Year')
                    ->relationship('year', 'year')
                    ->required(),
            ]);
    }
}
