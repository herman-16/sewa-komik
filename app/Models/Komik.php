<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komik extends Model
{
    protected $fillable = ['judul', 'penulis', 'penerbit', 'stok'];
}