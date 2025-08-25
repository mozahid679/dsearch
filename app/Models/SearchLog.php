<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    protected $fillable = [
        'user_id',
        'search_route',
        'input_fields',
        'ip_address',
        'user_agent',
        'searched_at'
    ];

    protected $casts = [
        'input_fields' => 'array',
        'searched_at' => 'datetime',
    ];
}
