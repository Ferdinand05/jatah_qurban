<?php

namespace App\Filament\Resources\Distributions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DistributionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Distribusi/Judul')
                    ->required(),

                TextInput::make('description')
                    ->label("Deskripsi"),
                DatePicker::make('start_date')
                    ->label("Tgl. Mulai"),
                DatePicker::make('end_date')
                    ->label("Tgl. Selesai")
            ]);
    }
}
