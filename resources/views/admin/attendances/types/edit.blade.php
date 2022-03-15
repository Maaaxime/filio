<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ $timeEntryType->name }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::model($timeEntryType, ['method' => 'PATCH', 'route' => ['admin.attendances.types.update', $timeEntryType->id], 'class' => 'box-no-shadow']) !!}
        {{  Form::hidden('url',URL::previous())  }}
        <div class="field">
            <label class="label">{{ __('message.name') }}</label>
            <div class="control">
                {!! Form::text('name', null, ['class' => 'input', 'disabled' => $readonly]) !!}
            </div>
        </div>

        <div class="field">
            <label class="label">{{ __('message.description') }}</label>
            <div class="control">
                {!! Form::textarea('description', null, ['class' => 'textarea', 'rows' => 3, 'disabled' => $readonly]) !!}
            </div>
        </div>
        <div class="field">
            <label class="checkbox">
                {{ Form::checkbox('default', null, $timeEntryType->default, ['class' => 'checkbox icon','disabled' => $readonly]) }}
                {{ __('message.timeEntryTypesDefault') }}
            </label>
        </div>
        <div class="field">
            <label class="checkbox">
                {{ Form::checkbox('need_proof', null, $timeEntryType->need_proof, ['class' => 'checkbox icon','disabled' => $readonly]) }}
                {{ __('message.timeEntryTypesNeedProof') }}
            </label>
        </div>

        <div class="field">
            <label class="checkbox">
                {{ Form::checkbox('need_permission', null, $timeEntryType->need_permission, ['class' => 'checkbox icon','disabled' => $readonly]) }}
                {{ __('message.timeEntryTypesNeedPermission') }}
            </label>
        </div>

        @if (!$readonly)
        @canany(['role-update','role-delete'])
                <div class="columns is-flex-direction-row-reverse pt-4">
                    @can('role-update')
                    <div class="column field is-pulled-right">
                        <div class="control is-pulled-right">
                            {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-floppy-disk"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'action', 'value' => 'save', 'disabled' => $readonly]) !!}
                        </div>
                    </div>
                    @endcan
                    @can('role-delete')
                    <div class="column field is-pulled-left">
                        <div class="control">
                            {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-minus"></i></span><span>' . __('message.remove') . '</span>', ['class' => 'button is-danger is-outlined confirmDelete', 'type' => 'submit', 'name' => 'action', 'value' => 'delete', 'disabled' => $readonly]) !!}
                        </div>
                    </div>
                    @endcan
                    <div class="is-clearfix"></div>
                </div>
            @endcanany
        @endif
        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
