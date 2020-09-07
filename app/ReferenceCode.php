<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferenceCode extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function claimHistory()
    {
        return $this->hasMany(ClaimHistory::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
