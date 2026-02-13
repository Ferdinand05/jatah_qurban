<?php

namespace App\Filament\Resources\Distributions;

use App\Filament\Resources\Distributions\Pages\CreateDistribution;
use App\Filament\Resources\Distributions\Pages\EditDistribution;
use App\Filament\Resources\Distributions\Pages\ListDistributions;
use App\Filament\Resources\Distributions\Schemas\DistributionForm;
use App\Filament\Resources\Distributions\Tables\DistributionsTable;
use App\Models\Distribution;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DistributionResource extends Resource
{
    protected static ?string $model = Distribution::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentCheck;
    protected static string|null $label = "Distribusi";
    public static function form(Schema $schema): Schema
    {
        return DistributionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DistributionsTable::configure($table);
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
            'index' => ListDistributions::route('/'),
            'create' => CreateDistribution::route('/create'),
            'edit' => EditDistribution::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
