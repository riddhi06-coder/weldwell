<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeConnection extends Model
{
    use SoftDeletes;

    protected $table = 'home_connections';

    protected $fillable = [
        'title',
        'heading',
        'email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
