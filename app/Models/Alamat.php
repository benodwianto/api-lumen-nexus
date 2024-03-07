<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $guarded = ['id_user_alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
