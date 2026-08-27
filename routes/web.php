<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ActivityLogController;
use App\Http\Controllers\Backend\MasterBrandController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductCategoryDetailsController;
use App\Http\Controllers\Backend\HomeBannerController;
use App\Http\Controllers\Backend\HomeProductIntroController;
use App\Http\Controllers\Backend\HomeCompanyStatsController;
use App\Http\Controllers\Backend\HomeAboutController;
use App\Http\Controllers\Backend\HomeClientsController;
use App\Http\Controllers\Backend\HomeTestimonyIntroController;
use App\Http\Controllers\Backend\HomeKnowledgeSpectrumController;
use App\Http\Controllers\Backend\HomeConnectController;
use App\Http\Controllers\Backend\HomeEventsController;
use App\Http\Controllers\Backend\ContactDetailsController;
use App\Http\Controllers\Backend\TestimonialsController;
use App\Http\Controllers\Backend\EventsController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AboutIntroController;
use App\Http\Controllers\Backend\AboutQualitiesController;
use App\Http\Controllers\Backend\AboutCustomerController;
use App\Http\Controllers\Backend\CareerPageController;


// =========================================================================== Frontend Routes

Route::get('/', [HomeController::class, 'index'])->name('frontend.index');
Route::get('/about-us', [HomeController::class, 'about_us'])->name('frontend.about_us');
Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('frontend.contact_us');
Route::get('/careers', [HomeController::class, 'careers'])->name('frontend.careers');
Route::get('/product/{slug}', [HomeController::class, 'product_category_details'])->name('frontend.product_category_details');

// =========================================================================== Backend Routes


// Authentication Routes
Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/change-password', [LoginController::class, 'change_password'])->name('admin.changepassword');
Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('admin.updatepassword');

Route::get('/register', [LoginController::class, 'register'])->name('admin.register');
Route::post('/register', [LoginController::class, 'authenticate_register'])->name('admin.register.authenticate');
    
