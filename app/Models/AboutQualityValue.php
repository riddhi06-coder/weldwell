<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutQualityValue extends Model
{
    use SoftDeletes;

    protected $table = 'about_quality_values';

    protected $fillable = [
        'about_quality_id',
        'value_name',
        'description',
        'sort_order',
        'deleted_by',
    ];

    public function aboutQuality(): BelongsTo
    {
        return $this->belongsTo(AboutQuality::class);
    }
}
