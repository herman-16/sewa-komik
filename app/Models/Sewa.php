<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    protected $fillable = [
        'user_id',
        'komik_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komik()
    {
        return $this->belongsTo(Komik::class);
    }
}
