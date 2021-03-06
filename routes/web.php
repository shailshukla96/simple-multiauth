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
})->name('landingPage');

// Authentication Routes
Auth::routes();

// Admin Resource Routes for Institute CRUD
Route::resource('/institute', 'InstitutesController');

// Guest Resource Routes for Reviews CRUD
Route::resource('/review', 'ReviewsController');

// Guest Routes
Route::get('/institutes/all', 'InstitutesController@index')->name('institute.all');
Route::get('/institutes/single/{id}', 'InstitutesController@getSingle')->name('institute.single');

// Student specified Routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('home/stats/boards', 'HomeController@boards')->name('stats.boards');
Route::get('home/stats/ratings', 'HomeController@ratings')->name('stats.ratings');
Route::get('home/stats/locations', 'HomeController@locations')->name('stats.locations');
Route::post('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');


// Admin specified Routes
Route::prefix('admin')->group(function(){
  Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm');
  Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register');
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
  Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});
