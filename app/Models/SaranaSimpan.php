<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaranaSimpan extends Model
{
    protected $table = 'sarana_simpan';

    protected $fillable = [
        'kode_nomenklatur',
        'keterangan',
    ];
}
