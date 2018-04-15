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

Route::get('/home', 'HomeController@index')->name('home');
// Remember  UserRegistration route I have to redirect outer controller UserRegController.
Route::post('/UserRegistration','Auth\RegisterController@userRegistration')->name('UserRegistration');
Route::get('/users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');
Route::post('/userLogin', 'UserLoginController@login')->name('userLogin');
Route::post('/updateReg/{id}','UserRegController@update')->name('updateReg');