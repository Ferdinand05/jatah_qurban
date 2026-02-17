<?php

namespace App\Filament\Resources\Tickets\Tables;

use App\Models\Ticket;
use App\Services\Ticket\TicketService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class TicketsTable
{


    public static function configure(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->poll("5s")
            ->striped()
            ->reorderableColumns()
            ->columns([
                TextColumn::make("status")
                    ->label("Status")
                    ->badge()
                    ->toggleable()
                    ->color(fn($state) => match ($state) {
                        'issued' => 'success',
                        'used' => 'info',
                        'expired' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make("distribution.name")
                    ->label("Distribusi")
                    ->toggleable(),
                TextColumn::make("household.kepala_keluarga")
                    ->description(fn($record) => ($record->household->alamat ?? '-'))
                    ->label("Kepala Keluarga")
                    ->toggleable()

                    ->searchable(),
                TextColumn::make("issued_at")
                    ->label("Diterbitkan")
                    ->sortable()
                    ->toggleable()

                    ->dateTime(),
                ImageColumn::make("qr_code_path")
                    ->label("QR Code")
                    ->square()
                    ->toggleable()

                    ->imageSize(60),
                TextColumn::make("used_at")
                    ->label('Digunakan Tgl')
                    ->dateTime()
                    ->toggleable()

                    ->sortable(),
                TextColumn::make("processor.name")
                    ->label("Staff")
                    ->toggleable()
                    ->sortable()

            ])
            ->recordUrl(null)
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'issued' => 'Diterbitkan',
                        'used' => 'Digunakan',
                        'expired' => 'Kadaluarsa',
                    ]),
                SelectFilter::make('distribution_id')
                    ->label('Distribusi')
                    ->relationship('distribution', 'name'),
            ])

            ->recordActions([
                Action::make("downloadQR")
                    ->label('Download QR')
                    ->icon(Heroicon::ArrowDownTray)
                    ->action(function (Ticket $record) {
                        if (!$record->qr_code_path) {
                            Notification::make()->danger()->title('QR Code tidak ditemukan')->send();
                            return;
                        }

                        return Storage::disk('public')->download(
                            $record->qr_code_path,
                            'tiket-' . $record->household->kepala_keluarga . '.svg'
                        );
                    })
                    ->hidden(fn(Ticket $record) => in_array($record->status, ["used", "expired"])),
                Action::make("Whatsapp")
                    ->link()
                    ->url(function (Ticket $record) {
                        return "https://api.whatsapp.com/send?phone=" . $record->household->no_hp . "&text=Ticket%20QR%20code%20%2C%20untuk%20pendistribusian%20Daging%20Qurban";
                    })
                    ->openUrlInNewTab()
                    ->icon(Heroicon::Phone)
                    ->hidden(fn(Ticket $record) => in_array($record->status, ["used", "expired"])),
                DeleteAction::make()
                    ->requiresConfirmation(),

            ])
            ->toolbarActions([
                //  delete semua tickets
                Action::make('deleteAllData')
                    ->label('Hapus Semua Data')
                    ->icon(Heroicon::Trash)
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Seluruh Data?')
                    ->modalDescription('Tindakan ini akan menghapus semua tickets')
                    ->action(function () {

                        $ticketService = new TicketService();
                        $ticketService->deleteMassTicket();
                    }),

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
