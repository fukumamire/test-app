<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;

// topページ　誰でも見ることができる（会員でなくても　ログインしていなくても）
Route::get('/', function () {
  return view('welcome');
})->name('top');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// お問い合わせ　誰でも見ることができる（会員でなくても　ログインしていなくても）
Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

// ログイン後の通常のユーザー画面
Route::middleware(['verified'])->group(function () {
  // ログイン後URLは/dashboardのまま、投稿一覧画面を表示
  Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

  //自分の投稿のみ表示
  Route::get('post/mypost', [PostController::class, 'mypost'])->name('post.mypost');
  // コメント投稿のみ表示
  Route::get('post/mycomment', [PostController::class, 'mycomment'])->name('post.mycomment');
  // いいね機能
  Route::post('/post/{post}/like', [PostController::class, 'like'])->name('post.like');

  // 投稿に関するルート
  Route::resource(
    'post',
    PostController::class
  );

  //投稿コメント　保存
  Route::post('post/comment/store', [CommentController::class, 'store'])->name('comment.store');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  //admin権限がある場合
  Route::middleware(['can:admin'])->group(
    function () {
      // ユーザー一覧
      Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
    }
  );
});

require __DIR__ . '/auth.php';
