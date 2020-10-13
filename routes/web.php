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

    #CRUD user
    
    Route::put('/admin/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
    
    
});
#example using "can" policies on route middleware
// Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->middleware('can:view,post')->name('post.edit');

Route::middleware('role:ADMIN', 'auth')->group(function()
{
    Route::delete('/admin/users/{user}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');


    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::put('/admin/users/{user}/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('/admin/users/{user}/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');

    #CRUD roles
    Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::post('/admin/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::delete('/admin/roles/{role}/delete', [App\Http\Controllers\RoleController::class, 'delete'])->name('roles.delete');
    Route::get('/admin/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/admin/roles/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::put('/admin/roles/{role}/attach', [App\Http\Controllers\RoleController::class, 'attach_permission'])->name('role.permission.attach');
    Route::put('/admin/roles/{role}/detach', [App\Http\Controllers\RoleController::class, 'detach_permission'])->name('role.permission.detach');

    #CRUD permissions
    Route::get('/admin/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/admin/permissions', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
    
    Route::get('/admin/permissions/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
    Route::delete('/admin/permissions/{permission}/delete', [App\Http\Controllers\PermissionController::class, 'delete'])->name('permissions.delete');
    
    Route::put('/admin/permissions/{permission}/update', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');

});

Route::middleware(['can:view,user'])->group(function()
{
    Route::get('/admin/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
});