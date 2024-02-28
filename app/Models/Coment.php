<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function product()
    {
        $this->belongsTo(product::class);
    }
}
