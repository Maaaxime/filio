<aside class="menu main-menu container">
    <a href="{{ route('dashboard') }}">
        <figure style="text-align: center;">
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
        @if (Auth::hasUser() &&
    Auth()->user()->children()->count() > 0)
            <li>
                <a href="{{ url('/my/children') }}"
                    class={{ request()->routeIs('user.children.my') ? 'is-active' : '' }}>{{ trans_choice('message.myChildren',Auth()->user()->children()->count()) }}</a>
            </li>
        @endif
        <li>
            <a href="{{ url('/posts') }}"
                class={{ request()->routeIs('posts') ? 'is-active' : '' }}>{{ __('message.posts') }}</a>
        </li>
    </ul>
    @can('admin.routes')
        <p class="menu-label">
            {{ __('message.administration') }}
        </p>
        <ul class="menu-list">
            <li>
                <a href="{{ url('/admin/children') }}"
                    class={{ request()->routeIs('admin.children.*') ? 'is-active' : '' }}>
                    {{ __('message.childrenManagement') }}
                </a>
            </li>
            <li>
                <p class="menu-label">{{ __('message.teamManagement') }}</p>
                <ul>
                    <li>
                        <a href="{{ url('/admin/users') }}"
                            class={{ request()->routeIs('admin.users.*') ? 'is-active' : '' }}>
                            {{ __('message.usersManagement') }}
                        </a>
                    </li>
                    <li><a href="{{ url('/admin/roles') }}"
                            class={{ request()->routeIs('admin.roles.*') ? 'is-active' : '' }}>
                            {{ __('message.rolesManagement') }}
                        </a>
                    </li>
                </ul>
                <p class="menu-label">{{ __('message.attendanceManagement') }}</p>
                <ul>
                    <li>
                        <a href="{{ url('/admin/attendances/entries') }}"
                            class={{ request()->routeIs('admin.attendances.entries.*') ? 'is-active' : '' }}>
                            {{ __('message.attendanceEntriesManagement') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/attendances/types') }}"
                            class={{ request()->routeIs('admin.attendances.types.*') ? 'is-active' : '' }}>
                            {{ __('message.attendanceTypesManagement') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/attendances/schedules') }}"
                            class={{ request()->routeIs('admin.attendances.schedules.*') ? 'is-active' : '' }}>
                            {{ __('message.attendanceSchedulesManagement') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/attendances/reports') }}"
                            class={{ request()->routeIs('admin.attendances.reports.index') ? 'is-active' : '' }}>
                            {{ __('message.reportsManagement') }}
                        </a>
                    </li>
                </ul>

            </li>
        </ul>
    @endcan
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
