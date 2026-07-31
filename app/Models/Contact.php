<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $table = 'contacts';

    protected $fillable = [
        'website_intro',
        'website_address',
        'email',
        'telephone',
        'map_url',
        'iframe_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function socials(): HasMany
    {
        return $this->hasMany(ContactSocial::class)->orderBy('sort_order')->orderBy('id');
    }

    public function offices(): HasMany
    {
        return $this->hasMany(ContactOffice::class)->orderBy('sort_order')->orderBy('id');
    }
}
