{{-- <x-guest-layout>
  <div class="login-container">
    <h1>新規登録</h1>
    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div class="form-group">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>

      <!-- Email Address -->
      <div class="form-group">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <!-- Password -->
      <div class="form-group">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="block mt-1" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <!-- Confirm Password -->
      <div class="form-group">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" class="block mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      </div>

      <button type="submit" class="button">
        {{ __('Register') }}
      </button>

      <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
          {{ __('Already registered?') }}
        </a>
      </div>
    </form>
  </div>
</x-guest-layout> --}}
<x-guest-layout>
  {{-- ★追加部分 --}}
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <a href="/">
      <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
    </a>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      {{-- 追加ここまで --}}
      <div class="register-container">
        <h1 class="title">新規登録</h1>
        <form method="POST" action="{{ route('register') }}" class="form-wrapper">
          @csrf

          <!-- Name -->
          <div class="form-group">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" id="name" name="name" :value="old('name')" required autofocus autocomplete="name" class="form-control">
            @error('name')
            <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <!-- Email Address -->
          <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" id="email" name="email" :value="old('email')" required autocomplete="username" class="form-control">
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input type="password" id="password" name="password" required autocomplete="new-password" class="form-control">
            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <!-- Confirm Password -->
          <div class="form-group">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" class="form-control">
            @error('password_confirmation')
            <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="btn-submit">{{ __('Register') }}</button>

          <div class="link-container">
            <a href="{{ route('login') }}" class="link">{{ __('Already registered?') }}</a>
          </div>
        </form>
        {{-- ★</div>を２つ追加 --}}
      </div>
    </div>
  </div>
</x-guest-layout>