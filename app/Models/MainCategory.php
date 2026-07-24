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
        'slug',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
}
