<?php

namespace App\Models;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ScanLog extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
        'scanned_at',
        'ip_address',
        'user_agent',
        'result',
        'message'
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function logger($message, $status, $ticket)
    {
        static::create([
            "ticket_id" => $ticket->id ?? null,
            "user_id" => auth()->id(),
            "scanned_at" => now(),
            "message" => $message,
            "result" => $status
        ]);
    }
}
