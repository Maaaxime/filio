<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>

        <p>
            {{ __('auth.password-forgetDetails') }}
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <input type="text" name="email" placeholder="{{ __('auth.logIn') }}" type="email" aria-label="{{ __('auth.logIn') }}" :value="old('email')" required autofocu>
            <button type="submit">{{ __('auth.password-resend') }}</button>
        </form>
    </x-auth-card>
</x-guest-layout>