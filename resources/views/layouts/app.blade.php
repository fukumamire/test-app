<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- 独自CSSファイルを読み込む -->
</head>

<body>
  <div class="container">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
    <header class="header">
      <div class="header-content">
        {{ $header }}
      </div>
    </header>
    @endisset

    <!-- Page Content -->
    <main class="main-content">
      @yield('content') <!-- 子ビューで定義されたコンテンツを挿入 -->
    </main>
  </div>
</body>

</html>

