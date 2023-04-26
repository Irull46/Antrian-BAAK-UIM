<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'mulai_pelayanan',
        'selesai_pelayanan',
        'durasi_pelayanan',
    ];

    public function antrian()
    {
        return $this->hasOne(Antrian::class);
    }
}
