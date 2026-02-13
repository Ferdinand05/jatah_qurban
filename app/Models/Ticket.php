<?php

namespace App\Models;

use App\Models\Distribution;
use App\Models\Household;
use App\Models\ScanLog;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'household_id',
        'distribution_id',
        'token',
        'status',
        'qr_code_path',
        'issued_at',
        'used_at',
        'used_by'
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'used_at'   => 'datetime',
    ];

    public function household()
    {
        return $this->belongsTo(Household::class);
    }

    public function distribution()
    {
        return $this->belongsTo(Distribution::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'used_by');
    }

    public function scanLogs()
    {
        return $this->hasMany(ScanLog::class);
    }
}
