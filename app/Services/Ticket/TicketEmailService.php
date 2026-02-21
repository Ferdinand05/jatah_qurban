<?php


namespace App\Services\Ticket;

use App\Mail\SendTicketEmail;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TicketEmailService
{

    public function sendMassEmail($tickets)
    {
        if ($tickets == null || $tickets->isEmpty()) {
            Notification::make()
                ->title("Tidak ada tickets")
                ->warning()
                ->send();
            return;
        }
        try {
            $sent = 0;

            $tickets->chunk(20)->each(function ($chunk) use (&$sent) { // ✅ &$sent
                foreach ($chunk as $ticket) {
                    // Validasi email
                    if (!$ticket->household || !$ticket->household->email) {
                        Log::warning("Ticket ID {$ticket->id} tidak punya email");
                        continue;
                    }

                    // Kirim email
                    Mail::to($ticket->household->email)
                        ->queue(new SendTicketEmail($ticket));

                    $sent++;

                    Log::info("Email di-queue ke: {$ticket->household->email}");
                }
            });

            Notification::make()
                ->title("✅ Email diproses")
                ->body("{$sent} email masuk antrian")
                ->success()
                ->send();

            Log::info("Proses email selesai: {$sent} email");
        } catch (\Throwable $th) {
            Notification::make()
                ->title("❌ Error")
                ->body($th->getMessage())
                ->danger()
                ->send();

            Log::error("Error: " . $th->getMessage());
        }
    }
}
