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

    public $timestamps = false;

    protected $casts = [
        'input_fields' => 'array',
        'searched_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
