<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutIntroVision extends Model
{
    use SoftDeletes;

    protected $table = 'about_intro_visions';

    protected $fillable = [
        'about_intro_id',
        'heading',
        'description',
        'sort_order',
        'deleted_by',
    ];

    public function aboutIntro(): BelongsTo
    {
        return $this->belongsTo(AboutIntro::class);
    }
}
