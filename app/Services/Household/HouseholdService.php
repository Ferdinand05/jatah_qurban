<?php


namespace App\Services\Household;

use App\Models\Household;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class HouseholdService
{


    public function deleteMasHousehold()
    {



        $householdCount = Household::count();
        if ($householdCount == 0) {
            Notification::make()
                ->warning()
                ->title("Tidak ada data tersedia")
                ->send();
            return;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Household::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        Notification::make()->success()->title('Semua data berhasil dihapus')->send();
    }
}
