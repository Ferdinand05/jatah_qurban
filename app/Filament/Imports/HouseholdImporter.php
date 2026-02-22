<?php

namespace App\Filament\Imports;

use App\Models\Household;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class HouseholdImporter extends Importer
{
    protected static ?string $model = Household::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make("nomor_kk")
                ->requiredMapping()
                ->numeric()
                ->rules(["required", "max:16"]),
            ImportColumn::make("kepala_keluarga")
                ->requiredMapping()
                ->rules(["required", "string", "max:35"]),
            ImportColumn::make("alamat")
                ->label("Alamat")
                ->rules(["required", "string"])
                ->requiredMapping(),
            ImportColumn::make("rt")
                ->label("RT")
                ->rules(["required", "max:5"])
                ->requiredMapping(),
            ImportColumn::make("rw")
                ->label("RW")
                ->rules(["required", "max:5"])
                ->requiredMapping(),
            ImportColumn::make("no_hp")
                ->label("No. telepon")
                ->rules(["required", "max:15"])
                ->requiredMapping(),
            ImportColumn::make("email")
                ->label("email")
                ->rules(["email", "required"])
                ->requiredMapping(),


        ];
    }

    public function resolveRecord(): Household
    {
        return Household::firstOrNew([
            'nomor_kk' => $this->data['nomor_kk'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your household import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
