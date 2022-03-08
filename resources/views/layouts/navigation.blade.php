<nav class="container-fluid">
    <ul>
        <li>
            <a href="{{ route('dashboard') }}">
                <img src="{{ url(asset('img/logo.png')) }}" style="height: 60px">
            </a>
        </li>
    </ul>
    <ul>
        @if (Route::has('login'))
            @auth
            <li>
                <div class="grid flex items-center profile">
                    <div class="flex-shrink-0">
                        @if (Auth::user()->image)
                            <div class="img-circle""
                                style="background-image: url('{{ asset('/storage/images/' . Auth::user()->image) }}'); width: 40px; height: 40px;">
                            </div>
                        @endif
                    </div>
                    <div style="">
                        <a href="{{ route('users.edit', Auth::user()->id) }}">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                <li>
                    <a href="{{ url('/dashboard') }}">
                        <span class="icon icon-nav btn-info"><i class="gg-layout-grid"></i></span>
                    </a>
                </li>
                <li>
                    <a href="#" class="secondary dropbtn" onclick="showDropDown();">
                        <span class="icon icon-nav btn-info dropbtn"><i class="gg-chevron-down dropbtn"></i></span>
                    </a>
                    <div class="dropdown-content" id="dropdown-content">
                        <ul>
                            <li>
                                <div class="grid flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if (Auth::user()->image)
                                            <div class="w-10 h-10 img-circle"
                                                style="background-image: url('{{ asset('/storage/images/' . Auth::user()->image) }}')">
                                            </div>
                                        @endif
                                    </div>
                                    <div style="width: 100%">
                                        <a
                                            href="{{ route('users.edit', Auth::user()->id) }}">{{ Auth::user()->name }}<br /><small>{{ __('message.showProfile') }}</small></a>
                                    </div>
                                </div>
                            </li>
                            <hr>
                            <li>
                                <a href="{{ url('/admin/users') }}">
                                    <span class="icon icon-nav btn-info">
                                        <i class="gg-user"></i>
                                    </span>
                                    {{ __('message.usersManagement') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin/roles') }}">
                                    <span class="icon icon-nav btn-info">
                                        <i class="gg-awards"></i>
                                    </span>
                                    {{ __('message.rolesManagement') }}
                                </a>
                            </li>
                            <hr>
                            <li>
                                <a href="{{ url('/childs') }}">
                                    <span class="icon icon-nav btn-info">
                                        <i class="gg-bee"></i>
                                    </span>
                                    {{ __('message.childsManagement') }}
                                </a>
                            </li>
                            <hr />
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <span class="icon icon-nav btn-info">
                                            <i class="gg-log-out"></i>
                                        </span>
                                        {{ __('auth.logOut') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}">
                        <span class="icon icon-nav btn-info">
                            <i class="gg-log-in"></i>
                        </span>
                    </a>
                </li>
            @endauth
        @endif
    </ul>
</nav>

<script>
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function showDropDown() {
        var dropDown = document.getElementById("dropdown-content");
        if (!dropDown.classList.contains('show')) {
            dropDown.classList.toggle('show');
        }

        console.log(dropDown.classList);
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(e) {
        if (!e.target.matches('.dropbtn')) {
            var dropDown = document.getElementById("dropdown-content");
            if (dropDown.classList.contains('show')) {
                dropDown.classList.remove('show');
            }
        }
    }
</script>
