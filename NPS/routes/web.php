<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//route users
Route::get('/users', [UserController::class, 'index']);
Route::group(['middleware' => 'auth'], function () {
    Route::get('/users/create', [UserController::class, 'form'])->name('users.create');;
    Route::get('/users/{user}/delete', [UserController::class, 'delete']);
    Route::post('/users/create', [UserController::class, 'create']);
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}/edit', [UserController::class, 'update']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
