<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Message extends Component
{
  public $message;
  /**
   * Create a new component instance.
   */
  public function __construct($message)
  {
    $this->message = $message;
  }

  /**
   * Get the view / contents that represent the component.
   */
  // この部分は編集不要
  public function render(): View|Closure|string
  {
    return view('components.message');
  }
}
