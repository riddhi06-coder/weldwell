<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutCustomer extends Model
{
    use SoftDeletes;

    protected $table = 'about_customers';

    protected $fillable = [
        'heading',
        'title',
        'is_active',
        'deleted_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function features(): HasMany
    {
        return $this->hasMany(AboutCustomerFeature::class)->orderBy('sort_order')->orderBy('id');
    }

    public function highlights(): HasMany
    {
        return $this->hasMany(AboutCustomerHighlight::class)->orderBy('sort_order')->orderBy('id');
    }
}
