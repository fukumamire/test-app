@props(['errors'])

@if ($errors->any())
<div {{ $attributes }}>
  <div class="font-medium text-red-600 text-xl">
    エラーの内容を確認してください。
  </div>

  <ul class="mt-3 list-disc list-inside text-lg text-red-600">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach

    @if(empty($errors->first('image')))
    <li>画像ファイルがあれば、再度、選択してください。</li>
    @endif
  </ul>
</div>
@endif