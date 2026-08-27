<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategoryDetail extends Model
{
    use SoftDeletes;

    protected $table = 'product_category_details';

    protected $fillable = [
        'product_category_id',
        'banner_image',
        'banner_description',
        'section_heading',
        'section_image',
        'section_description',
        'product_range_title',
        'product_range_heading',
        'knowledge_title',
        'knowledge_heading',
        'knowledge_description',
        'knowledge_background_image',
        'knowledge_certificate',
        'knowledge_brochure',
        'knowledge_map_url',
        'industries_title',
        'industries_heading',
        'media_title',
        'media_heading',
        'media_description',
        'media_youtube_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProductCategoryDetailFeature::class)->orderBy('sort_order')->orderBy('id');
    }

    public function industries(): HasMany
    {
        return $this->hasMany(ProductCategoryDetailIndustry::class)->orderBy('sort_order')->orderBy('id');
    }
}
