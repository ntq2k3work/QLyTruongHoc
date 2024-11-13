<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/login',[AuthController::class,'loginForm'])->name('auth.loginForm')->middleware('guest');
Route::post('/login',[AuthController::class,'login'])->name('auth.login')->middleware('guest');
Route::post('/logout',[AuthController::class,'logout'])->name('auth.logout')->middleware('auth');
Route::get('/forgot',[AuthController::class,'forgotForm'])->name('auth.forgotForm')->middleware('guest');
Route::post('/forgot',[AuthController::class,'forgot'])->name('auth.forgot')->middleware('guest');
Route::get('/reset',[AuthController::class,'resetForm'])->name('auth.resetForm')->middleware(['guest','reset']);
Route::post('/reset',[AuthController::class,'resetPassword'])->name('auth.password.reset')->middleware(['guest','reset']);

