<x-app-layout>
    <x-slot name="header">
        <hgroup>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('message.usersManagement') }}
            </h2>
            <h3><a href="{{ route('users.index') }}">
                {{ __('message.back') }}</a>
            </h3>
        </hgroup>
    </x-slot>

    <x-banner />

    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
    <label for="name">
        {{ __('message.name') }}
        {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => '']) !!}
    </label>
    <label for="email">
        {{ __('message.email') }}
        {!! Form::text('email', null, ['placeholder' => __('message.email'), 'class' => '']) !!}
    </label>
    <div class="grid">
        <div>
            <label for="password" class="">
                {{ __('message.password') }}
                {!! Form::password('password', ['placeholder' => __('message.password'), 'class' => '']) !!}
            </label>
        </div>
        <div>
            <label for="confirm-password" class="">
                {{ __('message.password-confirm') }}
                {!! Form::password('confirm-password', ['placeholder' => __('message.password-confirm'), 'class' => '']) !!}
            </label>
        </div>
    </div>

    <label for="roles">
        {{ __('message.roles') }}
    {!! Form::select('roles[]', $roles, [], ['class' => '', 'multiple']) !!}
    </label>
    <button type="submit" class="btn-success">{{ __('message.save') }}</button>
    {!! Form::close() !!}
</x-app-layout>
