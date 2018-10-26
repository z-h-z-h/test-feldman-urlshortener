<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Link extends Model
{

    protected $fillable = [
        'full',
        'short',
        'expired_at'
    ];

    protected $casts = [
        'full' => 'string',
        'short' => 'string',
    ];

    protected $dates = ['expired_at'];


    protected $appends = ['is_expired'];

    public function getIsExpiredAttribute()
    {
        if ($this->expired_at == null) {
            return false;
        }

        if ($this->expired_at->lessThan(Carbon::now())){
            return true;
        }

        return false;
    }

    public function getRouteKeyName()
    {
        return 'short';
    }
}
