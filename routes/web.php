<?php

use Illuminate\Support\Facades\Route;

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

/*
======================== AUTH ========================
*/

Auth::routes();

Route::get('/register','App\Http\Controllers\RegController@showRegForm');
Route::post('/registration','App\Http\Controllers\RegController@register');

/*
======================== FRONT ========================
*/

Route::get('/','App\Http\Controllers\HomeController@index');
/*
======================== ADMIN ========================
*/

Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/home','App\Http\Controllers\AdminController@index');

Route::get('/admin/personal','App\Http\Controllers\AdminController@personal');

Route::post('/admin/personal/select_time','App\Http\Controllers\AdminController@select_time')->name('select_time');
Route::post('/admin/personal/update_car_availability','App\Http\Controllers\AdminController@update_car_availability')->name('update_car_availability');

//users

Route::get('/admin/users/list','App\Http\Controllers\AdminController@users_list');
Route::get('/admin/user/new','App\Http\Controllers\AdminController@user_new');
Route::post('/admin/user/save','App\Http\Controllers\AdminController@user_save');
Route::get('/admin/user/edit/{id}','App\Http\Controllers\AdminController@user_edit');
Route::post('/admin/user/update','App\Http\Controllers\AdminController@user_update');
Route::post('/admin/user/remove','App\Http\Controllers\AdminController@user_remove');


Route::get('/admin/category','App\Http\Controllers\AdminController@category_list');
Route::get('/admin/category/new','App\Http\Controllers\AdminController@category_new');
Route::post('/admin/category/save','App\Http\Controllers\AdminController@category_save');
Route::get('/admin/category/edit/{id}','App\Http\Controllers\AdminController@category_edit');
Route::post('/admin/category/update','App\Http\Controllers\AdminController@category_update');
Route::any('/admin/category/remove/{id}','App\Http\Controllers\AdminController@category_remove');

Route::get('/admin/cars_for_adm','App\Http\Controllers\AdminController@cars_for_adm_list');
Route::get('/admin/cars_for_adm/new','App\Http\Controllers\AdminController@cars_for_adm_new');
Route::post('/admin/cars_for_adm/save','App\Http\Controllers\AdminController@cars_for_adm_save');
Route::get('/admin/cars_for_adm/edit/{id}','App\Http\Controllers\AdminController@cars_for_adm_edit');
Route::post('/admin/cars_for_adm/update','App\Http\Controllers\AdminController@cars_for_adm_update');
Route::any('/admin/cars_for_adm/remove/{id}','App\Http\Controllers\AdminController@cars_for_adm_remove');

Route::get('/admin/drivers','App\Http\Controllers\AdminController@drivers_list');
Route::get('/admin/drivers/new','App\Http\Controllers\AdminController@drivers_new');
Route::post('/admin/drivers/save','App\Http\Controllers\AdminController@drivers_save');
Route::get('/admin/drivers/edit/{id}','App\Http\Controllers\AdminController@drivers_edit');
Route::post('/admin/drivers/update','App\Http\Controllers\AdminController@drivers_update');
Route::any('/admin/drivers/remove/{id}','App\Http\Controllers\AdminController@drivers_remove');

