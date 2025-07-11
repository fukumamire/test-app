<x-guest-layout>
  <div class="h-screen pb-14 bg-right bg-cover">
    <div class="container mx-auto pt-10 md:pt-18 px-6 lg:px-12 max-w-full flex flex-wrap flex-col md:flex-row items-center bg-yellow-50">
      <!-- 左側 -->
      <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
        <h1 class="my-4 text-3xl md:text-7xl text-green-800 font-bold font-mono leading-tight text-center md:text-left slide-in-bottom-h1">動物の魅力を伝えるペット憩いの場</h1>
        <p class="leading-normal text-base md:text-5xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
          仕事や勉強の合間に、憩いの場としてペットの魅力を発信しよう～　もちろん動物好きの方もウェルカム♪
        </p>
        <p class="text-blue-400 font-bold md:text-4xl pb-8 lg:pb-6 text-center md:text-left fade-in">
          会員募集中。お気軽にひょっこりきてください。
        </p>
        <div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in ">
          {{-- ボタン設定 --}}
          <a href="{{route('contact.create')}}"><x-primary-button class="btnsetg">お問い合わせ</x-primary-button></a>
          <a href="{{route('register')}}"><x-primary-button class="btnsetr">ご登録はこちら</x-primary-button></a>
        </div>
      </div>
      <!-- 右側 -->
      <div class="w-full xl:w-2/5 py-6 overflow-y-hidden">
        <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom rounded-lg shadow-xl" src="{{ asset('logo/inuneko2.png') }}">
      </div>
    </div>
    <div class="container mx-auto pt-10 md:pt-18 px-6 lg:px-12 max-w-full flex flex-wrap flex-col md:flex-row items-center">
      <div class="w-full text-3xl text-center md:text-left fade-in border-2 p-4 text-red-400 leading-8 mb-8">
        <p>ここは色々いれてください。</p>
      </div>
      <!-- フッタ -->
      <div class="w-full pt-10 pb-6 text-sm md:text-left fade-in">
        <p class="text-gray-500 text-center">@2025 Laravelのサンプル</p>
      </div>
    </div>
  </div>
</x-guest-layout>
