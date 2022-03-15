<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>
        <p class="title has-text-centered">{{ __('auth.logIn') }}</p>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('password.update') }}" class="box">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="field">
                <label for="" class="label">{{ __('auth.logIn') }}</label>
                <div class="control has-icons-left">
                    <input type="email" name="email" placeholder="{{ __('auth.logIn') }}" class="input"
                        aria-label="{{ __('auth.email') }}" :value="old('email', $request->email)" required autofocus>
                    <span class="icon is-small is-left">
                        <i class="fa fa-envelope"></i>
                    </span>
                </div>
            </div>
            <div class="columns">
                <div class="column field">
                    <label for="" class="label">{{ __('auth.password') }}</label>
                    <div class="control has-icons-left">
                        <input type="password" name="password" placeholder="*******" class="input"
                            aria-label="{{ __('auth.password') }}" autocomplete="current-password" required>

                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                </div>
                <div class="column field">
                    <label for="" class="label">{{ __('auth.password-confirm') }}</label>
                    <div class="control has-icons-left">
                        <input type="password" name="password_confirmation" placeholder="*******" class="input"
                            aria-label="{{ __('auth.password-confirm') }}" required>

                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="field">
                <button class="button is-primary is-fullwidth" type="submit">
                    {{ __('auth.password-reset') }}
                </button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
