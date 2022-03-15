<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        @if (Route::has('login'))
            <div class="navbar-item columns">
                <div class="column is-nested">
                    @if (Auth::user()->image)
                        <div class="image is-rounded is-48x48"
                            style="background-image: url('{{ asset('/storage/images/' . Auth::user()->image) }}');">
                        </div>
                    @endif
                </div>
                <div class="colum is-nested">
                    <a href="{{ route('my.profile') }}">
                        <p class="title is-6">{{ Auth::user()->name }}</p>
                        <p class="subtitle is-7">{{ __('message.showProfile') }}</p>
                    </a>
                </div>
            </div>
        @endif

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbar" class="navbar-menu">
        <div class="navbar-start">
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="button is-danger is-light">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
