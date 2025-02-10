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
          {{-- <th class="p-3 text-left text-white">Email</th> --}}
          <th class="p-3 text-left text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 mr-2">
              <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
              <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
            </svg>
            Email
          </th>
        </tr>
        @foreach($users as $user)
        <tr class="bg-white">
          <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->id}}</td>
          <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->name}}</td>
          <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->email}}</td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</x-app-layout>