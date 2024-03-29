<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    protected $guarded = ['id'];

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }

    public function product()
    {
        return $this->hasMany(product::class);
    }

    public function comment()
    {
        return $this->hasMany(Coment::class);
    }

    public function bengkel()
    {
        return $this->hasOne(Bengkel::class);
    }
}
