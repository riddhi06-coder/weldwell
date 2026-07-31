<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactOffice extends Model
{
    protected $table = 'contact_offices';

    protected $fillable = [
        'contact_id',
        'image',
        'office_name',
        'address',
        'emails',
        'telephone',
        'map_url',
        'sort_order',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
