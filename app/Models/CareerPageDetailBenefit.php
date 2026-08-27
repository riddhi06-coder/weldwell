<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerPageDetailBenefit extends Model
{
    protected $table = 'career_page_detail_benefits';

    protected $fillable = [
        'career_page_detail_id',
        'benefit',
        'description',
        'sort_order',
    ];

    public function detail(): BelongsTo
    {
        return $this->belongsTo(CareerPageDetail::class, 'career_page_detail_id');
    }
}
