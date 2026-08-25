<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutQuality extends Model
{
    use SoftDeletes;

    protected $table = 'about_qualities';

    protected $fillable = [
        'heading',
        'image',
        'background_image',
        'more_info_desc',
        'youtube_link',
        'statement',
        'is_active',
        'deleted_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(AboutQualityValue::class)->orderBy('sort_order')->orderBy('id');
    }
}
