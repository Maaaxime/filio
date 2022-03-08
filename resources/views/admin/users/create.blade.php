<x-app-layout>
    <x-slot name="header">
        <hgroup>
            <h2 class="">
                {{ __('message.usersManagement') }}
            </h2>
            <h3>
                <a href="{{ route('users.index') }}">
                    <span class="icon"><i class="gg-arrow-left-o"></i></span>{{ __('message.back') }}
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
    <div class="grid">
        <fieldset>
            <legend>{{ __('message.roles') }}</legend>
            @foreach ($roles as $value)
                <label for="{{ $value->name }}">
                    {!! Form::checkbox('roles[]', $value->name, [], ['class' => '']) !!}
                    {{ $value->name }}
                </label>
            @endforeach
        </fieldset>
        <fieldset>
            <legend>{{ __('message.childs') }}</legend>
            @foreach ($childs as $value)
                <label for="{{ $value->id }}">
                    {!! Form::checkbox('childs[]', $value->id, [], ['class' => '']) !!}
                    {{ $value->full_name }}
                </label>
            @endforeach
        </fieldset>
    </div>
    {!! Form::button('<span class="icon"><i class="gg-add"></i></span>' . __('message.save'), ['class' => 'btn-success', 'type' => 'submit', 'name' => 'action', 'value' => 'save']) !!}
    {!! Form::close() !!}
</x-app-layout>
