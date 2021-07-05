<?php

use Illuminate\Support\Facades\Route;
use ITHilbert\UserAuth\Http\Controllers\PermissionController;
use ITHilbert\UserAuth\Http\Controllers\LoginController;
use ITHilbert\UserAuth\Http\Controllers\RoleController;
use ITHilbert\UserAuth\Http\Controllers\UserController;
use ITHilbert\UserAuth\Http\Controllers\PasswordController;


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

Route::middleware(['web'])
        ->group(function () {


	//Permission routes
	Route::middleware(['auth', 'hasPermission:permission_read'])
        ->prefix('admin/permissions')
        ->group(function () {

	    Route::any('/',             [PermissionController::class, 'index'])->name('permission');
	    Route::any('index',         [PermissionController::class, 'index'])->name('permission.index');
	    Route::get('create',        [PermissionController::class, 'create'])->name('permission.create')->middleware('hasPermission:permission_create');
	    Route::post('store',        [PermissionController::class, 'store'])->name('permission.store')->middleware('hasPermission:permission_create');
	    Route::get('edit/{id}',     [PermissionController::class, 'edit'])->name('permission.edit')->middleware('hasPermission:permission_edit');
	    Route::post('update/{id}',  [PermissionController::class, 'update'])->name('permission.update')->middleware('hasPermission:permission_edit');
	    Route::delete('delete/{id}',[PermissionController::class, 'delete'])->name('permission.delete')->middleware('hasPermission:permission_edit');
	});


	//role
	Route::middleware(['auth', 'hasPermission:role_read'])
	        ->prefix('admin/roles')
            ->group(function () {

	    Route::any('/',             [RoleController::class, 'index'])->name('role');
	    Route::any('index',         [RoleController::class, 'index'])->name('role.index');
	    Route::get('create',        [RoleController::class, 'create'])->name('role.create')->middleware('hasPermission:role_create');
	    Route::post('store',        [RoleController::class, 'store'])->name('role.store')->middleware('hasPermission:role_create');
	    Route::get('edit/{id}',     [RoleController::class, 'edit'])->name('role.edit')->middleware('hasPermission:role_edit');
	    Route::post('update/{id}',  [RoleController::class, 'update'])->name('role.update')->middleware('hasPermission:role_edit');
	    Route::delete('delete/{id}',[RoleController::class, 'delete'])->name('role.delete')->middleware('hasPermission:role_delete');
	});


	//User
    //'hasPermission:user_read'
    Route::middleware(['auth' ])
        ->prefix('admin/users')
        ->group(function () {

	    Route::any('/',             [UserController::class, 'index'])->name('user');
	    Route::any('index',         [UserController::class, 'index'])->name('user.index');
	    Route::get('create',        [UserController::class, 'create'])->name('user.create')->middleware('hasPermission:user_create');
	    Route::post('store',        [UserController::class, 'store'])->name('user.store')->middleware('hasPermission:user_create');
	    Route::get('edit/{id}',     [UserController::class, 'edit'])->name('user.edit')->middleware('hasPermission:user_edit');
	    Route::post('update/{id}',  [UserController::class, 'update'])->name('user.update')->middleware('hasPermission:user_edit');
	    Route::delete('delete/{id}',[UserController::class, 'delete'])->name('user.delete')->middleware('hasPermission:user_delete');
	});


	//Password und Logout
    Route::middleware(['auth'])
        ->group(function () {

	    //Password edit
	    Route::get('password/edit',    [PasswordController::class, 'edit'])->name('password.edit');
	    Route::post('password/update', [PasswordController::class, 'update'])->name('password.update');

	    //Logout
	    Route::any('logout', [LoginController::class, 'logout'])->name('logout');
	});

	//Login
	Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
	Route::post('login', [LoginController::class, 'login']);

    Route::any('no-permission', [PermissionController::class, 'noPermission'])->name('no-permission');

    //Passwort vergessen
    Route::any('password/tokensend',        [PasswordController::class, 'tokensend'])->name('password.tokensend');
    Route::any('password/forgotten',        [PasswordController::class, 'forgotten'])->name('password.forgotten');
    Route::post('password/sendtocken',      [PasswordController::class, 'sendtocken'])->name('password.sendtocken');
    Route::post('password/updatewithtoken', [PasswordController::class, 'updatewithtoken'])->name('password.updatewithtoken');
    Route::get('password/editwithtoken/{token}/{email}', [PasswordController::class, 'editwithtoken'])->name('password.editwithtoken');
});
