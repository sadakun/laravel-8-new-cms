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
    
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::patch('/admin/posts/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    
    Route::delete('/admin/posts/{post}/delete', [App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');
});
#example using "can" policies on route middleware
// Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->middleware('can:view,post')->name('post.edit');