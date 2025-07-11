<section>
  <header>
    <h2 class="text-lg font-medium text-gray-900">
      {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
      {{ __("Update your account's profile information and email address.") }}
    </p>
  </header>

  @if(!isset($admin))
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
      @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
  @else
  {{-- 管理ユーザー用のアップデート--}}
    <form method="post" action="{{ route('profile.adupdate', $user) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
  @endif
    
    @csrf
    @method('patch')

    <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
      <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
      <x-input-error class="mt-2" :messages="$errors->get('email')" />

      @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
      <div>
        <p class="text-sm mt-2 text-gray-800">
          {{ __('Your email address is unverified.') }}

          <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Click here to re-send the verification email.') }}
          </button>
        </p>

        @if (session('status') === 'verification-link-sent')
        <p class="mt-2 font-medium text-sm text-green-600">
          {{ __('A new verification link has been sent to your email address.') }}
        </p>
        @endif
      </div>
      @endif
    </div>
    {{-- アバター更新用に追加 --}}
    <div>
      <x-input-label for="avatar" :value="__('プロフィール画像（任意・1MBまで）')" />
      @php
      // アバターのパスを確認して不要な部分を省く
      $avatarPath = $user->avatar ? (str_starts_with($user->avatar, 'storage/avatar/')
      ? substr($user->avatar, strlen('storage/'))
      : $user->avatar)
      : 'avatar/user_default.jpg';
      @endphp

      <div class="rounded-full w-36">
        @if (file_exists(public_path('storage/' . $avatarPath)))
        <img src="{{ asset('storage/' . $avatarPath) }}" alt="avatar" class="avatar">
        @else
        <img src="{{ asset('storage/avatar/user_default.jpg') }}" alt="avatar" class="avatar">
        @endif
      </div>

      <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar')" />
      <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
    </div>
    {{-- アバター更新用に追加ここまで --}}

    @if(isset($admin))
      <input type="hidden" value="{{ $user->id }}" name ="user">
    @endif
    <div class="flex items-center gap-4">
      <x-primary-button>{{ __('Save') }}</x-primary-button>

      @if (session('status') === 'profile-updated')
      <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
      @endif
    </div>
  </form>
</section>