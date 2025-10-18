<?php

namespace App\Filament\Resources\Summaries;

use App\Filament\Resources\Summaries\Pages\CreateSummary;
use App\Filament\Resources\Summaries\Pages\EditSummary;
use App\Filament\Resources\Summaries\Pages\ListSummaries;
use App\Filament\Resources\Summaries\Schemas\SummaryForm;
use App\Filament\Resources\Summaries\Tables\SummariesTable;
use App\Models\Summary;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SummaryResource extends Resource
{
    protected static ?string $model = Summary::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Summary';
    protected static ?int $navigationSort = 5;
        protected static string | UnitEnum | null $navigationGroup = 'Management';


    public static function form(Schema $schema): Schema
    {
        return SummaryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SummariesTable::configure($table);
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
            'index' => ListSummaries::route('/'),
            'create' => CreateSummary::route('/create'),
            'edit' => EditSummary::route('/{record}/edit'),
        ];
    }
}
