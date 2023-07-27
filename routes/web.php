<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
//مسیر های عمومی مدیریت
Route::get('/', [App\Http\Controllers\HomeController::class, 'main'])->name('dashboard');
Route::get('generate/{key}', [App\Http\Controllers\HomeController::class, 'index'])->name('generator');

//مسیر های مرتبط با قالب ها
Route::get('/templates', [App\Http\Controllers\TemplateController::class, 'templates'])->name('templates');
Route::get('/add/template', [App\Http\Controllers\TemplateController::class, 'addTemplate'])->name('addTemplate');
Route::post('/add/template', [App\Http\Controllers\TemplateController::class, 'storeTemplate'])->name('storeTemplate');

//مسیر های مرتبط با سازنده
Route::post('/generator/{key}', [App\Http\Controllers\HomeController::class, 'generator'])->name('generator');

//مسیر های مرتبط با دسته بندی
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'categories'])->name('categories');
Route::get('/add/category', [App\Http\Controllers\CategoryController::class, 'addCategory'])->name('addCategory');
Route::post('/add/category', [App\Http\Controllers\CategoryController::class, 'storeCategory'])->name('storeCategory');
Route::post('/delete/category/{id}', [App\Http\Controllers\CategoryController::class, 'deleteCategory'])->name('deleteCategory');

//مسیر های مرتبط با فونت ها
Route::get('/fontsList', [App\Http\Controllers\FontController::class, 'fontsList'])->name('fontsList');
    Route::get('/add/font', [App\Http\Controllers\FontController::class, 'addFont'])->name('addFont');
//مسیر های مرتبط با تنظیمات
Route::get('/setting', [App\Http\Controllers\SettingController::class, 'setting'])->name('setting');

//مسیر های مرتبط با نتایج


//مسیر های مرتبط با آپلود فایل ها

// مسیر های مرتبط با کاربران
Route::get('/users', [App\Http\Controllers\UserController::class, 'usersList'])->name('usersList');
