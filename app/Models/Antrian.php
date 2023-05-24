<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_antrian',
        'status',
    ];

    public function panggilan()
    {
        return $this->hasOne(Panggilan::class);
    }

    public function traffic()
    {
        return $this->hasOne(Traffic::class);
    }
}
