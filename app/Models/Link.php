<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'creator_ip',
        'original_url',
        'short_code',
        'custom_slug',
        'password',
        'expires_at',
        'redirect_type',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'clicks_count',
        'use_redirect_page',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'use_redirect_page' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clicks()
    {
        return $this->hasMany(LinkClick::class);
    }
}
