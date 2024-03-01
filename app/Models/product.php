<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coment()
    {
        return $this->hasMany(Coment::class);
    }
}
