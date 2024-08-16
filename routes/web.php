<?php

use App\Http\Controllers\AuthController;
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
})->name('home');


Route::post('/registration',[\App\Http\Controllers\AuthController::class,'register'])->name('register.post');

Route::get('/registration',[\App\Http\Controllers\AuthController::class,'registration'])->name('register');

Route::get('/login',[\App\Http\Controllers\AuthController::class,'loginView'])->name('login');

Route::post('/login',[\App\Http\Controllers\AuthController::class,'login'])->name('login.post')->middleware('guest');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::resource('blogposts',\App\Http\Controllers\BlogPostController::class);

Route::get('/unauthorized', function () {
    return view('UnAuthorized.401');
})->name('401');


