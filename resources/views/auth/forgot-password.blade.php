<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>
        <p class="title has-text-centered">{{ __('auth.password-forget') }}</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="box">
            @csrf

            <div class="field">
                <p class="mb-4">{{ __('auth.password-forgetDetails') }}</p>
                <div class="control has-icons-left">
                    <input type="email" name="email" placeholder="{{ __('auth.logIn') }}" class="input"
                        aria-label="{{ __('auth.email') }}" :value="old('email')" required autofocus>
                    <span class="icon is-small is-left">
                        <i class="fa fa-envelope"></i>
                    </span>
                </div>
            </div>

            <div class="field">
                <button class="button is-success is-fullwidth" type="submit">
                    {{ __('auth.password-resend') }}
                </button>
            </div>

            </div>
        </form>
    </x-auth-card>
</x-app-layout>
