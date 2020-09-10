<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferenceLink extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function claimHistory()
    {
        return $this->hasMany(ClaimHistory::class);
    }
    
}
