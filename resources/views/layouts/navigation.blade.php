<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
  <!-- Primary Navigation Menu -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <!-- Logo -->
        <div class="shrink-0 flex items-center animate-bounce">
          <a href="{{ route('post.index') }}">
            <img src="{{asset('logo/tiwawa.png')}}" style="max-height:50px;">
          </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')" >
            HOME
          </x-nav-link>
          <x-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
            新規作成
          </x-nav-link>
          <x-nav-link :href="route('post.mypost')" :active="request()->routeIs('post.mypost')">
            自分の投稿
          </x-nav-link>
          <x-nav-link :href="route('post.mycomment')" :active="request()->routeIs('post.mycomment')">
            コメントした投稿
          </x-nav-link>
          @can('admin'){{-- adminのRoleがあるユーザーの場合だけ、「ユーザー一覧」メニューが表示 --}}
          <x-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.index')">
            ユーザー一覧
          </x-nav-link>
          @endcan
        </div>
      </div>

      <!-- Settings Dropdown -->
      <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
              {{-- ↓もしログインしていたら表示する --}}
              <div>@if(Auth::check()) {{ Auth::user()->name }} @endif</div>

              <div class="ms-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </div>
            </button>
          </x-slot>

          <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
              {{ __('Profile') }}
            </x-dropdown-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
              @csrf

              <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                {{ __('Log Out') }}
              </x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>
      </div>

      <!-- Hamburger -->
      
      <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-teal-400 hover:text-teal-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-teal-700 transition duration-150 ease-in-out">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
        HOME
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
        新規作成
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('post.mypost')" :active="request()->routeIs('post.mypost')">
        自分の投稿
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('post.mycomment')" :active="request()->routeIs('post.mycomment')">
        コメントした投稿
      </x-responsive-nav-link>
      @can('admin')
      <x-responsive-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.index')">
        ユーザー一覧
      </x-responsive-nav-link>
      @endcan
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
      <div class="px-4">
        {{-- ↓もしログインしていたら表示する --}}
        <div class="font-medium text-base text-gray-800">@if(Auth::check()) {{ Auth::user()->name }} @endif</div>
        {{-- ↓もしログインしていたら表示する --}}
        <div class="font-medium text-sm text-gray-500">@if(Auth::check()) {{ Auth::user()->email }} @endif</div>
      </div>

      <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile.edit')">
          {{ __('Profile') }}
        </x-responsive-nav-link>

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </form>
      </div>
    </div>
  </div>
</nav>