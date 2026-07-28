<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductIntro extends Model
{
    use SoftDeletes;

    protected $table = 'product_intros';

    protected $fillable = [
        'heading',
        'title',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function qualities(): HasMany
    {
        return $this->hasMany(ProductIntroQuality::class)->orderBy('sort_order')->orderBy('id');
    }
}
