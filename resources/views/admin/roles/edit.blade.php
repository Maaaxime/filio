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

    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <label for="firstname">
        {{ __('message.name') }}
        {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => '', 'disabled' => $readonly]) !!}
    </label>

    <fieldset>
        <legend>{{ __('message.permissions') }}</legend>
        @foreach ($permission as $value)
            <label for="{{ $value->id }}">
                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => '', 'disabled' => $readonly)) }}
                                                    
                {{ $value->name }}<br /><small>{{ $value->description }}</small>
            </label>
        @endforeach
    </fieldset>
    <button type="submit" class="btn-success" @if ($readonly) disabled @endif>{{ __('message.save') }}</button>
    {!! Form::close() !!}
</x-app-layout>
