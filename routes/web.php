<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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



Auth::routes();
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/posts', [AdminController::class, 'index'])->name('admin.posts.index');
    Route::get('/admin/posts/create', [AdminController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/posts', [AdminController::class, 'store'])->name('admin.posts.store');
    Route::get('/admin/posts/{post}/edit', [AdminController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [AdminController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [AdminController::class, 'destroy'])->name('admin.posts.destroy');
});

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post-detail/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::post('/comments/{comment}/replies', [CommentController::class, 'reply'])->name('comments.reply')->middleware('auth');