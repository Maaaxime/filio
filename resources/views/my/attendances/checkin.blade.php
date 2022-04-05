<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.attendanceCheckIn') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>
        {!! Form::open(['route' => 'user.attendances.checkin.store', 'method' => 'POST', 'class' => 'box-no-shadow']) !!}
        {{ Form::hidden('url', URL::previous()) }}
        {{ Form::hidden('time_start_date', \Carbon\Carbon::now()->format('Y-m-d')) }}
        <div class="columns">
            <div class="column">
                <div class="field">
                    <label class="label">{{ __('message.child') }}</label>
                    <div class="control select is-fullwidth">
                        {{ Form::select('child', $children, null, ['class' => '']) }}
                    </div>
                </div>
                <div class="field ">
                    <label class="label">{{ __('message.attendanceType') }}</label>
                    <div class="control select is-fullwidth">
                        {{ Form::select('entry_type', $attendanceTypes, null, ['class' => '']) }}
                    </div>
                </div>
                <div class="field">
                    <label class="label">{{ __('message.time_start_date') }}</label>
                    <div class="control">
                        <input type="text" name="time_start_date" id="time_start_date"
                            value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}"
                            class="input is-fullwidth js-mini-picker-date sr-only" disabled>
                        <div class="js-mini-picker-container" id="time_start_date"></div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">{{ __('message.time_start_time') }}</label>
                    <div class="control">
                        <input type="time" name="time_start_time" value="{{ \Carbon\Carbon::now()->format('H:i') }}"
                            id="time_start_time" max="{{ \Carbon\Carbon::now()->format('H:i') }}" max="23:59"
                            class="input is-fullwidth js-mini-picker-time sr-only">
                        <div class="js-mini-picker-container" id="time_start_time"></div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="field" style="height: 90%;">
                    <label class="label">{{ __('message.comment') }}</label>
                    <div class="control" style="height: 100%;">
                        {!! Form::textarea('comment', null, ['class' => 'textarea', 'rows' => 2, 'style' => 'height: 100%;']) !!}
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
