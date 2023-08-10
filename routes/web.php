<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Mail\InformAdmin;
use Spatie\Permission\Contracts\Permission;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

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



Route::middleware(['auth'])->group(function () {
   // Route::get('posts/{post}',[\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('posts', \App\Http\Controllers\PostController::class);
    Route::post('/comments/{post}',
    [CommentController::class, 'store'])->name('comments.store');
});

Route::middleware(['auth','role:admin'])->group(function () {
Route::resource('roles', \App\Http\Controllers\RolesController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('users', UserController::class);

Route::post('users/{user}',
    [UserController::class, 'assignRoleAndPermission'])->name('users.assignRoleAndPermission');


});
        