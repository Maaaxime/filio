<x-app-layout>
    <x-slot name="header">
        <hgroup>
            <h2 class="">
                {{ __('message.rolesManagement') }}
            </h2>
            <h3>
                <a href="{{ route('roles.index') }}">
                    <span class="icon"><i class="gg-arrow-left-o"></i></span>{{ __('message.back') }}
                </a>
            </h3>
        </hgroup>
    </x-slot>

    <x-banner />

    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
    <label for="name">
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
    {!! Form::button('<span class="icon"><i class="gg-add"></i></span>' . __('message.save'), ['class' => 'btn-success', 'type' => 'submit', 'name' => 'action', 'value' => 'save']) !!}
    {!! Form::close() !!}
</x-app-layout>
