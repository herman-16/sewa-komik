<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    protected $fillable = ['user_id', 'komik_id', 'tanggal_sewa', 'tanggal_kembali', 'status'];
}