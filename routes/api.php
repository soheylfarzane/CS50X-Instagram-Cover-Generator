<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/site/data', [App\Http\Controllers\ApiController::class, 'data'])->name('apiData');
Route::get('/template/last', [App\Http\Controllers\ApiController::class, 'lastTemplate'])->name('apiLastTemplate');
Route::get('/categories/', [App\Http\Controllers\ApiController::class, 'categories'])->name('apiCategories');



//مسیر کاربران
Route::post('/otp', [App\Http\Controllers\ApiController::class, 'sendOtp'])->name('apiSendOtp');
Route::post('/check/otp', [App\Http\Controllers\ApiController::class, 'checkOtp'])->name('apiCheckOtp');
Route::post('/update/user', [App\Http\Controllers\ApiController::class, 'updateUser'])->name('apiUpdateUser');
Route::post('/upload', [App\Http\Controllers\ApiController::class, 'uploader'])->name('apiUploader');
