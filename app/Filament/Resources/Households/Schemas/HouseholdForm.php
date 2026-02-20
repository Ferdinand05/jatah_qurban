<?php

namespace App\Filament\Resources\Households\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HouseholdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("nomor_kk")
                    ->label('Nomor KK')
                    ->required()
                    ->numeric()
                    ->minLength(5),
                TextInput::make("kepala_keluarga")
                    ->label("Nama Kepala Keluarga"),
                TextInput::make("alamat")
                    ->required()
                    ->label("Alamat"),
                TextInput::make("rt")
                    ->required()
                    ->label("RT"),
                TextInput::make("rw")
                    ->required()
                    ->label("RW"),
                TextInput::make("no_hp")
                    ->required()
                    ->label("Telepon"),
                TextInput::make("email")
                    ->email()
                    ->required()
                    ->unique("households", "email", ignoreRecord: true),
            ]);
    }
}
