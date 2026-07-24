<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeBanner extends Model
{
    use SoftDeletes;

    protected $table = 'home_banners';

    protected $fillable = [
        'heading',
        'title',
        'video',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
