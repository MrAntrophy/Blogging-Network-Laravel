<?php

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


Route::resource('posts', 'App\Http\Controllers\PostsController');
Route::resource('users', 'App\Http\Controllers\UsersController');
Route::resource('contacts', 'App\Http\Controllers\ContactsController');
Route::resource('friends', 'App\Http\Controllers\FriendsController');
Route::resource('comments', 'App\Http\Controllers\CommentsController');
Route::resource('categories', 'App\Http\Controllers\CategoriesController');
Route::resource('galleries', 'App\Http\Controllers\GalleriesController');
Route::Post('addlike', 'App\Http\Controllers\PostsController@addlike');
Route::Delete('removelike', 'App\Http\Controllers\PostsController@removelike');
Auth::routes();

Route::get('/yourposts', [App\Http\Controllers\HomeController::class, 'index'])->name('yourposts');
Route::get('/', [App\Http\Controllers\PostsController::class, 'index'])->name('home');
