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
/*Here is Authontication URL Routes*/
// Authentication Routes...
  $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
        $this->post('login', 'Auth\LoginController@login');
        $this->get('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        $this->post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        $this->post('password/reset', 'Auth\ResetPasswordController@reset');      

/*End of Auth URL Routes*/



//this is check user if it is login or not checkuser
Route::group(['middleware' => 'checkuser'], function() {
  
  Route::get('/registeruser',function(){
  	return view('menu_pages.register_user');
  });
  
  Route::get('/dashboard', 'HomeController@index')->name('home');
  
  Route::get('/home', function(){
	return redirect('dashboard');
	});
});


Route::any('/', function(){
        return view('auth.login');
});





//Route::get('/home', 'HomeController@index')->name('home');





//this route is for auth
Auth::routes();





