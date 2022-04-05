<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ $role->name }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>
        {!! Form::model($role, ['method' => 'PATCH', 'route' => ['admin.roles.update', $role->id], 'class' => 'box-no-shadow']) !!}
        {{ Form::hidden('url', URL::previous()) }}
        <div class="field">
            <label class="label">{{ __('message.name') }}</label>
            <div class="control">
                {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => 'input', 'disabled' => $readonly]) !!}
            </div>
        </div>

        <div class="field">
            <div class="pb-2">
                <div class="is-pulled-left">
                    <p class="label">{{ __('message.roles') }}</p>
                </div>
                <div class="is-pulled-right">
                    <p class="">
                        <a OnClick='$(".checkbox-permission").prop("checked", true);'>Sélectionner
                            tout</a> /
                        <a
                            OnClick='$(".checkbox-permission").each(function (){$(this).prop("checked", !($(this).prop("checked"))); });'>Inverser</a>
                    </p>
                </div>
                <div class="is-clearfix"></div>
            </div>
            <div class="list has-visible-pointer-controls has-hoverable-list-items">
                @foreach ($permissions as $permission)
                    <div class="list-item">
                        <div class="list-item-content">
                            <div class="list-item-title">
                                {{ $permission->name }}
                            </div>
                        </div>
                        <div class="list-item-controls">
                            {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $rolePermissions) ? true : false, ['class' => 'checkbox-permission checkbox icon','disabled' => $readonly]) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if (!$readonly)
            <div class="columns is-flex-direction-row-reverse pt-4">
                @can('role.update')
                    <div class="column field is-pulled-right">
                        <div class="control is-pulled-right">
                            {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-floppy-disk"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'action', 'value' => 'save', 'disabled' => $readonly]) !!}
                        </div>
                    </div>
                @endcan
                @can('role.delete')
                    <div class="column field is-pulled-left">
                        <div class="control">
                            {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-minus"></i></span><span>' . __('message.remove') . '</span>', ['class' => 'button is-danger is-outlined confirmDelete', 'type' => 'submit', 'name' => 'action', 'value' => 'delete', 'disabled' => $readonly]) !!}
                        </div>
                    </div>
                @endcan
                <div class="is-clearfix"></div>
            </div>
        @endif
        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
