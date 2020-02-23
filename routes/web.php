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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');;



// Authentication Routes...
Route::get('login', [
  'as' => 'login',
  'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
  'as' => '',
  'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
  'as' => 'logout',
  'uses' => 'Auth\LoginController@logout'
]);

// Password Reset Routes...
Route::post('password/email', [
  'as' => 'password.email',
  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
  'as' => 'password.request',
  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
  'as' => '',
  'uses' => 'Auth\ResetPasswordController@reset'
])->name('password.update');
Route::get('password/reset/{token}', [
  'as' => 'password.reset',
  'uses' => 'Auth\ResetPasswordController@showResetForm'
]);


Route::group(['middleware'=>'administrator'], function () {

  Route::get('/administrator', 'Administrator\Dashboard@index')->name('administrator.dashboard');

  Route::get('/profile', 'Administrator\ProfileController@index')->name('administrator.profile');
  Route::post('/profile', 'Administrator\ProfileController@update')->name('administrator.profile.update');

  Route::get('/dataset', 'Administrator\DatasetController@index')->name('administrator.dataset');
  Route::post('/dataset/import', 'Administrator\DatasetController@import')->name('administrator.dataset.import');

  Route::get('/hitung', 'Administrator\DatasetController@hitung_get');
  Route::post('/hitung', 'Administrator\DatasetController@hitung')->name('administrator.dataset.hitung');
});
