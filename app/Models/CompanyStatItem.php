<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyStatItem extends Model
{
    protected $table = 'company_stat_items';

    protected $fillable = [
        'company_stat_id',
        'stat_no',
        'stat_name',
        'sort_order',
    ];

    public function companyStat(): BelongsTo
    {
        return $this->belongsTo(CompanyStat::class);
    }
}
