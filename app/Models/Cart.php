<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(product::class);
    }

    public function user()
    {
        return $this->belongsTo(product::class);
    }
}
