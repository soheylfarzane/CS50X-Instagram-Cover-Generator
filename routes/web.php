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

Route::get('generate/{key}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/templates', [App\Http\Controllers\TemplateController::class, 'templates'])->name('templates');
Route::get('/add/template', [App\Http\Controllers\TemplateController::class, 'addTemplate'])->name('addTemplate');
Route::post('/add/template', [App\Http\Controllers\TemplateController::class, 'storeTemplate'])->name('storeTemplate');


Route::post('/generator/{key}', [App\Http\Controllers\HomeController::class, 'generator'])->name('generator');

Route::get('/add/category', [App\Http\Controllers\CategoryController::class, 'addCategory'])->name('addCategory');
Auth::routes();


