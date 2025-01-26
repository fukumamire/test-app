<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
      投稿の個別表示
    </h2>

    <x-message :message="session('message')" />

  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 sm:p-8">
      <div class="px-10 mt-4">
        <div class="bg-teal-50 w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
          <div class="mt-4">
            <h1 class="text-lg text-gray-700 font-semibold">
              {{ $post->title }}
            </h1>
            <hr class="w-full">
          </div>
          <div class="flex justify-end mt-4" >
            @auth
              @if($post->user_id === auth()->user()->id)
                <a href="{{route('post.edit', $post)}}"><x-primary-button class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 text-white font-bold py-2 px-4 rounded float-right">編集</x-primary-button></a>
                <form method="post" action="{{route('post.destroy', $post)}}">
                  @csrf
                  @method('delete')
                  <x-primary-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
                </form>
              @endif
            @endauth    
          </div>
          
          <div>
            <p class="mt-4 text-gray-600 py-4 whitespace-pre-line">{{$post->body}}</p>
            @if($post->image)
              <div>
                (画像ファイル：{{$post->image}})
              </div>
              <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
            @endif
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p> {{ $post->user->name }} • {{$post->created_at->diffForHumans()}}</p>
            </div>
          </div>
          {{-- コメント表示 --}}
          @foreach ($post->comments as $comment)
          <div class="bg-lime-100 w-full  rounded-2xl px-10 py-2 shadow-lg mt-8 whitespace-pre-line">
            {{$comment->body}}
            <div class="text-sm font-semibold flex flex-row-reverse">
              <p> 投稿者：{{ $comment->user->name }} • {{$comment->created_at->diffForHumans()}}</p>
            </div>
          </div>
          @endforeach
          
          <div class="mt-4 mb-12">
            <form method="post" action="{{route('comment.store')}}">
            @csrf
              <input type="hidden" name='post_id' value="{{$post->id}}">
              <textarea name="body" class="bg-white w-full  rounded-2xl px-4 mt-4 py-4 shadow-lg hover:shadow-2xl transition duration-500" id="body" cols="30" rows="3" placeholder="コメントを入力してください">{{old('body')}}</textarea>
              
              <x-primary-button class="bg-gradient-to-r from-teal-300 via-blue-500 to-green-700 text-white font-bold py-2 px-4 rounded float-right  mr-4 mb-12">
                {{-- 鉛筆のアイコン --}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                </svg>コメントする</x-primary-button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>