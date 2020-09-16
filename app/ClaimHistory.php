<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimHistory extends Model
{
    protected $fillable = [
        'customer_id', 'reference_link_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function referenceLink()
    {
        return $this->belongsTo(referenceLink::class, 'reference_code_id');
    }
}
