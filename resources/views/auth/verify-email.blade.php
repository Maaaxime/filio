<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>
        <p class="title">{{ __('auth.check-email') }}</p>

        @if (session('status') == 'verification-link-sent')
            <p>
                {{ __('auth.check-emailSent') }}
            </p>
        @endif

        <div class="columns">
            <div class="column">
                <form method="POST" action="{{ route('login') }}" class="box">
                    @csrf
                    <div class="field">
                        <button class="button is-success is-fullwidth" type="submit">
                            {{ __('auth.logIn') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="column">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="field">
                        <button class="button is-warning is-fullwidth" type="submit">
                            {{ __('auth.logOut') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-app-layout>
