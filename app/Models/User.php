<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NewVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'avatar',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function posts()
  {
    // ひとりのユーザーが複数の投稿を持つ
    return $this->hasMany(Post::class);
  }

  public function favorites()
  {
    return $this->belongsToMany(Post::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }

  public function sendEmailVerificationNotification()
  {
    $this->notify(new NewVerifyEmail());
  }
}
