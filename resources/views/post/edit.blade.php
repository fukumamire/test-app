<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
      投稿の編集画面
    </h2>
    <x-validation-errors class="mb-4" :errors="$errors" />
    <x-message :message="session('message')" />

  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 sm:p-8">
      <form method="post" action="{{route('post.store')}}"  enctype="multipart/form-data">
      @csrf
        <div class="md:flex items-center mt-8">
          <div class="w-full flex flex-col">
            <label for="title" class="font-semibold leading-none mt-4">件名</label>
            <input type="text" name="title" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('title',$post->title)}}"  placeholder="タイトルを２５５文字以内で記載してください">
          </div>
        </div>

        <div class="w-full flex flex-col">
          <label for="body" class="font-semibold leading-none mt-4">本文</label>
          <textarea name="body" class="w-auto py-2 placeholder-gray-300 order border-gray-300 rounded-md" id="body" cols="30" rows="10" placeholder="本文は１０００文字以内でお願います">{{old('body', $post->body)}}</textarea>
        </div>

        <div class="w-full flex flex-col">
          @if($post->image)
            <div>
              (画像ファイル：{{$post->image}})
            </div>
            <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
          @endif
          <label for="image" class="font-semibold leading-none mt-4">画像（1MBまで）</label>
          <div>
            <input id="image" type="file" name="image">
          </div>
        </div>
        <button class="group flex h-10 items-center justify-center rounded-md border border-blue-600 bg-gradient-to-b from-teal-400 via-teal-500 to-teal-600 px-4 text-neutral-50 shadow-[inset_0_1px_0px_0px_#5eead4] hover:bg-gradient-to-b hover:from-teal-600 hover:via-teal-600 hover:to-blue-600 active:[box-shadow:none] "><span class="block group-active:[transform:translate3d(0,1px,0)] text-3xl">送信する</span></button>
        
      </form>
    </div>
  </div>
</x-app-layout>