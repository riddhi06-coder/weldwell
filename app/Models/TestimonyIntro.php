<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestimonyIntro extends Model
{
    use SoftDeletes;

    protected $table = 'testimony_intros';

    protected $fillable = [
        'heading',
        'title',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function sliders(): HasMany
    {
        return $this->hasMany(TestimonyIntroSlider::class)->orderBy('sort_order')->orderBy('id');
    }
}
