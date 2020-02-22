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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/member', 'Auth\LoginController@showMemberLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/member', 'Auth\RegisterController@showMemberRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/member', 'Auth\LoginController@MemberLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/member', 'Auth\RegisterController@createMember');

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/admin', 'admin');
Route::view('/member', 'member');

Route::get('/admin/book', 'admin\BookController@index');
Route::get('/admin/book/data', 'admin\BookController@LoadData');
Route::get('/admin/book/create', 'admin\BookController@create');
Route::post('/admin/book/save', 'admin\BookController@store');
Route::get('/admin/book/view/{id}', 'admin\BookController@view')->name('admin.book.view');
Route::get('/admin/book/edit/{id}', 'admin\BookController@edit')->name('admin.book.edit');
Route::post('/admin/book/update/{id}', 'admin\BookController@update')->name('admin.book.update');
Route::get('/admin/book/delete/{id}', 'admin\BookController@destroy')->name('admin.book.delete');

