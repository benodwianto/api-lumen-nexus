<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    protected $guarded = ['id'];

    public function Cek()
    {
        return $this->belongsTo(Cek::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
