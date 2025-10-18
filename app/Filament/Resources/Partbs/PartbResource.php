<?php

namespace App\Filament\Resources\Partbs;

use App\Filament\Resources\Partbs\Pages\CreatePartb;
use App\Filament\Resources\Partbs\Pages\EditPartb;
use App\Filament\Resources\Partbs\Pages\ListPartbs;
use App\Filament\Resources\Partbs\Schemas\PartbForm;
use App\Filament\Resources\Partbs\Tables\PartbsTable;
use App\Models\Partb;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use Filament\Tables\Table;

class PartbResource extends Resource
{
    protected static ?string $model = Partb::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Partb';
    protected static ?string $navigationLabel = 'Part B';

    protected static string | UnitEnum | null $navigationGroup = 'Management';

    protected static ?int $navigationSort = 6;


    public static function form(Schema $schema): Schema
    {
        return PartbForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartbsTable::configure($table);
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
            'index' => ListPartbs::route('/'),
            'create' => CreatePartb::route('/create'),
            'edit' => EditPartb::route('/{record}/edit'),
        ];
    }
}
