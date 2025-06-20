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
use Illuminate\Validation\Rule;

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

    // 「avatar」フィールドを除外してユーザー情報を更新
    $user->fill($request->except('avatar'));

    // メールアドレスが変更された場合の処理
    if ($user->isDirty('email')) {
      if (!$user->hasVerifiedEmail()) {
        return redirect()->route('auth.verify-email');
      }
      $user->sendEmailVerificationNotification();
      $user->email_verified_at = null;
    }

    // アバター画像の保存と古いアバターの削除
    if ($request->hasFile('avatar')) {
      // 古いアバターのパスを、アップロード前の元の値で取得
      $oldAvatar = $user->getOriginal('avatar');

      // 古いアバターが登録されていて、かつデフォルト画像でない場合のみ削除
      if ($oldAvatar && $oldAvatar !== 'storage/avatar/user_default.jpg') {
        // 「storage/」を除いて、publicディスク上のパス（例："avatar/xxx.png"）に変換
        $oldAvatarPath = str_replace('storage/', '', $oldAvatar);
        Log::debug('削除予定のアバターのパス: ' . $oldAvatarPath);

        if (Storage::disk('public')->exists($oldAvatarPath)) {
          Storage::disk('public')->delete($oldAvatarPath);
          Log::debug('古いアバターを削除しました。');
        } else {
          Log::debug('古いアバターが見つかりませんでした: ' . $oldAvatarPath);
        }
      }

      // 新しいアバターを保存
      $name = $request->file('avatar')->getClientOriginalName();
      $avatar = date('Ymd_His') . '_' . $name;
      // 保存先は "storage/app/public/avatar/xxx.png" になる
      $path = $request->file('avatar')->storeAs('avatar', $avatar, 'public');
      // ブラウザからは "storage/avatar/xxx.png" でアクセス可能
      $user->avatar = 'storage/avatar/' . $avatar;

      Log::debug('新しいアバターを保存しました: ' . $user->avatar);
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
  // 管理者用のユーザーアカウント表示用のコード
  public function adedit(User $user)
  {
    $admin = true;

    return view('profile.edit', [
      'user' => $user,
      'admin' => $admin,
    ]);
  }
  //管理者がアカウント更新するときのコード
  public function adupdate(User $user, Request $request): RedirectResponse
  {
    $inputs = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => [
        'required',
        'string',
        'lowercase',
        'email',
        'max:255', Rule::unique(User::class)->ignore($user)],
      'avatar' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:1024']
    ]);

    
  
}
