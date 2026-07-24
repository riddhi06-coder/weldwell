<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Role extends Model
{
    use SoftDeletes;

    public const SUPERADMIN_SLUG = 'superadmin';

    protected $fillable = ['name', 'slug', 'description', 'is_protected', 'is_active'];

    protected $casts = [
        'is_protected' => 'boolean',
        'is_active'    => 'boolean',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    /** Per-instance cache of this role's permission slugs (avoids a query per check). */
    protected ?Collection $permissionSlugCache = null;

    public function hasPermission(string $slug): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        $this->permissionSlugCache ??= $this->permissions()->pluck('slug');

        return $this->permissionSlugCache->contains($slug);
    }

    public function isSuperAdmin(): bool
    {
        return $this->slug === self::SUPERADMIN_SLUG;
    }
}
