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
// !for going home
Route::get('/', 'HomeController@index')->name('home');// ? if exist send it if not show home
// !for showing the post spisifique
Route::get('/post/{slug}', 'HomeController@show')->name('post.show');  //we add name to call it in href call it what you want
// !for going to create post page 
Route::get('/create/post', 'HomeController@create')->name('post.create');  //we can add name to call it in href, call it what you want
// !for creating the post in DB
Route::post('/add/post', 'HomeController@store')->name('post.store'); //we use post this time to send data
// !for going to edit post page with id
Route::get('/edit/post/{slug}', 'HomeController@edit')->name('post.edit'); //we use post this time to send data
// !for update the post
Route::put('/update/post/{slug}', 'HomeController@update')->name('post.update'); //we use post this time to send data
// !for delete the post
Route::delete('/delete/post/{slug}', 'HomeController@delete')->name('post.delete'); //we use post this time to send data




Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
