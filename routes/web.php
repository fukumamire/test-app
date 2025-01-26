<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;



Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// ログイン後URLは/dashboardのまま、投稿一覧画面を表示
Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

//自分の投稿のみ表示
Route::get('post/mypost', [PostController::class, 'mypost'])->name('post.mypost');
// コメント投稿のみ表示
Route::get('post/mycomment', [PostController::class, 'mycomment'])->name('post.mycomment');
// いいね機能
Route::post('/post/{post}/like', [PostController::class, 'like'])->name('post.like');

// 投稿に関するルート
Route::resource('post', PostController::class);

//投稿コメント　保存
Route::post('post/comment/store', [CommentController::class, 'store'])->name('comment.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
