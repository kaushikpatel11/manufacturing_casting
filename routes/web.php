<?php

use Illuminate\Support\Facades\Route;

$ADMIN_PREFIX = "admin";

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

Route::group(['prefix' => $ADMIN_PREFIX], function() {

    Route::get('/', 'admin\AdminLoginController@getLogin')->name("admin_login");
    Route::get('login', 'admin\AdminLoginController@getLogin')->name("admin_login");
    Route::post('login', 'admin\AdminLoginController@postLogin')->name("check_admin_login");
	
	Route::group(['middleware' => 'admin_auth'], function() {
    	
    	Route::get('logout', 'admin\AdminLoginController@getLogout')->name("admin_logout");
        Route::get('dashboard', 'admin\AdminController@index')->name("admin_dashboard");

        /* Banner */
        Route::any('banners/data', 'admin\BannersController@data')->name("banners.data");
        Route::resource('banners', 'admin\BannersController');

        /* Product */
        Route::any('products/data', 'admin\ProductsController@data')->name("products.data");
        Route::resource('products', 'admin\ProductsController');

        /* Content */
        Route::any('contents/data', 'admin\ContentsController@data')->name("contents.data");
        Route::resource('contents', 'admin\ContentsController');

        /* Setting */
        Route::any('settings', 'admin\SettingsController@index')->name("settings");
        Route::any('settings/update', 'admin\SettingsController@update')->name("settings.update");
        Route::get('profile', 'admin\AdminController@editProfile')->name("admin_edit_profile");
        Route::post('profile', 'admin\AdminController@updateProfile')->name("admin_update_profile");
        Route::get('change-password', 'admin\AdminController@changePassword')->name("admin_change_password");
    	Route::post('change-password', 'admin\AdminController@postChangePassword')->name("admin_update_password");

	});
});

Route::get('/home', 'ClientController@clientpanel')->name("clientpanel");
Route::get('/detail', 'ClientController@detail')->name("detail");
Route::get('/contact', 'ClientController@contact')->name("contact");
Route::get('/contact_us', 'ClientController@add')->name("contact_us");
Route::get('/', function () {
    return view('welcome');
});
