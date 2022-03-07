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

    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <label for="firstname">
        {{ __('message.name') }}
        {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => '', 'disabled' => $readonly]) !!}
    </label>

    <fieldset>
        <legend>{{ __('message.permissions') }}</legend>
        @foreach ($permission as $value)
            <label for="{{ $value->id }}">
                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => '','disabled' => $readonly]) }}

                {{ $value->name }}<br /><small>{{ $value->description }}</small>
            </label>
        @endforeach
    </fieldset>
    @can('role-mngt')
        <div class="grid">
            {!! Form::button('<span class="icon"><i class="gg-remove"></i></span>' . __('message.remove'), ['class' => 'btn-danger', 'type' => 'submit', 'name' => 'action', 'value' => 'delete', 'disabled' => $readonly]) !!}
            {!! Form::button('<span class="icon"><i class="gg-add"></i></span>' . __('message.save'), ['class' => 'btn-success', 'type' => 'submit', 'name' => 'action', 'value' => 'save', 'disabled' => $readonly]) !!}
        </div>
    @endcan
    {!! Form::close() !!}
</x-app-layout>
