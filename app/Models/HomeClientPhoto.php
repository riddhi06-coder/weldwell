<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeClientPhoto extends Model
{
    protected $table = 'home_client_photos';

    protected $fillable = [
        'home_client_id',
        'photo',
        'sort_order',
    ];

    public function homeClient(): BelongsTo
    {
        return $this->belongsTo(HomeClient::class);
    }
}
