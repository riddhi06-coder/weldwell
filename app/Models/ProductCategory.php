<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;

    protected $table = 'product_categories';

    protected $fillable = [
        'name',
        'title',
        'image',
        'slug',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /** The active detail page for this category (used to decide whether to link out). */
    public function activeDetail(): HasOne
    {
        return $this->hasOne(ProductCategoryDetail::class)->where('is_active', true);
    }
}
