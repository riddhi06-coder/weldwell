<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // ---------- Permissions (grouped by module) ----------
            $permissionData = [
                // Dashboard
                ['name' => 'View Dashboard',      'slug' => 'dashboard.view',     'module' => 'Dashboard'],
                // Roles
                ['name' => 'View Roles',          'slug' => 'roles.view',         'module' => 'Roles'],
                ['name' => 'Create Roles',        'slug' => 'roles.create',       'module' => 'Roles'],
                ['name' => 'Edit Roles',          'slug' => 'roles.edit',         'module' => 'Roles'],
                ['name' => 'Delete Roles',        'slug' => 'roles.delete',       'module' => 'Roles'],
                // Users
                ['name' => 'View Users',          'slug' => 'users.view',         'module' => 'Users'],
                ['name' => 'Create Users',        'slug' => 'users.create',       'module' => 'Users'],
                ['name' => 'Edit Users',          'slug' => 'users.edit',         'module' => 'Users'],
                ['name' => 'Delete Users',        'slug' => 'users.delete',       'module' => 'Users'],
                // Permissions
                ['name' => 'View Permissions',    'slug' => 'permissions.view',   'module' => 'Permissions'],
                ['name' => 'Assign Permissions',  'slug' => 'permissions.assign', 'module' => 'Permissions'],
                // Activity Log
                ['name' => 'View Activity Log',   'slug' => 'activity-logs.view',   'module' => 'Activity Log'],
                ['name' => 'Manage Log Archives', 'slug' => 'activity-logs.manage', 'module' => 'Activity Log'],
                // Brands — Category
                ['name' => 'View Categories',     'slug' => 'brand-categories.view',   'module' => 'Brands'],
                ['name' => 'Create Categories',   'slug' => 'brand-categories.create', 'module' => 'Brands'],
                ['name' => 'Edit Categories',     'slug' => 'brand-categories.edit',   'module' => 'Brands'],
                ['name' => 'Delete Categories',   'slug' => 'brand-categories.delete', 'module' => 'Brands'],
                // Brands — Sub Category
                ['name' => 'View Sub Categories',   'slug' => 'brand-subcategories.view',   'module' => 'Brands'],
                ['name' => 'Create Sub Categories', 'slug' => 'brand-subcategories.create', 'module' => 'Brands'],
                ['name' => 'Edit Sub Categories',   'slug' => 'brand-subcategories.edit',   'module' => 'Brands'],
                ['name' => 'Delete Sub Categories', 'slug' => 'brand-subcategories.delete', 'module' => 'Brands'],
            ];

            foreach ($permissionData as $perm) {
                Permission::updateOrCreate(['slug' => $perm['slug']], $perm);
            }

            // ---------- Roles ----------
            $superadmin = Role::updateOrCreate(
                ['slug' => Role::SUPERADMIN_SLUG],
                ['name' => 'Super Admin', 'description' => 'Full access to everything', 'is_protected' => true, 'is_active' => true]
            );

            $admin = Role::updateOrCreate(
                ['slug' => 'admin'],
                ['name' => 'Admin', 'description' => 'Administrative access', 'is_protected' => false, 'is_active' => true]
            );

            $user = Role::updateOrCreate(
                ['slug' => 'user'],
                ['name' => 'User', 'description' => 'Standard user', 'is_protected' => false, 'is_active' => true]
            );

            // Super Admin bypasses checks in code, but we store every permission for transparency.
            $superadmin->permissions()->sync(Permission::pluck('id'));

            // Admin: sensible read/manage defaults — tweakable from the Permissions UI.
            $admin->permissions()->sync(Permission::whereIn('slug', [
                'dashboard.view',
                'roles.view',
                'users.view', 'users.create', 'users.edit',
                'permissions.view',
                'activity-logs.view',
            ])->pluck('id'));

            // Standard user: dashboard only by default.
            $user->permissions()->sync(Permission::whereIn('slug', ['dashboard.view'])->pluck('id'));

            // ---------- Elevate the first existing user to Super Admin (never creates one) ----------
            $firstUser = User::orderBy('id')->first();
            if ($firstUser && ! $firstUser->role_id) {
                $firstUser->role_id   = $superadmin->id;
                $firstUser->is_active = true;
                $firstUser->save();
            }
        });
    }
}
