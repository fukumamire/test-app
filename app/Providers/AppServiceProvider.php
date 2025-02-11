<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void// Laravelのサービスプロバイダーが起動する際に呼び出されるメソッド
  {
    Gate::define('admin', function ($user) {
      foreach ($user->roles as $role) {
        if ($role->name == 'admin') {
          return true;
        }
      }
      return false;
    });
  }
}
