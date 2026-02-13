<?php

namespace App\Filament\Resources\Distributions\Tables;

use App\Models\Distribution;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DistributionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama Distribusi/Judul'),
                TextColumn::make('description')
                    ->label('Deskripsi'),
                TextColumn::make('start_date')
                    ->label('Tgl. Mulai')
                    ->date(),
                TextColumn::make('end_date')
                    ->label("Tgl. Selesai")
                    ->date(),
                TextColumn::make('creator.name')
                    ->label("Dibuat oleh")
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make("editStatus")
                    ->label("Close")
                    ->icon(Heroicon::XCircle)
                    ->requiresConfirmation()
                    ->action(function (Distribution $record) {


                        $record->status = "closed";
                        $record->save();
                    })
                    ->visible(fn(Distribution $record) => $record->status === 'active'),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
