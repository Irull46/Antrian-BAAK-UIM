<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'foto',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
