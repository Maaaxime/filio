<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>
        <p>{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <input type="password" name="password" placeholder="Password" aria-label="Password" autocomplete="current-password" required>
            <button type="submit" class="contrast">{{ __('auth.confirm') }}</button>
        </form>
    </x-auth-card>
    </x-guest-layout>
