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

Route::get('/', 'NewsController@index')->name('news.index');

Auth::routes();

Route::get('/home', 'NewsController@admin_index')->name('home')->middleware('auth');

Route::get('/home/news/create', 'NewsController@create')->name('news.create')->middleware('auth');

Route::post('/home/news/create', 'NewsController@store')->name('news.store')->middleware('auth');

Route::get('/news/{id}', 'NewsController@show')->name('news.show');

Route::get('/category/{id}', 'NewsController@filter')->name('news.filter');

Route::get('home/categories', 'CategoryController@index')->name('categories.index');

Route::get('home/categories/create', 'CategoryController@create')->name('categories.create');

Route::post('home/categories/create', 'CategoryController@store')->name('categories.store')->middleware('auth');

Route::get('home/delete/{id}', 'NewsController@destroy')->name('news.delete')->middleware('auth');

Route::post('/news/comment', 'CommentController@store')->name('comments.store');

Route::get('home/comments', 'CommentController@index')->name('comments.index')->middleware('auth');

Route::get('home/comments/delete/{id}', 'CommentController@destroy')->name('comments.destroy')->middleware('auth');

Route::get('home/category/delete/{id}', 'CategoryController@destroy')->name('category.destroy')->middleware('auth');

Route::get('home/news/edit/{id}', 'NewsController@edit')->name('news.edit')->middleware('auth');

Route::post('home/news/edit/{id}', 'NewsController@update')->name('news.update')->middleware('auth');

Route::resource('users', 'UserController');

Route::get('home/profile/{id}', 'UserController@profile')->name('user.profile')->middleware('auth');

Route::get('/home/{id}', 'NewsController@admin_filter')->name('news.home')->middleware('auth');

Route::resource('tasks', 'ToDoListController');

Route::post('tasks/change/{id}', 'ToDoListController@status')->name('tasks.change')->middleware('auth');


