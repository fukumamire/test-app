<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;
  protected $fillable = [
    'title',
    'body',
    'user_id',
    'image',
  ];

  public function user()
  {
    // 一つの投稿が１人に属する
    return $this->belongsTo(User::class);
  }
}
