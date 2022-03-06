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
            <input type="text" name="email" placeholder="Login" type="email" aria-label="Login" :value="old('email', $request->email)" required autofocu>
            
            <!-- Password -->
            <input type="password" name="password" placeholder="__('Password')" aria-label="Password" required>

            <!-- Confirm Password -->
            <input type="password" name="password_confirmation" placeholder="__('Confirm Password')" aria-label="Password" required>

            <button type="submit" class="contrast">{{ __('Reset Password') }}</button>
        </form>
    </x-auth-card>
    </x-guest-layout>
