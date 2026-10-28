<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');

Route::get('/services', [PublicController::class, 'services'])->name('services.index');
Route::get('/services/{slug}', [PublicController::class, 'service'])->name('services.show');

Route::get('/projects', [PublicController::class, 'projects'])->name('projects.index');
Route::get('/projects/{slug}', [PublicController::class, 'project'])->name('projects.show');

Route::get('/properties', [PublicController::class, 'properties'])->name('properties.index');
Route::get('/properties/{slug}', [PublicController::class, 'property'])->name('properties.show');

Route::get('/gallery', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/team', [PublicController::class, 'team'])->name('team');
Route::get('/achievements', [PublicController::class, 'achievements'])->name('achievements');

Route::get('/news', [PublicController::class, 'news'])->name('news.index');
Route::get('/news/{slug}', [PublicController::class, 'newsDetail'])->name('news.show');

Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/locations', [PublicController::class, 'locations'])->name('locations');
Route::post('/inquiry', [PublicController::class, 'inquiry'])->name('inquiry.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'show'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/settings', [SettingsController::class, 'edit'])->name('settings');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries');
        Route::patch('/inquiries/{inquiry}', [InquiryController::class, 'update'])->name('inquiries.update');
        Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
        Route::get('/{module}', [CmsController::class, 'index'])->name('module.index');
        Route::get('/{module}/create', [CmsController::class, 'create'])->name('module.create');
        Route::post('/{module}', [CmsController::class, 'store'])->name('module.store');
        Route::get('/{module}/{item}/edit', [CmsController::class, 'edit'])->name('module.edit');
        Route::put('/{module}/{item}', [CmsController::class, 'update'])->name('module.update');
        Route::delete('/{module}/{item}', [CmsController::class, 'destroy'])->name('module.destroy');
    });
});
