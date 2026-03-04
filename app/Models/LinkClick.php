<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkClick extends Model
{
    protected $fillable = [
        'link_id',
        'ip_address',
        'country',
        'city',
        'device_type',
        'browser',
        'platform',
        'referer',
    ];

    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
