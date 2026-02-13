<?php

namespace App\Filament\Resources\ScanLogs;

use App\Filament\Resources\ScanLogs\Pages\ManageScanLogs;
use App\Models\ScanLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ScanLogResource extends Resource
{
    protected static ?string $model = ScanLog::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Megaphone;
    protected static  string |null $label = "Riwayat Scan";
    protected static string | UnitEnum | null $navigationGroup = 'Utils';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("result")
                    ->badge()
                    ->label("Result")
                    ->color(fn(string $state): string => match ($state) {
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make("ticket.id")
                    ->label("ID Ticket"),
                TextColumn::make("user.name")
                    ->label("User Scanner"),
                TextColumn::make("scanned_at")
                    ->date()
                    ->sortable(),
                TextColumn::make("message")
                    ->label("Pesan"),
                TextColumn::make("created_at")
                    ->label("Tgl. Dibuat")

            ])
            ->filters([
                //
            ])
            ->recordUrl(null)
            ->recordActions([])
            ->toolbarActions([])
            ->defaultSort("created_at", "desc");
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageScanLogs::route('/'),
        ];
    }
}
