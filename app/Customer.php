<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['nama', 'alamat', 'email', 'telepon', 'status', 'remarks'];

    protected $hidden = ['created_at', 'updated_at'];
}
