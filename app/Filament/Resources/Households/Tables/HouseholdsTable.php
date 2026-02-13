<?php

namespace App\Filament\Resources\Households\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HouseholdsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("nomor_kk")
                    ->label('Nomor KK')
                    ->searchable()
                    ->copyable(),
                TextColumn::make("kepala_keluarga")
                    ->label("Nama Kepala Keluarga")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("alamat")
                    ->label("Alamat")
                    ->searchable(),
                TextColumn::make("rt")
                    ->label("RT")
                    ->sortable(),
                TextColumn::make("rw")
                    ->label("RW")
                    ->sortable(),
                TextColumn::make("no_hp")
                    ->label("Telepon"),
                TextColumn::make("email")
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
