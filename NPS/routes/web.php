<?php

use App\Http\Controllers\UserController;
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
Route::get('/users/create', [UserController::class, 'form'])->name('users.create');;
Route::get('/users/{user}/delete', [UserController::class, 'delete']);
Route::post('/users/create', [UserController::class, 'create']);
Route::get('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
