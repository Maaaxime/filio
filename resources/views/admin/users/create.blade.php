<x-app-layout>
    <x-slot name="header">
        <hgroup>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('message.usersManagement') }}
            </h2>
            <h3>
                <a href="{{ route('users.index') }}">
                    <span class="icon"><i class="gg-arrow-left-o"></i></span> {{ __('message.back') }}
                </a>
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
        {{ __('auth.email') }}
        {!! Form::text('email', null, ['placeholder' => __('auth.email'), 'class' => '']) !!}
    </label>
    <div class="grid">
        <div>
            <label for="password" class="">
                {{ __('auth.password') }}
                {!! Form::password('password', ['placeholder' => __('auth.password'), 'class' => '']) !!}
            </label>
        </div>
        <div>
            <label for="confirm-password" class="">
                {{ __('auth.password-confirm') }}
                {!! Form::password('confirm-password', ['placeholder' => __('auth.password-confirm'), 'class' => '']) !!}
            </label>
        </div>
    </div>

    <label for="roles">
        {{ __('message.roles') }}
        {!! Form::select('roles[]', $roles, [], ['class' => '', 'multiple']) !!}
    </label>
    {!! Form::button('<span class="icon"><i class="gg-add"></i></span> ' . __('message.save'), ['class' => 'btn-success', 'type' => 'submit', 'name' => 'action', 'value' => 'save') !!}
    {!! Form::close() !!}
</x-app-layout>
