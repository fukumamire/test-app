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
    $user = auth()->user();
    //  fill() メソッドは、モデルの属性を一度に設定するためのメソッドです。引数として与えられた配列のキーと値を使って、モデルのプロパティを更新
    $user->fill($request->validated());

    // メールアドレスが変更された場合、メール確認日時をリセット
    if ($user->isDirty('email')) {
      // メールアドレスが未確認の場合、確認画面にリダイレクト
      if (!$user->hasVerifiedEmail()) {
        return redirect()->route('auth.verify-email');  // 直接ビューに遷移
      }
      // 追記　メールアドレスを変更した時点で、すぐに認証用メールを送信するためのコードコード
      $user->sendEmailVerificationNotification();
      $user->email_verified_at = null;
    }

    // アバター画像の保存
    if ($request->hasFile('avatar')) {
      $oldAvatar = $user->avatar;

      // 古いアバターを削除（デフォルト画像を除く）
      if ($oldAvatar && $oldAvatar !== 'storage/avatar/user_default.jpg') {
        Log::debug('古いアバターのパス: ' . $oldAvatar);
        $oldAvatarPath = str_replace('storage/', 'public/', $oldAvatar);
        Log::debug('削除対象のアバターのパス: ' . $oldAvatarPath);
        // 古いアバターの存在確認と削除
        if (Storage::disk('public')->exists($oldAvatarPath)) {
          Storage::disk('public')->delete($oldAvatarPath);
          Log::debug('古いアバターを削除しました。');
        } else {
          Log::debug('古いアバターが見つかりませんでした。');
        }
      }

      //   if (Storage::disk('public')->exists(str_replace('public/', '', $oldAvatarPath))) {
      //     Storage::disk('public')->delete(str_replace('public/', '', $oldAvatarPath));
      //     Log::debug('古いアバターを削除しました。');
      //   } else {
      //     Log::debug('古いアバターが見つかりませんでした。');
      //   }
      // }
      // 新しいアバターを保存
      $name = $request->file('avatar')->getClientOriginalName();
      $avatar = date('Ymd_His') . '_' . $name;
      $path = $request->file('avatar')->storeAs('avatar', $avatar, 'public');
      $user->avatar = 'storage/' . $path;

      Log::debug('新しいアバターを保存しました: ' . $path);
    }

    // 変更を保存
    $user->save();

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
