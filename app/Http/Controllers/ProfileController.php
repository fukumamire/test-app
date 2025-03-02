<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
  public function index()
  {
    $users = User::all();
    return view('profile.index', compact('users'));
  }
  /**
   * Display the user's profile form.
   */
  public function edit(Request $request): View
  {
    return view('profile.edit', [
      'user' => $request->user(),
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse
  {
    //  fill() メソッドは、モデルの属性を一度に設定するためのメソッドです。引数として与えられた配列のキーと値を使って、モデルのプロパティを更新
    $request->user()->fill($request->validated());

    // メールアドレスが変更された場合、メール確認日時をリセット
    if ($request->user()->isDirty('email')) {
      // 追記　メールアドレスを変更した時点で、すぐに認証用メールを送信するためのコードコード
      $request->user()->sendEmailVerificationNotification();
      $request->user()->email_verified_at = null;
    }

    // アバター画像の保存
    if ($request->hasFile('avatar')) {
      $user = User::find(auth()->user()->id);
      // 古いアバターを削除（デフォルト画像を除く）
      if ($user->avatar && $user->avatar !== 'storage/avatar/user_default.jpg') {
        $oldAvatarPath = str_replace('storage/', 'public/', $user->avatar);
        if (Storage::exists($oldAvatarPath)) {
          Storage::delete($oldAvatarPath);
        }
      }
      // 新しいアバターを保存
      $name = $request->file('avatar')->getClientOriginalName();
      $avatar = date('Ymd_His') . '_' . $name;
      $path = $request->file('avatar')->storeAs('avatar', $avatar, 'public');
      $request->user()->avatar = 'storage/' . $path;

      Log::debug('新しいアバターを保存しました: ' . $path);
    }

    // 変更を保存
    $request->user()->save();

    return Redirect::route('profile.edit')->with('status', 'プロフィールが更新されました。');
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }
}
