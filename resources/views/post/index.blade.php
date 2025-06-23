<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
      投稿の一覧
    </h2>

    <x-message :message="session('message')" />

  </x-slot>

  {{-- 投稿一覧表示用のコード --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-lg sm:text-2xl">
      {{$user->name}}さん、こんにちは！
    @foreach ($posts as $post)
    <div class="mx-4 sm:p-8">
      <div class="mt-4">
        {{-- 修正部分 --}}
        <div class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
          <div class="mt-4">
            <div class="flex">
              <div class="rounded-full w-12 h-12">
                @php
                    $avatarPath = null;
                    if ($post->user && isset($post->user->avatar)) {
                        if (str_starts_with($post->user->avatar, 'storage/avatar/')) {
                            $avatarPath = substr($post->user->avatar, strlen('storage/avatar/'));
                        } else {
                            $avatarPath = $post->user->avatar ? 'avatar/' . $post->user->avatar : 'avatar/user_default.jpg';
                        }
                    } else {
                        $avatarPath = 'avatar/user_default.jpg';
                    }
                @endphp
                
                @if ($avatarPath && file_exists(public_path('storage/avatar/' . $avatarPath)))
                    <img src="{{ asset('storage/avatar/' . $avatarPath) }}" alt="avatar" class="avatar">
                @else
                    <div class="rounded-full w-12 h-12 bg-gray-300"></div>
                @endif
              </div>
              
              <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-4">
                <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
              </h1>
            </div>
            {{-- 修正部分ここまで --}}
            <hr class="w-full">
            <p class="mt-4 text-gray-600 py-4">{{Str::limit($post->body, 50, '...')}} </p>
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p>{{ $post->user->name??'削除されたユーザー' }} • {{$post->created_at->diffForHumans()}}</p>
            </div>
            {{-- 追加部分 コメントのカウント等--}}
            <hr class="w-full mb-2">{{-- 水平線を描画するための <hr> タグです。クラス w-full は幅を100%に設定し、 mb-2 は下部にマージンを追加 --}}
              @if ($post->comments->count())
              <span class="badge"> {{-- badgeについてforum.cssに記載あり --}}
                返信 {{$post->comments->count()}}件
              </span>
              @else
              <span>コメントはまだありません。</span>
              @endif

              {{-- いいねボタンとカウント --}}
              <div class="mt-2 flex flex-col sm:flex-row items-start sm:items-center  justify-between">
                <form action="{{ route('post.like', $post) }}" method="POST" class="mb-2 sm:mb-0 flex items-center">
                  @csrf
                  <button type="submit" class="{{ $post->favorites ->contains(auth()->user()) ? 'bg-red-500 hover:bg-red-700' : 'bg-blue-500 hover:bg-blue-700' }} text-white font-bold py-2 px-4 rounded  flex items-center">
                    {{-- いいね！のアイコン --}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 mr-2">
                    <path d="M1 8.25a1.25 1.25 0 1 1 2.5 0v7.5a1.25 1.25 0 1 1-2.5 0v-7.5ZM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0 1 14 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 0 1-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 0 1-1.341-.317l-2.734-1.366A3 3 0 0 0 6.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 0 1 2.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388Z" />
                    </svg>
                    {{$post->favorites->contains(auth()->user()) ? 'いいね取り消し' : 'いいね' }}
                  </button>
                  <span class="ml-2">{{ $post->favorites->count() }} 人がいいねしています</span>
                </form>
                <div class="mt-2 sm:mt-0">
                  <x-primary-button class="flex items-center">
                    {{-- 鉛筆のアイコン --}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6"> 
                      <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                    </svg>
                    <a href="{{route('post.show', $post)}}" class="text-white text-lg">コメントする</a>
                  </x-primary-button>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</x-app-layout>