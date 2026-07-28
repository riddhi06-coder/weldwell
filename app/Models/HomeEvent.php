<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeEvent extends Model
{
    use SoftDeletes;

    protected $table = 'home_events';

    protected $fillable = [
        'heading',
        'title',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
