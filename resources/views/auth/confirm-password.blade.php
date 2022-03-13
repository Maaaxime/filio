<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <x-auth-card>
        <p class="title">{{ __('auth.password-confirmDetails') }}</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <label for="password" class="label">{{ __('auth.password') }}</label>
            <div class="control has-icons-left">
                <input type="password" name="password" placeholder="*******" class="input"
                    aria-label="{{ __('auth.password') }}" autocomplete="current-password" required>

                <span class="icon is-small is-left">
                    <i class="fa fa-lock"></i>
                </span>
            </div>

            <div class="field">
                <button class="button is-primary  is-fullwidth" type="submit">
                    {{ __('auth.confirm') }}
                </button>
            </div>

            </div>
        </form>
    </x-auth-card>
</x-app-layout>
