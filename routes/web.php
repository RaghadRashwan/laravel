<?php

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

//Route::get('/', function () {
  //  return view('index');
//});


Route::get('/', [\App\Http\Controllers\HomeCntroller::class, 'index'])
    ->name( name: 'home');

    Route::get('Posts/{post}', [\App\Http\Controllers\PostController::class, 'show'])
    ->name( name: 'Posts.show');