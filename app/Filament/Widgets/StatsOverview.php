<?php

namespace App\Filament\Widgets;

use App\Models\Distribution;
use App\Models\Household;
use App\Models\Ticket;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Distribusi', Distribution::count())
                ->icon(Heroicon::ClipboardDocumentList)
                ->description("Jumlah Pendistribusian"),
            Stat::make('Warga', Household::count())
                ->icon(Heroicon::Home)
                ->description("Jumlah data Warga")
                ->descriptionColor("info"),
            Stat::make('Ticket Diterbitkan', Ticket::where("status", "issued")->count())
                ->icon(Heroicon::CheckCircle)
                ->description("Ticket yang sudah diterbitkan, dan belum digunakan"),
            Stat::make('Ticket Digunakan', Ticket::where("status", "used")->count())
                ->icon(Heroicon::CheckBadge)
                ->description('Ticket yang sudah di berhasil di Scan QR')
        ];
    }
}
