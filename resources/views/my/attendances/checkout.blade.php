<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.attendanceCheckOut') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::model($attendanceEntry, ['method' => 'PATCH', 'route' => ['user.attendances.checkout.store', $attendanceEntry->id], 'class' => 'box-no-shadow']) !!}
        {{ Form::hidden('url', URL::previous()) }}
        <div class="columns">
            <div class="column">
                <div class="field">
                    <label class="label">{{ __('message.child') }}</label>
                    <div class="control">
                        {{ Form::hidden('child', $attendanceEntry->child->id) }}
                        {{ Form::text('child-show', $attendanceEntry->child->full_name, ['class' => 'input', 'disabled' => true]) }}
                    </div>
                </div>
                <div class="field ">
                    <label class="label">{{ __('message.attendanceType') }}</label>
                    <div class="control">
                        {{ Form::hidden('entry_type', $attendanceEntry->type->id) }}
                        {{ Form::text('entry_type-show', $attendanceEntry->type->name, ['class' => 'input', 'disabled' => true]) }}
                    </div>
                </div>
                <div class="field">
                    <label class="label">{{ __('message.time_start_date') }}</label>
                    <div class="control">
                        {{ Form::text('time_start_date', $attendanceEntry->time_start->format('d/m/Y'), ['id' => 'time_start_date', 'class' => 'input is-fullwidth js-mini-picker-date sr-only disabled','disabled' => true]) }}
                        <div class="js-mini-picker-container" id="time_start_date"></div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">{{ __('message.time_start_time') }}</label>
                    <div class="control">
                        {{ Form::time('time_start_time', $attendanceEntry->time_start_time, ['id' => 'time_start_time', 'class' => 'input is-fullwidth js-mini-picker-time sr-only disabled','disabled' => true]) }}
                        <div class="js-mini-picker-container" id="time_start_time"></div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">{{ __('message.time_end_time') }}</label>
                    <div class="control">
                        <input type="time" name="time_end_time" value="{{ \Carbon\Carbon::now()->format('H:i') }}"  id="time_end_time"
                            min="{{ \Carbon\Carbon::now()->format('H:i') }}"
                            class="input is-fullwidth js-mini-picker-time sr-only">
                        <div class="js-mini-picker-container" id="time_end_time"></div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="field" style="height: 95%;">
                    <label class="label">{{ __('message.comment') }}</label>
                    <div class="control" style="height: 100%;">
                        {!! Form::textarea('comment', $attendanceEntry->comment, ['class' => 'textarea', 'rows' => 2, 'style' => 'height: 100%;']) !!}
                    </div>
                </div>
            </div>

        </div>
        <div class="field is-pulled-right pt-4">
            <div class="control is-pulled-right">
                {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-plus"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'action', 'value' => 'save']) !!}
            </div>
        </div>
        <div class="is-clearfix"></div>
        {!! Form::close() !!}
    </x-content-page>
    <x-calendar></x-calendar>
</x-app-layout>
