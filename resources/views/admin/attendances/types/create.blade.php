<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.attendanceTypesManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::open(['route' => 'admin.attendances.types.store', 'method' => 'POST', 'class' => 'box-no-shadow']) !!}
        {{  Form::hidden('url',URL::previous())  }}
        <div class="field">
            <label class="label">{{ __('message.name') }}</label>
            <div class="control">
                {!! Form::text('name', null, ['class' => 'input']) !!}
            </div>
        </div>

        <div class="field">
            <label class="label">{{ __('message.description') }}</label>
            <div class="control">
                {!! Form::textarea('description', null, ['class' => 'textarea', 'rows' => 2]) !!}
            </div>
        </div>
        <div class="field">
            <label class="label">{{ __('message.color') }}</label>
            <div class="control select">
                {!! Form::select('color', collect($attendanceType->colors)->pluck("name"), old($attendanceType->color), ['class' => '','disabled' => $readonly]) !!}
            </div>
        </div>
        <div class="field">
            <label class="checkbox">
                {{ Form::checkbox('default', null, false, ['class' => 'checkbox icon']) }}
                {{ __('message.attendanceTypeDefault') }}
            </label>
        </div>
        <div class="field">
            <label class="checkbox">
                {{ Form::checkbox('need_proof', null, false, ['class' => 'checkbox icon']) }}
                {{ __('message.attendanceTypeNeedProof') }}
            </label>
        </div>
        <div class="field">
            <label class="checkbox">
                {{ Form::checkbox('need_permission', null, false, ['class' => 'checkbox icon']) }}
                {{ __('message.attendanceTypeNeedPermission') }}
            </label>
        </div>
        <div class="field is-pulled-right pt-4">
            <div class="control is-pulled-right">
                {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-plus"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'action', 'value' => 'save']) !!}
            </div>
        </div>
        <div class="is-clearfix"></div>
        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
