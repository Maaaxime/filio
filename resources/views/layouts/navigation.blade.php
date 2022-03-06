<nav class="container-fluid">
    <ul>
        <li>
            <a href="{{ route('dashboard') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </li>
    </ul>
    @if (Route::has('login'))
        @auth
            <ul>
                <li>
                    {{ __('message.welcome') }} {{ Auth::user()->name }} !
                </li>
            </ul>
        @endauth
    @endif
    <ul>
        @if (Route::has('login'))
            @auth
                <li><a href="{{ url('/dashboard') }}" class="secondary">{{ __('message.dashboard') }}</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault();
                                                        this.closest('form').submit();" class="secondary">
                            {{ __('message.logOut') }}</a>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="secondary">{{ __('message.logIn') }}</a></li>
            @endauth
        @endif
    </ul>
</nav>
