<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactSocial extends Model
{
    /** Supported social platforms (key => label + icon). */
    public const PLATFORMS = [
        'facebook'  => ['label' => 'Facebook',    'icon' => 'fab fa-facebook-f'],
        'linkedin'  => ['label' => 'LinkedIn',    'icon' => 'fab fa-linkedin-in'],
        'instagram' => ['label' => 'Instagram',   'icon' => 'fab fa-instagram'],
        'twitter'   => ['label' => 'Twitter / X', 'icon' => 'fab fa-x-twitter'],
        'youtube'   => ['label' => 'YouTube',     'icon' => 'fab fa-youtube'],
        'whatsapp'  => ['label' => 'WhatsApp',    'icon' => 'fab fa-whatsapp'],
        'tiktok'    => ['label' => 'TikTok',      'icon' => 'fab fa-tiktok'],
        'telegram'  => ['label' => 'Telegram',    'icon' => 'fab fa-telegram-plane'],
        'pinterest' => ['label' => 'Pinterest',   'icon' => 'fab fa-pinterest-p'],
    ];

    protected $table = 'contact_socials';

    protected $fillable = [
        'contact_id',
        'platform',
        'url',
        'sort_order',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
