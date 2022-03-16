<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.attendanceEntriesManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::open(['route' => 'admin.attendances.entries.store', 'method' => 'POST', 'class' => 'box-no-shadow']) !!}
        {{ Form::hidden('url', URL::previous()) }}
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
                    <label class="label">{{ __('message.comment') }}</label>
                    <div class="control">
                        {!! Form::textarea('comment', null, ['class' => 'textarea', 'rows' => 6]) !!}
                    </div>
                </div>
            </div>
            <div class="column columns">
                <div class="column">
                    <div class="field">
                        <label class="label">{{ __('message.time_start_date') }}</label>
                        <div class="control">
                            <input type="date" name="time_start_date"
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                class="input is-fullwidth bulma-calendar-date bulma-calendar">
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label">{{ __('message.time_start_time') }}</label>
                        <div class="control">
                            <input type="time" name="time_start_time"
                                value="{{ App\Models\AttendanceEntry::defaultStartTime()->format('H:i') }}"
                                class="input is-fullwidth bulma-calendar-time bulma-calendar">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">{{ __('message.time_end_time') }}</label>
                        <div class="control">
                            <!-- value="$timeEntry->time_end" -->
                            <input type="time" name="time_end_time"
                                value="{{ App\Models\AttendanceEntry::defaultEndTime()->format('H:i') }}"
                                class="input is-fullwidth bulma-calendar-time bulma-calendar">
                        </div>
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
