<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>

        <p>
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <input type="text" name="email" placeholder="Login" type="email" aria-label="Login" :value="old('email')" required autofocu>
            <button type="submit" class="contrast">{{ __('Email Password Reset Link') }}</button>
        </form>
    </x-auth-card>
</x-guest-layout>