<?php

namespace App\Filament\Resources\ScanLogs\Pages;

use App\Filament\Resources\ScanLogs\ScanLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageScanLogs extends ManageRecords
{
    protected static string $resource = ScanLogResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
