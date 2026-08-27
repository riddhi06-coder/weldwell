<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductCategoryDetailFeature extends Model
{
    protected $table = 'product_category_detail_features';

    protected $fillable = [
        'product_category_detail_id',
        'number',
        'description',
        'sort_order',
    ];

    public function detail(): BelongsTo
    {
        return $this->belongsTo(ProductCategoryDetail::class, 'product_category_detail_id');
    }
}
