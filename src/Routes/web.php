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


//Permission routes
Route::group([ 
    'prefix' => 'admin/permission'], function(){
    
    Route::any('/',             'PermissionController@index')->name('permission');
    Route::any('index',         'PermissionController@index')->name('permission.index');
    Route::get('create',        'PermissionController@create')->name('permission.create');
    Route::post('store',        'PermissionController@store')->name('permission.store');
    Route::get('edit/{id}',     'PermissionController@edit')->name('permission.edit');
    Route::post('update/{id}',  'PermissionController@update')->name('permission.update');
    Route::delete('delete/{id}','PermissionController@delete')->name('permission.delete');
    //Route::get('show/{id}',     'PermissionController@show')->name('permission.show');

});


//role
Route::group([ 
    'prefix' => 'admin/role',
    'middleware' => ['web', 'auth']], function(){
    
    Route::any('/',             'RoleController@index')->name('role');
    Route::any('index',         'RoleController@index')->name('role.index');
    Route::get('create',        'RoleController@create')->name('role.create');
    Route::post('store',        'RoleController@store')->name('role.store');
    Route::get('edit/{id}',     'RoleController@edit')->name('role.edit');
    Route::post('update/{id}',  'RoleController@update')->name('role.update');
    Route::delete('delete/{id}','RoleController@delete')->name('role.delete');
    //Route::get('show/{id}',     'RoleController@show')->name('role.show');
});


//User
Route::group([ 
    'prefix' => 'admin/user',
    'middleware' => ['web', 'auth']], function(){
    
    Route::any('/',             'UserController@index')->name('user');
    Route::any('index',         'UserController@index')->name('user.index');
    Route::get('create',        'UserController@create')->name('user.create');
    Route::post('store',        'UserController@store')->name('user.store');
    Route::get('edit/{id}',     'UserController@edit')->name('user.edit');
    Route::post('update/{id}',  'UserController@update')->name('user.update');
    Route::delete('delete/{id}','UserController@delete')->name('user.delete');
    //Route::get('show/{id}',     'UserController@show')->name('user.show');
});


//Password
Route::group([ 
    'middleware' => ['web', 'auth']], function(){
    
    //Password edit
    Route::get('password/edit',    'PasswordController@edit')->name('password.edit');
    Route::post('password/update', 'PasswordController@update')->name('password.update');

    //Logout
    Route::any('logout', 'LoginController@logout')->name('logout');
});


//Test
/* Route::group([ 
    'prefix' => 'test'], function(){

    Route::get('role', 'TestController@role');
    Route::get('user', 'TestController@user');
    //Route::get('users', ['uses'=>'UserController@index', 'as'=>'users.index']);
}); */
   

//Login
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');

Route::any('no-permission', 'PermissionController@noPermission')->name('logout');