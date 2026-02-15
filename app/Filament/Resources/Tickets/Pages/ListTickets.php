<?php

namespace App\Filament\Resources\Tickets\Pages;

use App\Filament\Pages\ScanTicket;
use App\Filament\Resources\Tickets\TicketResource;
use App\Models\Distribution;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;
use TicketService;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {

        $this->ticketService = $ticketService;
    }



    protected function getHeaderActions(): array
    {
        return [

            // redirect ke halaman scan qr
            Action::make("redirectToScanner")
                ->label("Halaman Scanner")
                ->link()
                ->icon(Heroicon::QrCode)
                ->url(ScanTicket::getUrl())
                ->openUrlInNewTab()
                ->color("ghost"),

            Action::make("generate_ticket")
                ->label("Generate Tiket")
                ->requiresConfirmation()
                ->modalHeading('Generate Tiket untuk Semua KK')
                ->icon(Heroicon::Ticket)
                ->modalDescription('Akan membuat tiket untuk semua KK yang belum memiliki tiket di distribusi aktif.')
                ->schema([
                    Select::make('distribution_id')
                        ->label('Pilih Distribusi')
                        ->placeholder('-- Pilih Distribusi --')
                        ->options(Distribution::where("status", "active")->pluck("name", "id"))
                        ->required()
                ])
                ->action(function (array $data) {

                    // generate mass ticket service
                    $this->ticketService->generateMassTicket($data);
                })
                ->color("success"),

        ];
    }
}
