<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class NewVerifyEmail extends VerifyEmail
{
  public static $toMailCallback;

  protected function buildMailMessage($url)
  {
    return (new MailMessage)
      ->subject('メールアドレスの確認')
      ->line('ご登録ありがとうございます。')
      // lineの行を追加
      ->line('新しいメンバーが増えて、とても嬉しいです')
      ->action('このボタンをクリック', $url)
      ->line('上記のボタンをクリックすると、ご登録が完了します！');
  }
}
