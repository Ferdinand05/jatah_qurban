<?php

namespace App\Filament\Resources\Households\Pages;

use App\Filament\Resources\Households\HouseholdResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHouseholds extends ListRecords
{
    protected static string $resource = HouseholdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make("formHousehold")
                ->link()
                ->url(route("household.index"))
                ->label("Formulir Warga")
                ->openUrlInNewTab()
        ];
    }
}