// Admin Routes with Middleware
Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // ===== Roles =====
        Route::get('roles',             [RoleController::class, 'index'])->middleware('permission:roles.view')->name('admin.roles.index');
        Route::get('roles/create',      [RoleController::class, 'create'])->middleware('permission:roles.create')->name('admin.roles.create');
        Route::post('roles',            [RoleController::class, 'store'])->middleware('permission:roles.create')->name('admin.roles.store');
        Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->middleware('permission:roles.edit')->name('admin.roles.edit');
        Route::put('roles/{role}',      [RoleController::class, 'update'])->middleware('permission:roles.edit')->name('admin.roles.update');
        Route::delete('roles/{role}',   [RoleController::class, 'destroy'])->middleware('permission:roles.delete')->name('admin.roles.destroy');

        // ===== Users =====
        Route::get('users',             [UserController::class, 'index'])->middleware('permission:users.view')->name('admin.users.index');
        Route::get('users/create',      [UserController::class, 'create'])->middleware('permission:users.create')->name('admin.users.create');
        Route::post('users',            [UserController::class, 'store'])->middleware('permission:users.create')->name('admin.users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('permission:users.edit')->name('admin.users.edit');
        Route::put('users/{user}',      [UserController::class, 'update'])->middleware('permission:users.edit')->name('admin.users.update');
        Route::delete('users/{user}',   [UserController::class, 'destroy'])->middleware('permission:users.delete')->name('admin.users.destroy');

        // ===== Permissions — per-role assignment matrix =====
        Route::get('permissions',              [PermissionController::class, 'index'])->middleware('permission:permissions.view')->name('admin.permissions.index');
        Route::get('permissions/{role}/edit',  [PermissionController::class, 'edit'])->middleware('permission:permissions.assign')->name('admin.permissions.edit');
        Route::put('permissions/{role}',       [PermissionController::class, 'update'])->middleware('permission:permissions.assign')->name('admin.permissions.update');

        // ===== Permissions — catalog CRUD (add new permissions as new tabs appear) =====
        Route::get('permissions-catalog',                   [PermissionController::class, 'manage'])->middleware('permission:permissions.assign')->name('admin.permissions.manage');
        Route::get('permissions-catalog/create',            [PermissionController::class, 'createPermission'])->middleware('permission:permissions.assign')->name('admin.permissions.manage.create');
        Route::post('permissions-catalog',                  [PermissionController::class, 'storePermission'])->middleware('permission:permissions.assign')->name('admin.permissions.manage.store');
        Route::get('permissions-catalog/{permission}/edit', [PermissionController::class, 'editPermission'])->middleware('permission:permissions.assign')->name('admin.permissions.manage.edit');
        Route::put('permissions-catalog/{permission}',      [PermissionController::class, 'updatePermission'])->middleware('permission:permissions.assign')->name('admin.permissions.manage.update');
        Route::delete('permissions-catalog/{permission}',   [PermissionController::class, 'destroyPermission'])->middleware('permission:permissions.assign')->name('admin.permissions.manage.destroy');

        // ===== Activity Log (audit trail) =====
        Route::get('activity-logs',                 [ActivityLogController::class, 'index'])->middleware('permission:activity-logs.view')->name('admin.activity-logs.index');
        Route::get('activity-logs/archives',        [ActivityLogController::class, 'archives'])->middleware('permission:activity-logs.manage')->name('admin.activity-logs.archives');
        Route::get('activity-logs/archives/{file}', [ActivityLogController::class, 'downloadArchive'])->middleware('permission:activity-logs.manage')->name('admin.activity-logs.archive.download');
        Route::post('activity-logs/archive/run',    [ActivityLogController::class, 'runArchive'])->middleware('permission:activity-logs.manage')->name('admin.activity-logs.archive.run');
        Route::post('activity-logs/archive/restore', [ActivityLogController::class, 'restoreArchive'])->middleware('permission:activity-logs.manage')->name('admin.activity-logs.archive.restore');
        Route::get('activity-logs/{id}',            [ActivityLogController::class, 'show'])->whereNumber('id')->middleware('permission:activity-logs.view')->name('admin.activity-logs.show');

        // ===== Brands — Main Category =====
        Route::resource('manage-brand-category', MasterBrandController::class)->except('show');

        // ===== Brands — Sub Category =====
        Route::resource('manage-brand-list', SubCategoryController::class)->except('show');

        // ===== Products — Category =====
        Route::resource('manage-product-category', ProductCategoryController::class)->except('show');
        Route::resource('manage-product-category-details', ProductCategoryDetailsController::class)->except('show');


        // ===== Home Page Section ===== 
        Route::resource('manage-home-banner', HomeBannerController::class)->except('show');
        Route::resource('manage-product-intro', HomeProductIntroController::class)->except('show');
        Route::resource('manage-company-stats', HomeCompanyStatsController::class)->except('show');
        Route::resource('manage-home-about', HomeAboutController::class)->except('show');
        Route::resource('manage-home-clients', HomeClientsController::class)->except('show');
        Route::resource('manage-testimony-intro', HomeTestimonyIntroController::class)->except('show');
        Route::resource('manage-home-knowledge-spectrum', HomeKnowledgeSpectrumController::class)->except('show');
        Route::resource('manage-home-connection', HomeConnectController::class)->except('show');
        Route::resource('manage-home-events', HomeEventsController::class)->except('show');


        // ===== About Us — Introduction =====
        Route::resource('manage-about-intro', AboutIntroController::class)->except('show');
        Route::resource('manage-about-qualities', AboutQualitiesController::class)->except('show');
        Route::resource('manage-about-customer', AboutCustomerController::class)->except('show');

        // Career
        Route::resource('manage-career-page-details', CareerPageController::class)->except('show');


        // ====== Contact Details
        Route::resource('manage-contact-details', ContactDetailsController::class)->except('show');
        
        // ====== Testimonials
        Route::resource('manage-testimonials', TestimonialsController::class)->except('show');

        // ====== Events
        Route::resource('manage-events', EventsController::class)->except('show');

});