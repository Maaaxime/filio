<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="text" name="email" placeholder="{{ __('auth.logIn') }}" type="email" aria-label="{{ __('auth.email') }}" :value="old('email')" required autofocu>
            <input type="password" name="password" placeholder="{{ __('auth.password') }}" aria-label="{{ __('auth.password') }}" autocomplete="current-password" required>
            <fieldset>
              <label for="remember_me">
                <input type="checkbox" role="switch" id="remember_me" name="remember">
                {{ __('auth.rememberMe') }}
              </label>
            </fieldset>
            <button type="submit" class="contrast">{{ __('auth.logIn') }}</button>
            @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('auth.password-forget') }}
                    </a>
                @endif
        </form>
    </x-auth-card>
</x-app-layout>