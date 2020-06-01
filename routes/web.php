<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('contacto', 'HomeController@contact')->name('contact');

//Users Routes
Route::resource('users', 'UserController');
Route::get('users/{slug}/comments', 'UserController@getComments')->name('users.comments');

//Posts Routes
Route::resource('posts', 'PostsController')->only('index', 'create','show', 'edit','store');
Route::post('posts/{id}/update', 'PostsController@update')->name('posts.update');
Route::get('posts/{id}/destroy', 'PostsController@destroy')->name('posts.destroy');

//Rutas protegidas por Autenticacion
Route::middleware('auth')->group(function (){
//Comments Routes
    Route::resource('comments', 'CommentsController')->only('store');
    Route::get('comments/{id}/destroy','CommentsController@destroy')->name('comments.destroy');
});
