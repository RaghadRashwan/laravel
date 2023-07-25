<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Spatie\Permission\Contracts\Permission;

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

Route::get('/dashboard', function () {
    return view('dashboard');
  })->middleware(['auth'])->name('dashboard');
//Route::get('/dashboard', [\App\Http\Controllers\CategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('categories', \App\Http\Controllers\CategoryController::class);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::resource('posts', \App\Http\Controllers\PostController::class);
//Route::middleware('canEditPost')->resource('posts', \App\Http\Controllers\PostController::class);
//Route::middleware('permission:canEditPost')->group(function () {

   // Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
//});

Route::get('posts/{post}',
    [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::resource('roles', \App\Http\Controllers\RolesController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('users', UserController::class);
//Route::get('users/{users}/assign-role',
  //  [UserController::class, 'assignRole'])->name('users.assignRole');
//Route::get('users/{users}/give-permission',
   // [UserController::class, 'givePermission'])->name('users.givePermission');
Route::post('users/{user}',
    [UserController::class, 'assignRoleAndPermission'])->name('users.assignRoleAndPermission');


            
    