<?php

use App\Http\Controllers\HouseholdRegistrationController;
use Illuminate\Support\Facades\Route;


// household view
Route::get("/household/form", [HouseholdRegistrationController::class, "index"])
    ->name('household.index');


// Route::get('test/email', function () {

//     $ticket = Ticket::first();
//     Mail::to("ferdiinand05@gmail.com")->queue(new SendTicketEmail($ticket));
//     Log::info("Emil testing....");
// });

// Route::get('/test-email', function () {
//     Mail::raw('Test email langsung', function ($message) {
//         $message->to('fkoryanto@gmail.com')
//             ->subject('Test Laravel Gmail');
//     });

//     return 'Email dikirim';
// });
