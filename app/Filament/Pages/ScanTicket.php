<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Tickets\TicketResource;
use App\Models\Household;
use App\Models\ScanLog;
use App\Models\Ticket;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ScanTicket extends Page
{
    protected string $view = 'filament.pages.scan-ticket';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::QrCode;
    protected static string | UnitEnum | null $navigationGroup = 'Utils';
    protected static ?int $navigationSort = 4;

    protected function getHeaderActions(): array
    {
        return [
            Action::make("redirectToTicket")
                ->label("Lihat Data Ticket")
                ->link()
                ->url(TicketResource::getUrl())
                ->icon(Heroicon::Ticket)
        ];
    }

    //  PROPERTY untuk menyimpan data tiket
    public ?Ticket $ticket = null;
    public string $message = '';
    public string $status = '';
    public ?Household $household = null;

    // LISTENER untuk event 'scanResult' dari JavaScript
    protected function getListeners(): array
    {
        return [
            'scanResult' => 'handleScanResult',
        ];
    }

    //  METHOD untuk memproses token hasil scan
    public function handleScanResult($token)
    {
        // Validasi token
        $this->ticket = Ticket::with(['household', 'distribution'])
            ->where('token', $token)
            ->first();

        if ($this->ticket) {
            $this->message = 'Tiket valid!';
            $this->household = $this->ticket->household;

            // update status ticket
            $this->takeMeat();
        } else {
            $this->message = 'Tiket tidak ditemukan!';
            $this->status = "Gagal";
            $this->ticket = null;
            $this->household = null;
            $this->createLog($this->message, "failed");
        }
    }

    // Method tambahan: Proses pengambilan daging
    public function takeMeat()
    {
        if ($this->ticket && $this->ticket->status === 'issued') {
            $this->ticket->update([
                'status' => 'used',
                'used_at' => now(),
                'used_by' => auth()->id(),
            ]);

            // refresh data
            $this->ticket->refresh();

            $this->message = "Daging " . $this->household->kepala_keluarga .  " diserahkan!";
            $this->status = "Berhasil";

            $this->createLog($this->message, "success");
        } else if ($this->ticket && $this->ticket->status === "used") {
            $this->message = "Ticket tidak bisa digunakan lagi." . "Pengunaan terakhir :" . $this->ticket->used_at;
            $this->status = "Gagal";
            $this->createLog($this->message, "failed");
        } else {
            $this->message = "Ticket TIDAK bisa digunakan, Check status dan ketersediaan ticket!";
            $this->status = "Gagal";
            $this->createLog($this->message, "failed");
        }
    }

    public function createLog($message, $result)
    {
        ScanLog::create([
            "ticket_id" => $this->ticket->id ?? null,
            "user_id" => auth()->id(),
            "scanned_at" => now(),
            "message" => $message,
            "result" => $result
        ]);
    }
}
