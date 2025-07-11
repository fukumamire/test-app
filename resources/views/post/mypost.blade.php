<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
      投稿の一覧
    </h2>
    <x-message :message="session('message')" />

  </x-slot>

  {{-- 投稿一覧表示用のコード --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if (count($posts) == 0)
      <p class="mt-4 text-xl">
        あなたはまだ投稿していません。
      </p>
    @else
    @foreach ($posts as $post)
    <div class="mx-4 sm:p-8">
      <div class="mt-4">
        <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
          <div class="mt-4">
            <h1 class="text-xl text-gray-700 font-semibold hover:underline cursor-pointer">
            <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
            </h1>
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
              <x-primary-button class="float-right">
                <a href="{{route('post.show', $post)}}" style="color:rgb(255, 255, 255);">コメントする</a>
              </x-primary-button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>
</x-app-layout>