<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyStat extends Model
{
    use SoftDeletes;

    protected $table = 'company_stats';

    protected $fillable = [
        'video',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(CompanyStatItem::class)->orderBy('sort_order')->orderBy('id');
    }
}
