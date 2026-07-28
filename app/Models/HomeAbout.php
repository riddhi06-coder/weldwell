<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeAbout extends Model
{
    use SoftDeletes;

    protected $table = 'home_abouts';

    protected $fillable = [
        'heading',
        'title',
        'image1',
        'image2',
        'image3',
        'small_intro',
        'description',
        'experience_title',
        'experience',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
