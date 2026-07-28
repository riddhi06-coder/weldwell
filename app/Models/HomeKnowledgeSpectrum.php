<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeKnowledgeSpectrum extends Model
{
    use SoftDeletes;

    protected $table = 'home_knowledge_spectrums';

    protected $fillable = [
        'title',
        'heading',
        'background_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
