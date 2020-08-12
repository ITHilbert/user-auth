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
Route::group(['namespace' => 'ITHilbert\UserAuth\Http\Controllers',
              'middleware' => ['web']], function () {

	//Permission routes
	Route::group([
	    'prefix' => 'admin/permissions',
	    'middleware' => ['auth', 'hasPermission:permission_read'] ], function(){

	    Route::any('/',             'PermissionController@index')->name('permission');
	    Route::any('index',         'PermissionController@index')->name('permission.index');
	    Route::get('create',        'PermissionController@create')->name('permission.create')->middleware('hasPermission:permission_create');
	    Route::post('store',        'PermissionController@store')->name('permission.store')->middleware('hasPermission:permission_create');
	    Route::get('edit/{id}',     'PermissionController@edit')->name('permission.edit')->middleware('hasPermission:permission_edit');
	    Route::post('update/{id}',  'PermissionController@update')->name('permission.update')->middleware('hasPermission:permission_edit');
	    Route::delete('delete/{id}','PermissionController@delete')->name('permission.delete')->middleware('hasPermission:permission_edit');
	    //Route::get('show/{id}',     'PermissionController@show')->name('permission.show');

	});


	//role
	Route::group([
	    'prefix' => 'admin/roles',
	    'middleware' => ['auth', 'hasPermission:role_read'] ], function(){

	    Route::any('/',             'RoleController@index')->name('role');
	    Route::any('index',         'RoleController@index')->name('role.index');
	    Route::get('create',        'RoleController@create')->name('role.create')->middleware('hasPermission:role_create');
	    Route::post('store',        'RoleController@store')->name('role.store')->middleware('hasPermission:role_create');
	    Route::get('edit/{id}',     'RoleController@edit')->name('role.edit')->middleware('hasPermission:role_edit');
	    Route::post('update/{id}',  'RoleController@update')->name('role.update')->middleware('hasPermission:role_edit');
	    Route::delete('delete/{id}','RoleController@delete')->name('role.delete')->middleware('hasPermission:role_delete');
	    //Route::get('show/{id}',     'RoleController@show')->name('role.show');
	});


	//User
	Route::group([
	    'prefix' => 'admin/users',
	    'middleware' => ['auth', 'hasPermission:user_read'] ], function(){

	    Route::any('/',             'UserController@index')->name('user');
	    Route::any('index',         'UserController@index')->name('user.index');
	    Route::get('create',        'UserController@create')->name('user.create')->middleware('hasPermission:user_create');
	    Route::post('store',        'UserController@store')->name('user.store')->middleware('hasPermission:user_create');
	    Route::get('edit/{id}',     'UserController@edit')->name('user.edit')->middleware('hasPermission:user_edit');
	    Route::post('update/{id}',  'UserController@update')->name('user.update')->middleware('hasPermission:user_edit');
	    Route::delete('delete/{id}','UserController@delete')->name('user.delete')->middleware('hasPermission:user_delete');
	    //Route::get('show/{id}',     'UserController@show')->name('user.show')->middleware('hasPermission:user_read');;
	});


	//Password
	Route::group([
	    'middleware' => ['auth']], function(){

	    //Password edit
	    Route::get('password/edit',    'PasswordController@edit')->name('password.edit');
	    Route::post('password/update', 'PasswordController@update')->name('password.update');

	    //Logout
	    Route::any('logout', 'LoginController@logout')->name('logout');
	});

	//Login
	Route::get('login', 'LoginController@showLoginForm')->name('login');
	Route::post('login', 'LoginController@login');

	Route::any('no-permission', 'PermissionController@noPermission')->name('no-permission');

});
