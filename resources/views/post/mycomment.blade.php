<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
      コメントした投稿の一覧
    </h2>
    <x-message :message="session('message')" />

  </x-slot>

  {{-- 投稿一覧表示用のコード --}}
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if (count($comments) == 0)
      <p class="mt-4 text-xl">
        あなたはまだコメントしていません。
      </p>
    @else
    @foreach ($comments->unique('post_id') as $comment)
    @php
    //コメントした投稿
    $post = $comment->post;
    @endphp
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
              <p>{{ $post->user->name }} • {{$post->created_at->diffForHumans()}}</p>
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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6"> 
                  <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                </svg>
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