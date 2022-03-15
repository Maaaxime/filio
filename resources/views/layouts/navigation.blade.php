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
        <li>
            <a href="{{ url('/dashboard') }}"
                class={{ request()->routeIs('dashboard') ? 'is-active' : '' }}>{{ __('message.dashboard') }}</a>
        </li>
        @if (Auth()->user()->children()->count() > 0)
            <li>
                <a href="{{ url('/my/children') }}"
                    class={{ request()->routeIs('my.children') ? 'is-active' : '' }}>{{ trans_choice('message.myChildren',Auth()->user()->children()->count()) }}</a>
            </li>
        @endif
    </ul>
    <p class="menu-label">
        {{ __('message.administration') }}
    </p>
    <ul class="menu-list">
        <li>
            <a href="{{ url('/admin/children') }}" class={{ request()->routeIs('admin.children.*') ? 'is-active' : '' }}>
                <span class="icon-text">
                    <span class="icon">
                        <i class="fa-solid fa-baby"></i>
                    </span>
                </span> {{ __('message.childrenManagement') }}
            </a>
        </li>
        <li>
            <p class="menu-label">{{ __('message.teamManagement') }}</p>
            <ul>
                <li>
                    <a href="{{ url('/admin/users') }}"
                        class={{ request()->routeIs('admin.users.*') ? 'is-active' : '' }}>
                        <span class="icon-text">
                            <span class="icon">
                                <i class="fa-solid fa-user"></i>
                            </span>
                        </span> {{ __('message.usersManagement') }}
                    </a>
                </li>
                <li><a href="{{ url('/admin/roles') }}"
                        class={{ request()->routeIs('admin.roles.*') ? 'is-active' : '' }}>
                        <span class="icon-text">
                            <span class="icon">
                                <i class="fa-solid fa-key"></i>
                            </span>
                        </span> {{ __('message.rolesManagement') }}
                    </a>
                </li>
            </ul>
            <p class="menu-label">{{ __('message.attendanceManagement') }}</p>
            <ul>
                <li>
                    <a href="{{ url('/admin/attendances/entries') }}"
                        class={{ request()->routeIs('admin.attendances.entries.*') ? 'is-active' : '' }}>
                        <span class="icon-text">
                            <span class="icon">
                                <i class="fa-solid fa-calendar"></i>
                            </span>
                        </span> {{ __('message.timeEntriesManagement') }}
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/attendances/types') }}"
                        class={{ request()->routeIs('attendances.types.*') ? 'is-active' : '' }}>
                        <span class="icon-text">
                            <span class="icon">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                        </span> {{ __('message.timeEntryTypesManagement') }}
                    </a>
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
