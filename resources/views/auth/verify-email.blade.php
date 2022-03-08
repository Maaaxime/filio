<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>
        <p>
            {{ __('auth.check-email') }}
        </p>

        @if (session('status') == 'verification-link-sent')
            <p>
                {{ __('auth.check-emailSent') }}
            </p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">{{ __('check-emailSend') }}</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"> {{ __('auth.logOut') }}</button>
        </form>
    </x-auth-card>
    </x-guest-layout>
