<?php

use App\Mail\SendTicketEmail;
use App\Models\Ticket;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


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
