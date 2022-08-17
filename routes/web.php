<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EditorController;
use App\Http\Controllers\Admin\PostController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth','isAdmin')->prefix('admin')->group(function() {

    //Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index']);

    //Category Routes
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::get('/category/{category}/edit','edit');

        Route::post('/category', 'store');
        Route::put('/category/{category}', 'update');

    });

    //Post Controller
    Route::controller(PostController::class)->group(function(){
        Route::get('/post','index');
        Route::get('/post/create', 'create');
        Route::get('/post/{post}/edit','edit');
        Route::get('/post/{post_id}/delete','destroy');

        Route::post('/post','store');
        Route::put('/post/{post}', 'update');

    });

    //Editor Controller
    Route::post('/images', [EditorController::class,'store'])->name('images.store');

});
