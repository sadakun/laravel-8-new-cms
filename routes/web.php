<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
#Blog page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
#Post page
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');

#ADMIN
Route::middleware('auth')->group(function()
{
    #Dasboard
    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');

    #CRUD post
    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/admin/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/admin/posts', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
});
