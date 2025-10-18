<?php

namespace App\Filament\Resources\Partcs;

use App\Filament\Resources\Partcs\Pages\CreatePartc;
use App\Filament\Resources\Partcs\Pages\EditPartc;
use App\Filament\Resources\Partcs\Pages\ListPartcs;
use App\Filament\Resources\Partcs\Schemas\PartcForm;
use App\Filament\Resources\Partcs\Tables\PartcsTable;
use App\Models\Partc;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use UnitEnum;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PartcResource extends Resource
{
    protected static ?string $model = Partc::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Partc';
    protected static ?string $navigationLabel = 'Part C';
    protected static ?int $navigationSort = 7;
    protected static string | UnitEnum | null $navigationGroup = 'Management';


    public static function form(Schema $schema): Schema
    {
        return PartcForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartcsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPartcs::route('/'),
            'create' => CreatePartc::route('/create'),
            'edit' => EditPartc::route('/{record}/edit'),
        ];
    }
}
