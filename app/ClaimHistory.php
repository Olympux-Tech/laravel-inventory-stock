<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimHistory extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function referenceCode()
    {
        return $this->hasMany(referenceCode::class);
    }
}
