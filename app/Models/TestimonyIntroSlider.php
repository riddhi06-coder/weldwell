<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestimonyIntroSlider extends Model
{
    protected $table = 'testimony_intro_sliders';

    protected $fillable = [
        'testimony_intro_id',
        'title',
        'sort_order',
    ];

    public function testimonyIntro(): BelongsTo
    {
        return $this->belongsTo(TestimonyIntro::class);
    }
}
