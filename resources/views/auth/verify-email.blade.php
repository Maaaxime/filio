<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>
        <p>
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>
        
        @if (session('status') == 'verification-link-sent')
            <p>
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="contrast">{{ __('Resend Verification Email') }}</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="contrast"> {{ __('Log Out') }}</button>
        </form>
    </x-auth-card>
    </x-guest-layout>
