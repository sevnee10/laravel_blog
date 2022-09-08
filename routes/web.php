<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EditorController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Client\ClientController;
use App\Models\Category;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home',[ClientController::class,'index'])->name('home');

Route::get('/',[ClientController::class,'index']);
Route::get('/posts/{post_id}',[ClientController::class,'details_post']);
Route::get('/your-posts',[ClientController::class,'your_posts']);
Route::get('/create-post',[ClientController::class,'create_your_post']);
Route::get('/your-post/{post}/edit',[ClientController::class,'edit_your_post']);
Route::get('/your-post/{post}/delete',[ClientController::class,'delete_your_post']);
Route::get('/save-liked', [ClientController::class,'save_liked']);

Route::post('/save-post',[ClientController::class,'save_post']);
Route::post('/client-images', [ClientController::class,'store_image'])->name('client-images.store');
Route::post('/search-post', [ClientController::class,'search'])->name('search-post.search');
Route::post('/ajax-login', [ClientController::class,'ajax_login'])->name('ajax-login.ajax_login');
Route::post('/ajax-comment/{post_id}', [ClientController::class,'ajax_comment'])->name('ajax-comment.ajax_comment');
Route::put('/your-post/{post}',[ClientController::class,'update_your_post']);

Route::middleware('auth','isAdmin')->prefix('admin')->group(function() {

    //Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index']);

    //Category Routes
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::get('/category/{category}/edit','edit');
        Route::get('/category/{category_id}/delete','destroy');

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
