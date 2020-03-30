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

Auth::routes();

//NewsController
Route::resource('news', 'NewsController');
Route::get('/', 'NewsController@index')->name('news.index');
Route::get('/admin', 'NewsController@admin_index')->name('home');
Route::get('news/category/{id}', 'NewsController@filter')->name('news.filter');
Route::get('/admin/{id}', 'NewsController@admin_filter')->name('news.home');

//CategoryController
Route::resource('category', 'CategoryController');

//CommentController
Route::resource('comments', 'CommentController');

//UserController
Route::resource('users', 'UserController');
Route::get('admin/profile/{id}', 'UserController@profile')->name('user.profile');


//ToDoListController
Route::resource('tasks', 'ToDoListController');
Route::post('tasks/change/{id}', 'ToDoListController@status')->name('tasks.change');




