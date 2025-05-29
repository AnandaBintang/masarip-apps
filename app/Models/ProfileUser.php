<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    protected $table = 'profile_user';

    protected $fillable = [
        'user_id',
        'foto_profil',
        'jabatan',
        'no_telpon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
