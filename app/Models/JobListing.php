<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobListing extends Model
{
    use SoftDeletes;

    protected $table = 'job_listings';

    /** Available job types for the dropdown. */
    public const TYPES = ['Full Time', 'Part Time', 'Contract', 'Internship'];

    protected $fillable = [
        'role_name',
        'location',
        'job_type',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
