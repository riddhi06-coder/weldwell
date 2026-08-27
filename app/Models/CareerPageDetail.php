<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CareerPageDetail extends Model
{
    use SoftDeletes;

    protected $table = 'career_page_details';

    protected $fillable = [
        'banner_heading',
        'description',
        'section_heading',
        'career_heading',
        'title',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function benefits(): HasMany
    {
        return $this->hasMany(CareerPageDetailBenefit::class)->orderBy('sort_order')->orderBy('id');
    }
}
