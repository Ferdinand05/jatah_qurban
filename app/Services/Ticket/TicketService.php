<?php

use App\Models\Distribution;
use App\Models\Household;
use App\Models\Ticket;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketService
{


    public function generateMassTicket(array $data)
    {

        $distribution = Distribution::find($data["distribution_id"]);

        // Generate tiket untuk distribusi ini
        $households = Household::whereDoesntHave('tickets', function ($query) use ($distribution) {
            $query->where('distribution_id', $distribution->id);
        })->get();

        $total = $households->count();

        if ($total === 0) {
            Notification::make()
                ->warning()
                ->title('Tidak ada KK yang perlu digenerate')
                ->body("Semua KK sudah memiliki tiket untuk {$distribution->name}")
                ->send();
            return;
        }

        $generated = 0;

        // generate ticket
        foreach ($households->chunk(30) as $chunk) {
            foreach ($chunk as $household) {
                $token = (string) Str::uuid();

                // generate qr dengan format svg
                $svg = QrCode::format('svg')
                    ->size(300)
                    ->margin(1)
                    ->color(0, 0, 0)
                    ->backgroundColor(255, 255, 255)
                    ->generate($token);

                // path file dan save ke storage
                $filename = 'qrcodes/' . $token . '.svg';
                Storage::disk('public')->put($filename, $svg);

                // create ticket
                Ticket::create([
                    'household_id' => $household->id,
                    'distribution_id' => $distribution->id,
                    'token' => $token,
                    'status' => 'issued',
                    'qr_code_path' => $filename,
                    'issued_at' => now(),
                ]);

                $generated++;
            }
        }

        Notification::make()
            ->success()
            ->title(" Berhasil generate {$generated} tiket + QR Code")
            ->body("Disimpan di: storage/qrcodes")
            ->icon(Heroicon::CheckCircle)
            ->send();
    }


    public function deleteMassTicket()
    {

        Ticket::whereNotNull('qr_code_path')->get()->each(function ($ticket) {
            if ($ticket->qr_code_path && Storage::disk('public')->exists($ticket->qr_code_path)) {
                Storage::disk('public')->delete($ticket->qr_code_path);
            }
        });

        $ticketCount = Ticket::count();
        if ($ticketCount == 0) {
            Notification::make()
                ->warning()
                ->title("Tidak ada data tersedia")
                ->send();
            return;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Ticket::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        Notification::make()->success()->title('Semua data berhasil dihapus')->send();
    }
}
