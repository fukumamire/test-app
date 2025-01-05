{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('layouts.app')

@section('title', '新規登録')

@section('css')
<link href="{{ asset('css/register.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="register-container">
  <h1>新規登録</h1>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- 名前 -->
    <div class="form-group">
      <label for="name">名前</label>
      <input type="text" id="name" name="name" required autofocus autocomplete="name">
      <span class="error-message">@error('name') {{ $message }} @enderror</span>
    </div>

    <!-- メールアドレス -->
    <div class="form-group">
      <label for="email">メールアドレス</label>
      <input type="email" id="email" name="email" required autocomplete="username">
      <span class="error-message">@error('email') {{ $message }} @enderror</span>
    </div>

    <!-- パスワード -->
    <div class="form-group">
      <label for="password">パスワード</label>
      <input type="password" id="password" name="password" required autocomplete="new-password">
      <span class="error-message">@error('password') {{ $message }} @enderror</span>
    </div>

    <!-- パスワード確認 -->
    <div class="form-group">
      <label for="password_confirmation">パスワード確認</label>
      <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
      <span class="error-message">@error('password_confirmation') {{ $message }} @enderror</span>
    </div>

    <div class="form-actions">
      <a href="{{ route('login') }}">すでに登録済みですか？</a>
      <button type="submit">登録</button>
    </div>
  </form>
</div>
@endsection

