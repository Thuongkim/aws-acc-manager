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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/accounts/remove_aws_resource/{id}', [App\Http\Controllers\AccountController::class, 'removeAWSResource'])->name('accounts.removeAWSResource');
    Route::get('/accounts/remove_aws_resource_stream/{id}', [App\Http\Controllers\AccountController::class, 'removeAWSResourceStream'])->name('accounts.removeAWSResourceStream');

    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::patch('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::resource('accounts', App\Http\Controllers\AccountController::class);
    Route::get('/account/sync', [App\Http\Controllers\AccountController::class, 'sync'])->name('sync');
});
