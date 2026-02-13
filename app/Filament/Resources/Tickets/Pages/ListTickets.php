<?php

namespace App\Filament\Resources\Tickets\Pages;

use App\Filament\Pages\ScanTicket;
use App\Filament\Resources\Tickets\TicketResource;
use App\Models\Distribution;
use App\Models\Household;
use App\Models\Ticket;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

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
                })
                ->color("success"),

        ];
    }
}
