<aside class="menu main-menu container">
    <a href="{{ route('dashboard') }}">
        <figure>
            <img src="{{ url(asset('img/logo.png')) }}" style="height: 60px">
        </figure>
    </a>
    <hr />
    <p class="menu-label">
        {{ __('message.general') }}
    </p>
    <ul class="menu-list">
        <li><a href="{{ url('/dashboard') }}"
                class={{ request()->routeIs('dashboard') ? 'is-active' : '' }}>{{ __('message.dashboard') }}</a>
        </li>
        <li><a href="{{ url('/my/childs') }}"
                class={{ request()->routeIs('my.childs') ? 'is-active' : '' }}>{{ trans_choice('message.myChilds',Auth()->user()->childs()->count()) }}</a></li>
    </ul>
    <p class="menu-label">
        {{ __('message.administration') }} {{ Illuminate\Support\Facades\Route::currentRouteName() }}
    </p>
    <ul class="menu-list">
        <li><a href="{{ url('/admin/childs') }}"
                class={{ request()->routeIs('childs.*') ? 'is-active' : '' }}>{{ __('message.childsManagement') }}</a>
        </li>
        <li>
            <p>{{ __('message.teamManagement') }}</p>
            <ul>
                <li><a href="{{ url('/admin/users') }}"
                        class={{ request()->routeIs('users.*') ? 'is-active' : '' }}>{{ __('message.usersManagement') }}</a>
                </li>
                <li><a href="{{ url('/admin/roles') }}"
                        class={{ request()->routeIs('roles.*') ? 'is-active' : '' }}>{{ __('message.rolesManagement') }}</a>
                </li>
            </ul>
        </li>
    </ul>
    <hr />
    <ul class="menu-list">
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="button is-danger is-light is-fullwidth">
                    <span class="icon is-small">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </span>
                    <span>
                        {{ __('auth.logOut') }}
                    </span>
                </button>
            </form>
        </li>
    </ul>
</aside>
