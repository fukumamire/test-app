<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $posts = Post::orderBy('created_at', 'desc')->get();
    $user = auth()->user();
    return view('post.index', compact('posts', 'user'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('post.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $inputs = $request->validate([
      'title' => 'required|max:255',
      'body' => 'required|max:1000',
      'image' => 'image|max:1024'
    ]);

    //新しいPostインスタンスを作成する
    $post = new Post();
    $post->title = $request->title;
    $post->body = $request->body;
    $post->user_id = auth()->user()->id;

    if (request('image')) {
      $name = request()->file('image')->getClientOriginalName();
      // $originalは元のファイル名として定義
      $original = $name;
      // 日時追加
      $name = date('Ymd_His') . '_' . $original;
      request()->file('image')->move('storage/images', $name);
      $post->image = $name;
    }
    $post->save();
    return redirect()->route('post.create')->with('message', '投稿を作成しました');
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post)
  {
    // 個別表示ページの表示
    return view('post.show', compact('post'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Post $post)
  {
    return view('post.edit', compact('post'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Post $post)
  {
    $inputs = $request->validate([
      'title' => 'required|max:255',
      'body' => 'required|max:1000',
      'image' => 'image|max:1024'
    ]);

    $post->title = $inputs['title'];
    $post->body = $inputs['body'];

    if (request('image')) {
      $original = request()->file('image')->getClientOriginalName();
      $name = date('Ymd_His') . '_' . $original;
      $file = request()->file('image')->move('storage/images', $name);
      $post->image = $name;
    }

    $post->save();

    return redirect()->route('post.show', $post)->with('message', '投稿を更新しました');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post)
  {
    $post->comments()->delete(); //投稿削除の時にコメントも削除
    $post->delete();
    return redirect()->route('post.index')->with('message', '投稿を削除しました');
  }
  // 自分用の投稿一覧
  public function mypost()
  {
    //現在ログインしているユーザーID取得
    $user = auth()->user()->id;
    $posts = Post::where('user_id', $user)->orderBy('created_at', 'desc')->get();
    return view('post.mypost', compact('posts'));
  }

  public function like(Post $post)
  {
    $user = auth()->user(); // 認証されたユーザーを取得
    $isLiked = $user->favorites()->where('post_id', $post->id)->exists(); // いいねが既に存在するかチェック

    if ($isLiked) {
      $user->favorites()->detach($post); // いいねがあれば削除
    } else {
      $user->favorites()->attach($post); // いいねがなければ追加
    }

    return back();
  }
}
