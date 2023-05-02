<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\APITESTController;
use App\Http\Controllers\SiteController;

// use App\Http\Controllers\Admin\CategoryController;

// 1 => 7
// Route::group(['prefix' => 'admin', 'as' => 'name.'], function() {

// });

// 8 => 10
Route::prefix('admin')->name('admin.')->middleware('auth', 'checktype')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'settings_data'])->name('settings_data');

    Route::resource('categories', CategoryController::class);
    Route::resource('courses', CourseController::class);

});

// Route::get('logoutttttttt', function() {
//     Auth::logout();
// });

Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/about', [SiteController::class, 'about'])->name('site.about');
Route::get('/courses', [SiteController::class, 'courses'])->name('site.courses');
Route::get('/courses/{id}', [SiteController::class, 'course'])->name('site.course');
Route::get('/courses/{id}/enroll', [SiteController::class, 'enroll'])->name('site.enroll')->middleware('auth');
Route::get('/courses/{id}/payment', [SiteController::class, 'payment'])->name('site.payment')->middleware('auth');

Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('api-test', [APITESTController::class, 'test']);
Route::get('weather', [APITESTController::class, 'weather']);
