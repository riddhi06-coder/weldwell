<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutCustomerHighlight extends Model
{
    use SoftDeletes;

    protected $table = 'about_customer_highlights';

    protected $fillable = [
        'about_customer_id',
        'highlight_name',
        'sort_order',
        'deleted_by',
    ];

    public function aboutCustomer(): BelongsTo
    {
        return $this->belongsTo(AboutCustomer::class);
    }
}
