<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;

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

Route::get('/','App\Http\Controllers\HomeController@index');

Route::get('/dashboard','App\Http\Controllers\DashboardController@index')->name('dashboard');

Route::get('/dashboard/search','App\Http\Controllers\DashboardController@search')->name('dashboard.search');

// Article

Route::get('/article','App\Http\Controllers\ArticleController@index')->name('article');

Route::get('/article/create','App\Http\Controllers\ArticleController@create')->name('article.create');

Route::post('/article/create','App\Http\Controllers\ArticleController@store')->name('article.store');

Route::get('/article/{title}','App\Http\Controllers\ArticleController@detail')->name('article.detail');

Route::get('/article/edit/{id}','App\Http\Controllers\ArticleController@edit')->name('article.edit');

Route::post('/article/{id}','App\Http\Controllers\ArticleController@update')->name('article.update');

Route::get('/article/destroy/{id}','App\Http\Controllers\ArticleController@destroy')->name('article.destroy');

Route::get('/article/like/{id}','App\Http\Controllers\ArticleController@like')->name('article.like');

Route::post('/article/comment/{id}','App\Http\Controllers\ArticleController@comment')->name('article.comment');

// User

Route::get('/user','App\Http\Controllers\UserController@index')->name('user');

Route::get('/user/create','App\Http\Controllers\UserController@create')->name('user.create');

Route::post('/user','App\Http\Controllers\UserController@store')->name('user.store');

Route::get('/user/destroy/{id}','App\Http\Controllers\UserController@destroy')->name('user.destroy');

Route::get('/user/edit/{id}','App\Http\Controllers\UserController@edit')->name('user.edit');

Route::post('/user/{id}','App\Http\Controllers\UserController@update')->name('user.update');

// Gallery

Route::get('/gallery','App\Http\Controllers\GalleryController@index')->name('gallery');

Route::get('/gallery/create','App\Http\Controllers\GalleryController@create')->name('gallery.create');

Route::post('/gallery/create','App\Http\Controllers\GalleryController@store')->name('gallery.store');

Route::get('/gallery/edit/{id}','App\Http\Controllers\GalleryController@edit')->name('gallery.edit');

Route::post('/gallery/{id}','App\Http\Controllers\GalleryController@update')->name('gallery.update');

Route::get('/gallery/destroy/{id}','App\Http\Controllers\GalleryController@destroy')->name('gallery.destroy');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
