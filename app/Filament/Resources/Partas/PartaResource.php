<?php

namespace App\Filament\Resources\Partas;

use App\Filament\Resources\Partas\Pages\CreateParta;
use App\Filament\Resources\Partas\Pages\EditParta;
use App\Filament\Resources\Partas\Pages\ListPartas;
use App\Filament\Resources\Partas\Schemas\PartaForm;
use App\Filament\Resources\Partas\Tables\PartasTable;
use App\Models\Parta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use Filament\Tables\Table;

class PartaResource extends Resource
{
    protected static ?string $model = Parta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Parta';
    protected static ?string $navigationLabel = 'Part A';
    protected static ?int $navigationSort = 6;
    protected static string | UnitEnum | null $navigationGroup = 'Management';

    public static function form(Schema $schema): Schema
    {
        return PartaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartasTable::configure($table);
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
            'index' => ListPartas::route('/'),
            'create' => CreateParta::route('/create'),
            'edit' => EditParta::route('/{record}/edit'),
        ];
    }
}
