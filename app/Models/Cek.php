<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cek extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
    }

    public function bengkel()
    {
        return  $this->hasMany(Bengkel::class);
    }
}
