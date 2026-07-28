<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductIntroQuality extends Model
{
    protected $table = 'product_intro_qualities';

    protected $fillable = [
        'product_intro_id',
        'quality',
        'sort_order',
    ];

    public function productIntro(): BelongsTo
    {
        return $this->belongsTo(ProductIntro::class);
    }
}
