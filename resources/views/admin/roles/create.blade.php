<x-app-layout>
    <x-slot name="header">
        <hgroup>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('message.rolesManagement') }}
            </h2>
            <h3><a href="{{ route('roles.index') }}">
                    {{ __('message.back') }}</a>
            </h3>
        </hgroup>
    </x-slot>

    <x-banner />

    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
    <label for="firstname">
        {{ __('message.name') }}
        {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => '']) !!}
    </label>

    <fieldset>
        <legend>{{ __('message.permissions') }}</legend>
        @foreach ($permission as $value)
            <label for="{{ $value->id }}">
                {{ Form::checkbox('permission[]', $value->id, false, ['class' => '']) }}
                {{ $value->name }}<br /><small>{{ $value->description }}</small>
            </label>
        @endforeach
    </fieldset>
    <button type="submit" class="btn-success">{{ __('message.save') }}</button>
    {!! Form::close() !!}
</x-app-layout>
