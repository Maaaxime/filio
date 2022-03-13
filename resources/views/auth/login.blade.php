<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>
        <p class="title has-text-centered">{{ __('auth.logIn') }}</p>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="box">
            @csrf

            <div class="field">
                <label for="" class="label">{{ __('auth.logIn') }}</label>
                <div class="control has-icons-left">
                    <input type="email" name="email" placeholder="{{ __('auth.logIn') }}" class="input"
                        aria-label="{{ __('auth.email') }}" :value="old('email')" required autofocus>
                    <span class="icon is-small is-left">
                        <i class="fa fa-envelope"></i>
                    </span>
                </div>
            </div>
            <div class="field">
                <label for="" class="label">{{ __('auth.password') }}</label>
                <div class="control has-icons-left">
                    <input type="password" name="password" placeholder="*******" class="input"
                        aria-label="{{ __('auth.password') }}" autocomplete="current-password" required>

                    <span class="icon is-small is-left">
                        <i class="fa fa-lock"></i>
                    </span>
                </div>
            </div>
            <div class="field">
                <label for="remember_me">
                    <input type="checkbox" role="switch" id="remember_me" name="remember">
                    {{ __('auth.rememberMe') }}
                </label>
            </div>
            <div class="field">
                <button class="button is-primary is-fullwidth" type="submit">
                    {{ __('auth.logIn') }}
                </button>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('auth.password-forget') }}
                </a>
            @endif
        </form>
    </x-auth-card>
</x-app-layout>
