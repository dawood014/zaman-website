<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'reference',
        'preferred_date',
        'preferred_time',
        'internal_notes',
        'status',
        'is_read',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'is_read' => 'boolean',
    ];
}
