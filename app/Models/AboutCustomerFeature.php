<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutCustomerFeature extends Model
{
    use SoftDeletes;

    protected $table = 'about_customer_features';

    protected $fillable = [
        'about_customer_id',
        'feature_name',
        'sort_order',
        'deleted_by',
    ];

    public function aboutCustomer(): BelongsTo
    {
        return $this->belongsTo(AboutCustomer::class);
    }
}
