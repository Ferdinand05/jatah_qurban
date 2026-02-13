<?php

namespace App\Filament\Resources\Distributions\Pages;

use App\Filament\Resources\Distributions\DistributionResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDistribution extends CreateRecord
{
    protected static string $resource = DistributionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data["created_by"] = Auth::id();
        $data["status"] = "active";
        return $data;
    }
}
