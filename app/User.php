<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeAdmin($query)
    {
        return $query->where('role', '99');
    }

    public function scopeAgent($query)
    {
        return $query->where('role', '15');
    }

    public function point()
    {
        return $this->hasOne(Point::class);
    }

    public function referenceLink()
    {
        return $this->hasMany(ReferenceLink::class);
    }
}
