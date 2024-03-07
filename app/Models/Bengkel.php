<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use UsingRefs\Product;

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

    public function rate()
    {
        return $this->hasMany(Rate::class);
    }

    public function bengkel()
    {
        return $this->belongsTo(Bengkel::class);
    }

    public function coment()
    {
        return $this->hasMany(Coment::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
