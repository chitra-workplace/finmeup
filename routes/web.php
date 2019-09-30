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
  return redirect()->route('login');
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

      Route::get("/changepassword","Admin\AdminController@changepassword");
      Route::post("/changepassword","Admin\AdminController@updatePassword");
      Route::resource("/profile","Admin\AdminController");

      Route::get("/users","Admin\UserController@index");

      Route::get("/quiz","Admin\QuizController@index");
      Route::get('/postquiz', 'Admin\QuizController@postquiz');
      Route::post("/create_quiz","Admin\QuizController@create_quiz");
      Route::get('/delete_quiz/{id}', 'Admin\QuizController@delete_quiz');
      Route::get('/edit_quiz/{id}', 'Admin\QuizController@edit_quiz');
      Route::post('/update_quiz', 'Admin\QuizController@update_quiz');
      Route::get('/remove_quiz_qus/{id}', 'Admin\QuizController@remove_quiz_qus');
      Route::get('/changes_quiz_status/{id}/{status}', 'Admin\QuizController@changes_quiz_status');
      
      Route::get("/stockpicks","Admin\StockController@index");
      Route::get("/poststock","Admin\StockController@poststock");
      Route::post("/create_stock","Admin\StockController@create_stock");
      Route::get('/edit_stock/{id}', 'Admin\StockController@edit_stock');
      Route::get('/delete_stock/{id}', 'Admin\StockController@delete_stock');
      Route::post('/update_stock', 'Admin\StockController@update_stock');
      Route::get('/change_stock_status/{id}/{status}', 'Admin\StockController@change_stock_status');
      

    });

});
