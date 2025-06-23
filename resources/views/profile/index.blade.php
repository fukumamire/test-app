<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
      ユーザー一覧
    </h2>
    {{-- セッションに保存されたメッセージを表示するためのコンポーネント↓ --}}
    <x-message :message="session('message')" />
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="my-6">
      <table class="text-left w-full border-collapse mt-8">
        <tr class="bg-green-600">
          <th class="p-3 text-left text-white">＃</th>
          <th class="p-3 text-left text-white">名前</th>
          <th class="p-3 text-left text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 mr-2">
              <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
              <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
            </svg>
            Email
          </th>
          <th class="p-3 text-left text-white">アバター</th>
          <th class="p-3 text-left text-white">編集</th>
          <th class="p-3 text-left text-white">削除</th>
        </tr>
        @foreach($users as $user)
        <tr class="bg-white">
          <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->id}}</td>
          <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->name}}</td>
          <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->email}}</td>
          <td class="border-gray-light border hover:bg-gray-100 p-3">
            <div class="rounded-full w-12 h-12 overflow-hidden"> <!-- サイズを指定 -->
            @php
                // アバターのパスを正しく設定
                if (isset($user->avatar) && str_starts_with($user->avatar, 'storage/avatar/')) {
                    $avatarPath = substr($user->avatar, strlen('storage/avatar/'));
                } else {
                    $avatarPath = $user->avatar ? 'avatar/' . $user->avatar : 'avatar/user_default.jpg';
                }
              @endphp

              @if (file_exists(public_path('storage/avatar/' . $avatarPath)))
                <img src="{{ asset('storage/avatar/' . $avatarPath) }}" alt="avatar" class="rounded-full w-full h-full">
              @else
                <img src="{{ asset('storage/avatar/user_default.jpg') }}" alt="avatar" class="rounded-full w-full h-full">
              @endif
            </div>
          </td>
          <td class="border-gray-light border hover:bg-gray-100 p-3">
            <a href="{{route('profile.adedit', $user)}}"><x-primary-button class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 text-white font-bold py-2 px-4 rounded">編集</x-primary-button></a>
          </td>
          
          {{-- 削除用の列を追加 --}}
          <td class="border-gray-light border hover:bg-gray-100 p-3">
            <form method="post" action="{{route('profile.addestroy', $user)}}">
              @csrf
              @method('delete')
              <x-primary-button class="bg-red-700" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
            </form>
          </td>
        </tr>  
        @endforeach
      </table>
    </div>
  </div>
</x-app-layout>