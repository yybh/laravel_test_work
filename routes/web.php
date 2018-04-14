<?php

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

Route::get('/', 'IndexController@index')->name('/');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::get('signup', 'UsersController@create')->name('signup');

Route::get('borrow/{id}', 'BorrowController@borrow');

Route::resource('users', 'UsersController');

Route::get('admin', 'AdminController@index')->name('admin');
Route::get('admin/books', 'AdminController@books')->name('books');

Route::get('admin/booksadd', 'AdminController@booksadd')->name('booksadd');
Route::post('admin/booksaddpost', 'AdminController@booksaddpost')->name('booksaddpost');
Route::get('admin/booksedit', 'AdminController@booksedit')->name('booksedit');
Route::post('admin/bookseditpost', 'AdminController@bookseditpost')->name('bookseditpost');
Route::get('admin/booksdelete', 'AdminController@booksdelete')->name('booksdelete');

Route::get('admin/bookslog', 'AdminController@bookslog')->name('bookslog');
Route::get('admin/booksback', 'AdminController@booksback')->name('booksback');

Route::get('admin/users', 'AdminController@users')->name('users');
Route::get('admin/usersadd', 'AdminController@usersadd')->name('usersadd');
Route::post('admin/usersaddpost', 'AdminController@usersaddpost')->name('usersaddpost');
Route::get('admin/usersdelete', 'AdminController@usersdelete')->name('usersdelete');
Route::get('admin/usersedit', 'AdminController@usersedit')->name('usersedit');
Route::post('admin/userseditpost', 'AdminController@userseditpost')->name('userseditpost');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
