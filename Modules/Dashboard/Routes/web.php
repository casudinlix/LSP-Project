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

Route::group(['middleware' => ['auth','checkstatus'],'prefix' => 'dashboard'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
});
Route::group(['middleware' => ['auth','checkstatus','role:Super Admin'],'prefix' => 'administrator'], function () {
Route::resource('user', 'Admin\UserController');
Route::resource('permission', 'Admin\PermissionController');
Route::resource('role', 'Admin\RoleController');
Route::get('role/detail/{name}', 'Admin\RoleController@rolePermission')->name('rolePermission');
Route::post('role/permission/{name}', 'Admin\RoleController@addPermission')->name('postrolePermission');
Route::get('role/user/{userid}/detail', 'Admin\UserController@roles')->name('edit.role.user');
Route::post('role/user/setRole/{id}', 'Admin\UserController@setRole')->name('post.role.user');
Route::post('api/user', 'Admin\UserController@list')->name('api.user');
Route::post('api/permission', 'Admin\PermissionController@list')->name('api.permission');
Route::post('api/role', 'Admin\RoleController@list')->name('api.role');

});
