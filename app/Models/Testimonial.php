<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $table = 'testimonials';

    protected $fillable = [
        'client_name',
        'industry_type',
        'testimony',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
