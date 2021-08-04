<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;


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
Route::redirect('/','admin');

Route::middleware('auth')->prefix('blog')->group(function () {
    //posts
    Route::get('/posts' , [HomeController::class,'index'])->name('blog');
    Route::get('/posts/{post}',[HomeController::class,'show'])->name('home.posts');
    Route::get('/categories/{category}/posts',[HomeController::class,'category_posts'])->name('category_posts');

    //users
    Route::get('/users/{user}/profile' , [UserController::class,'show'])->name('users.show');
    Route::get('/users/{user}/posts' , [HomeController::class,'user_posts'])->name('user_posts');
});
// Route::get('/',[HomeController::class,'root'])->name('home');

require __DIR__.'/auth.php';

Route::middleware('auth')->prefix('admin')->group(function () {
    //dashboard
    Route::get('/' , [AdminController::class,'index'])->middleware('auth')->name('dashboard');

    //posts
    Route::resource('/posts',PostController::class);

    //users
    Route::resource('/users',UserController::class)->except(['show','store','create']);
    Route::get('/users/{role}/role',[UserController::class,'index_by_role'])->name('users.index_by_role');
    Route::get("/users/{user}/editPassword" , [UserController::class,'edit_password'])->name('users.edit_password');
    Route::patch('/users/{user}/updatePassword',[UserController::class,'update_password'])->name('users.update_password');
    Route::get('/users/{user}/editRole' , [UserController::class,'edit_role'])->name('users.edit_role');
    Route::put('/users/{user}/updateRole' , [UserController::class,'update_role'])->name('users.update_role');

    //roles
    Route::resource('/roles',RoleController::class)->except(['show']);
    Route::put('/roles/{role}/add_permission',[RoleController::class,'add_permission'])->name('roles.add_permission');
    Route::put('/roles/{role}/remove_permission',[RoleController::class,'remove_permission'])->name('roles.remove_permission');

    //Categories
    Route::resource('/categories',CategoryController::class)->except(['show']);
    Route::get('/categories/{category}/posts',[CategoryController::class,'posts'])->name('categories.posts');


});
