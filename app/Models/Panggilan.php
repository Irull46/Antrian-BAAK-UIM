<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panggilan extends Model
{
    use HasFactory;

    protected $fillable = [
        'posisi_teller_id',
        'user_id',
        'antrian_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function posisiTeller()
    {
        return $this->belongsTo(PosisiTeller::class);
    }

    public function antrian()
    {
        return $this->belongsTo(Antrian::class);
    }
}
