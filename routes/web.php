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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/createPost', [App\Http\Controllers\PostController::class, 'creat'])->name('createPost');

Route::post('/follow', [App\Http\Controllers\FollowerController::class, 'addfolower'] )->name('follow');

Route::post('/unfollow/{id}', [App\Http\Controllers\FollowerController::class, 'unfolower'] )->name('unfollow');
