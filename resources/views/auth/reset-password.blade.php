<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <input type="text" name="email" placeholder="{{ __('auth.logIn') }}" type="email" aria-label="{{ __('auth.logIn') }}" :value="old('email', $request->email)" required autofocu>
            
            <!-- Password -->
            <input type="password" name="password" placeholder="{{ __('auth.password') }}" aria-label="Password" required>

            <!-- Confirm Password -->
            <input type="password" name="password_confirmation" placeholder="{{ __('auth.password-confirm') }}" aria-label="{{ __('auth.password') }}" required>

            <button type="submit">{{ __('auth.password-reset') }}</button>
        </form>
    </x-auth-card>
    </x-guest-layout>
