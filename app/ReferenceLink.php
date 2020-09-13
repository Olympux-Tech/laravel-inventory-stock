<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferenceLink extends Model
{

    protected $fillable = [
        'agent_id', 'point', 'max_claim',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function claimHistory()
    {
        return $this->hasMany(ClaimHistory::class);
    }
    
}
