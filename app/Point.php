<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'user_id', 'total_point', 'point_claimed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAgent($filter)
    {
        return $this->where('user_id', $filter);
    }
}
