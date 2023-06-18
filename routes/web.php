<?php

use Whoops\Run;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\admin\AdminController;

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
    return view('auth/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin/master');
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

// admin

Route::prefix('admin/')->group(function(){
    Route::get('list',[AdminController::class,'adminList'])->name('admin@adminList');
    Route::get('datatable/ssd',[AdminController::class,'ssd']);
    Route::get('profile',[AdminController::class,'profile'])->name('admin@profile');
    Route::get('changeProfile',[AdminController::class,'changeProfile'])->name('admin@changeProfile');
    Route::post('changeProfile/{id}',[AdminController::class,'Change'])->name('admin@change');
    Route::get('change/password',[AdminController::class,'changePasswordPage'])->name('admin@changePasswordPage');
    Route::post('changePassword',[AdminController::class,'ChangePassword'])->name('admin@changePassword');

    // category list
    Route::get('categroy/list',[CategoryController::class,'categoryList'])->name('admin@categoryList');
    Route::get('category/create',[CategoryController::class,'categoryCreatePage'])->name('admin@categoryCreatePage');
    Route::post('category/create',[CategoryController::class,'categoryCreate'])->name('admin@categoryCreate');
    Route::get('category/delete/{id}',[CategoryController::class,'categoryDelete'])->name('admin@categoryDelete');
    Route::get('category/editPage',[CategoryController::class,'editPage'])->name('admin@editPage');
    Route::post('category/edit/{id}',[CategoryController::class,'categoryEdit'])->name('admin@categoryEdit');

    // post
    Route::get('post/list',[PostController::class,'postList'])->name('admin@postList');
    Route::get('post/create',[PostController::class,'index'])->name('admin@postIndex');
    Route::post('post/create',[PostController::class,'Create'])->name('admin@postCreate');
    Route::get('post/delete/{id}',[PostController::class,'postDelete'])->name('admin@postDelete');
    Route::get('post/editPage{id}',[PostController::class,'postEditPage'])->name('admin@postEditPage');
    Route::post('post/update/{id}',[PostController::class,'postUpdate'])->name('admin@postUpdate');
    Route::get('post/details/{id}',[PostController::class,'postDetails'])->name('admin@postDetails');

    Route::get('allPost',[PostController::class,'allPost'])->name('admin@allPost');
});

// edit admin acount
Route::get('/user/{user}/edit',[AdminController::class,'edit']);

// delete admin account
Route::get('/user/{user}/delete',[AdminController::class,'destory']);