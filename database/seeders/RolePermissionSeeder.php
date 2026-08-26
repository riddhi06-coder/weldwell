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
                // Home — Banner
                ['name' => 'View Banners',   'slug' => 'home-banners.view',   'module' => 'Home Page'],
                ['name' => 'Create Banners', 'slug' => 'home-banners.create', 'module' => 'Home Page'],
                ['name' => 'Edit Banners',   'slug' => 'home-banners.edit',   'module' => 'Home Page'],
                ['name' => 'Delete Banners', 'slug' => 'home-banners.delete', 'module' => 'Home Page'],
                // Home — Product Intro
                ['name' => 'View Product Intro',   'slug' => 'product-intros.view',   'module' => 'Home Page'],
                ['name' => 'Create Product Intro', 'slug' => 'product-intros.create', 'module' => 'Home Page'],
                ['name' => 'Edit Product Intro',   'slug' => 'product-intros.edit',   'module' => 'Home Page'],
                ['name' => 'Delete Product Intro', 'slug' => 'product-intros.delete', 'module' => 'Home Page'],
                // Home — Company Stats
                ['name' => 'View Company Stats',   'slug' => 'company-stats.view',   'module' => 'Home Page'],
                ['name' => 'Create Company Stats', 'slug' => 'company-stats.create', 'module' => 'Home Page'],
                ['name' => 'Edit Company Stats',   'slug' => 'company-stats.edit',   'module' => 'Home Page'],
                ['name' => 'Delete Company Stats', 'slug' => 'company-stats.delete', 'module' => 'Home Page'],
                // Home — About
                ['name' => 'View About',   'slug' => 'home-about.view',   'module' => 'Home Page'],
                ['name' => 'Create About', 'slug' => 'home-about.create', 'module' => 'Home Page'],
                ['name' => 'Edit About',   'slug' => 'home-about.edit',   'module' => 'Home Page'],
                ['name' => 'Delete About', 'slug' => 'home-about.delete', 'module' => 'Home Page'],
                // Home — Clients
                ['name' => 'View Clients',   'slug' => 'home-clients.view',   'module' => 'Home Page'],
                ['name' => 'Create Clients', 'slug' => 'home-clients.create', 'module' => 'Home Page'],
                ['name' => 'Edit Clients',   'slug' => 'home-clients.edit',   'module' => 'Home Page'],
                ['name' => 'Delete Clients', 'slug' => 'home-clients.delete', 'module' => 'Home Page'],
                // Home — Testimony Intro
                ['name' => 'View Testimony Intro',   'slug' => 'testimony-intros.view',   'module' => 'Home Page'],
                ['name' => 'Create Testimony Intro', 'slug' => 'testimony-intros.create', 'module' => 'Home Page'],
                ['name' => 'Edit Testimony Intro',   'slug' => 'testimony-intros.edit',   'module' => 'Home Page'],
                ['name' => 'Delete Testimony Intro', 'slug' => 'testimony-intros.delete', 'module' => 'Home Page'],
                // Home — Knowledge Spectrum
                ['name' => 'View Knowledge Spectrum',   'slug' => 'knowledge-spectrum.view',   'module' => 'Home Page'],
                ['name' => 'Create Knowledge Spectrum', 'slug' => 'knowledge-spectrum.create', 'module' => 'Home Page'],
                ['name' => 'Edit Knowledge Spectrum',   'slug' => 'knowledge-spectrum.edit',   'module' => 'Home Page'],
                ['name' => 'Delete Knowledge Spectrum', 'slug' => 'knowledge-spectrum.delete', 'module' => 'Home Page'],
                // Home — Connection
                ['name' => 'View Connection',   'slug' => 'home-connection.view',   'module' => 'Home Page'],
                ['name' => 'Create Connection', 'slug' => 'home-connection.create', 'module' => 'Home Page'],
                ['name' => 'Edit Connection',   'slug' => 'home-connection.edit',   'module' => 'Home Page'],
                ['name' => 'Delete Connection', 'slug' => 'home-connection.delete', 'module' => 'Home Page'],
                // Home — Event Intro
                ['name' => 'View Event Intro',   'slug' => 'home-events.view',   'module' => 'Home Page'],
                ['name' => 'Create Event Intro', 'slug' => 'home-events.create', 'module' => 'Home Page'],
                ['name' => 'Edit Event Intro',   'slug' => 'home-events.edit',   'module' => 'Home Page'],
                ['name' => 'Delete Event Intro', 'slug' => 'home-events.delete', 'module' => 'Home Page'],
                // Contact Details
                ['name' => 'View Contact Details',   'slug' => 'contact-details.view',   'module' => 'Contact'],
                ['name' => 'Create Contact Details', 'slug' => 'contact-details.create', 'module' => 'Contact'],
                ['name' => 'Edit Contact Details',   'slug' => 'contact-details.edit',   'module' => 'Contact'],
                ['name' => 'Delete Contact Details', 'slug' => 'contact-details.delete', 'module' => 'Contact'],
                // Testimonials
                ['name' => 'View Testimonials',   'slug' => 'testimonials.view',   'module' => 'Testimonials'],
                ['name' => 'Create Testimonials', 'slug' => 'testimonials.create', 'module' => 'Testimonials'],
                ['name' => 'Edit Testimonials',   'slug' => 'testimonials.edit',   'module' => 'Testimonials'],
                ['name' => 'Delete Testimonials', 'slug' => 'testimonials.delete', 'module' => 'Testimonials'],
                // Events
                ['name' => 'View Events',   'slug' => 'events.view',   'module' => 'Events'],
                ['name' => 'Create Events', 'slug' => 'events.create', 'module' => 'Events'],
                ['name' => 'Edit Events',   'slug' => 'events.edit',   'module' => 'Events'],
                ['name' => 'Delete Events', 'slug' => 'events.delete', 'module' => 'Events'],
                // About Us — Introduction
                ['name' => 'View About Intro',   'slug' => 'about-intro.view',   'module' => 'About Us'],
                ['name' => 'Create About Intro', 'slug' => 'about-intro.create', 'module' => 'About Us'],
                ['name' => 'Edit About Intro',   'slug' => 'about-intro.edit',   'module' => 'About Us'],
                ['name' => 'Delete About Intro', 'slug' => 'about-intro.delete', 'module' => 'About Us'],
                // About Us — Core Qualities
                ['name' => 'View Core Qualities',   'slug' => 'about-qualities.view',   'module' => 'About Us'],
                ['name' => 'Create Core Qualities', 'slug' => 'about-qualities.create', 'module' => 'About Us'],
                ['name' => 'Edit Core Qualities',   'slug' => 'about-qualities.edit',   'module' => 'About Us'],
                ['name' => 'Delete Core Qualities', 'slug' => 'about-qualities.delete', 'module' => 'About Us'],
                // About Us — Customers Served
                ['name' => 'View Customers Served',   'slug' => 'about-customer.view',   'module' => 'About Us'],
                ['name' => 'Create Customers Served', 'slug' => 'about-customer.create', 'module' => 'About Us'],
                ['name' => 'Edit Customers Served',   'slug' => 'about-customer.edit',   'module' => 'About Us'],
                ['name' => 'Delete Customers Served', 'slug' => 'about-customer.delete', 'module' => 'About Us'],
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
