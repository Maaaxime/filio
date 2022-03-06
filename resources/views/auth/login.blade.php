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

            <input type="text" name="email" placeholder="Login" type="email" aria-label="Login" :value="old('email')" required autofocu>
            <input type="password" name="password" placeholder="Password" aria-label="Password" autocomplete="current-password" required>
            <fieldset>
              <label for="remember_me">
                <input type="checkbox" role="switch" id="remember_me" name="remember">
                {{ __('Remember me') }}
              </label>
            </fieldset>
            <button type="submit" class="contrast">Login</button>
            @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
        </form>
    </x-auth-card>
</x-app-layout>