<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainCategory extends Model
{
    use SoftDeletes;

    protected $table = 'main_categories';

    protected $fillable = [
        'name',
        'title',
        'image',
        'slug',
        'is_active',
        'show_in_brand_header',
        'show_in_product_header',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_in_brand_header' => 'boolean',
        'show_in_product_header' => 'boolean',
    ];

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
}
