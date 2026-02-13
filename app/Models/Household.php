<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{

    use HasFactory;

    protected $fillable = [
        'nomor_kk',
        'kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'no_hp',
        'email'
    ];

    protected $casts = [
        'nomor_kk' => 'string'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
