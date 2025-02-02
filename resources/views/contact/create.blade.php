<x-guest-layout>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-yellow-50 py-8 md:py-12">
    <div class="mx-4 sm:p-8">
      <h1 class="text-4xl text-gray-700 font-semibold hover:underline cursor-pointer">
        お問い合わせ
      </h1>
      <x-validation-errors class="mb-4" :errors="$errors" />
      <x-message :message="session('message')" />

      <form method="post" action="{{ route('contact.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="md:flex items-center mt-8">
          <div class="w-full flex flex-col mb-4">
            <label for="title" class="font-semibold text-2xl leading-none mt-4">件名</label>
            <input type="text" name="title" class="w-full py-2 text-xl placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{ old('title') }}" placeholder="タイトルを255文字以内で記載してください">
          </div>
        </div>

        <div class="w-full flex flex-col mb-4">
          <label for="body" class="font-semibold text-2xl leading-none mt-4">本文</label>
          <textarea name="body" class="w-full py-2 text-xl placeholder-gray-300 border border-gray-300 rounded-md" id="body" cols="30" rows="10" placeholder="本文は1000文字以内でお願いします">{{ old('body') }}</textarea>
        </div>

        <div class="md:flex items-center mb-4">
          <div class="w-full flex flex-col">
            <label for="email" class="font-semibold text-2xl leading-none mt-4">メールアドレス</label>
            <input type="text" name="email" class="w-full py-2 text-xl placeholder-gray-300 border border-gray-300 rounded-md" id="email" value="{{ old('email') }}" placeholder="Enter Email">
          </div>
        </div>

        <button class="group flex h-10 items-center justify-center rounded-md border border-teal-600 bg-gradient-to-b from-teal-400 via-teal-500 to-teal-600 px-4 text-neutral-50 shadow-[inset_0_1px_0px_0px_#5eead4] hover:bg-gradient-to-b hover:from-teal-600 hover:via-teal-600 hover:to-teal-600 active:[box-shadow:none]">
          <span class="block group-active:[transform:translate3d(0,1px,0)] text-3xl">送信する</span>
        </button>
      </form>
    </div>
  </div>
</x-guest-layout>
