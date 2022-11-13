<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// for github
Route::get('/auth/redirect',[AuthController::class,'githubRedirect'])->name('github@redirect');
Route::get('/auth/callback',[AuthController::class,'githubCallback'])->name('github@callback');

// for google
Route::get('/auth/google/redirect',[AuthController::class,'googleRedirect'])->name('google@redirect');
Route::get('/auth/google/callback',[AuthController::class,'googleCallback'])->name('google@callback');

// for facebook 
Route::get('/auth/facebook/redirect',[AuthController::class,'facebookRedirect'])->name('facebook@redirect');
Route::get('/auth/facebook/callback',[AuthController::class,'facebookCallback'])->name('facebook@callback');