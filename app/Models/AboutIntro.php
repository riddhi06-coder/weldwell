<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutIntro extends Model
{
    use SoftDeletes;

    protected $table = 'about_intros';

    protected $fillable = [
        'heading',
        'image',
        'introduction',
        'motto_heading',
        'motto_description',
        'is_active',
        'deleted_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function visions(): HasMany
    {
        return $this->hasMany(AboutIntroVision::class)->orderBy('sort_order')->orderBy('id');
    }
}
