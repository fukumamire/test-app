<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(): View
  {
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
      'avatar' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // userテーブルのデータ
    $attr = [
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ];

    //avatarの保存
    if ($request->hasFile('avatar')) {
      $name = $request->file('avatar')->getClientOriginalName();
      $avatar = date('Ymd_His') . '_' . $name;
      $path = $request->file('avatar')->storeAs('avatar', $avatar, 'public'); // 'public' ディスクを指定
      $attr['avatar'] = 'storage/avatar/' . $avatar; // パスを保存

      // 保存されたフルパスを確認するためのログ
      Log::debug('Avatar saved at: ' . $path);
    }

    $user = User::create($attr);

    event(new Registered($user));
    // 役割付与
    $user->roles()->attach(2);

    Auth::login($user);

    if (!$user->hasVerifiedEmail()) {
      return redirect()->route('verification.notice');
    }

    return redirect(route('dashboard', absolute: false));
  }
}
