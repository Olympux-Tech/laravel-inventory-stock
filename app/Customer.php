<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['nama', 'status', 'alamat', 'email', 'telepon', 'remarks'];

    protected $hidden = ['created_at', 'updated_at'];
}
