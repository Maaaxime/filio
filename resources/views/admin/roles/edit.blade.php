<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.rolesManagement') }} : {{ $role->name }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ route('roles.index') }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id], 'class' => 'box']) !!}

        <div class="field">
            <label class="label">{{ __('message.name') }}</label>
            <div class="control">
                {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => 'input', 'disabled' => $readonly]) !!}
            </div>
        </div>

        <div class="field">
            <p class="title">{{ __('message.roles') }}</p>
            @foreach ($permission as $value)
                <div class="card mb-4">
                    <header class="card-header">
                        <div class="card-header-title">
                            <p class="title is-5">{{ $value->name }}</p>
                            @if ($value->description != '')
                                <p class="subtitle is-6">{{ $value->description }}</p>
                            @endif
                        </div>
                        <span class="card-header-icon" aria-label="more options">
                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'checkbox icon','disabled' => $readonly]) }}
                        </span>
                    </header>
                </div>
            @endforeach
        </div>

        @if (!$readonly)
            @can('role-mngt')
                <div class="field is-grouped is-pulled-right pt-4">
                    <div class="control">
                        {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-minus"></i></span><span>' . __('message.remove') . '</span>', ['class' => 'button is-danger is-outlined', 'type' => 'submit', 'name' => 'action', 'value' => 'delete', 'disabled' => $readonly]) !!}
                    </div>
                    <div class="control">
                        {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-floppy-disk"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-success', 'type' => 'submit', 'name' => 'action', 'value' => 'save', 'disabled' => $readonly]) !!}
                    </div>
                </div>
                <div class="is-clearfix"></div>
            @endcan
        @endif
        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
