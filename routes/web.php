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
Route::get('/admin/book/view/{id}', 'admin\BookController@show')->name('admin.book.view');
Route::get('/admin/book/edit/{id}', 'admin\BookController@edit')->name('admin.book.edit');
Route::post('/admin/book/update/{id}', 'admin\BookController@update')->name('admin.book.update');
Route::get('/admin/book/delete/{id}', 'admin\BookController@destroy')->name('admin.book.delete');

Route::get('/admin/member', 'admin\MemberController@index');
Route::get('/admin/member/data', 'admin\MemberController@LoadData');
Route::get('/admin/member/create', 'admin\MemberController@create');
Route::post('/admin/member/save', 'admin\MemberController@store');
Route::get('/admin/member/view/{id}', 'admin\MemberController@show')->name('admin.member.view');
Route::get('/admin/member/edit/{id}', 'admin\MemberController@edit')->name('admin.member.edit');
Route::post('/admin/member/update/{id}', 'admin\MemberController@update')->name('admin.member.update');
Route::get('/admin/member/delete/{id}', 'admin\MemberController@destroy')->name('admin.member.delete');

Route::get('/admin/pinjam', 'admin\PinjamanController@index');
Route::get('/admin/pinjam/data', 'admin\PinjamanController@LoadData');
Route::post('/admin/pinjam/approval', 'admin\PinjamanController@store');

Route::get('/member/pinjam', 'PinjamController@index');
Route::get('/member/pinjam/data', 'PinjamController@LoadData');
Route::get('/member/pinjam/create', 'PinjamController@create')->name('pinjam.pengajuan');
Route::post('/member/pinjam/approval', 'PinjamController@store')->name('pinjam.save');
Route::get('/member/pinjam/list', 'PinjamController@LoadDataPinjam');
Route::post('/member/pinjam/update', 'PinjamController@update')->name('pinjam.update');
