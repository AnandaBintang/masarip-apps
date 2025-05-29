<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'nama',
        'perihal',
        'tujuan',
    ];

    protected $casts = [
        'nama' => 'string',
        'perihal' => 'string',
        'tujuan' => 'string',
    ];

    public $timestamps = true;
}
