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

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
    Route::group(['middleware' => ['auth:admin']], function ()
    {
      /* routes by developer */
      Route::get("/dashboard","Admin\DashboardController@index");
      Route::get("/temscondition","Admin\CmsController@term_condition");
      Route::post("/temscondition","Admin\CmsController@term_condition_update");

      Route::get("/policy","Admin\CmsController@policy");
      Route::post("/policy","Admin\CmsController@policy_update");

      Route::get('/aboutus', 'Admin\CmsController@aboutus');
      Route::post('/aboutus', 'Admin\CmsController@aboutus_update');
    });

});
