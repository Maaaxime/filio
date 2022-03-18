<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.attendanceEntriesManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::model($timeEntry, ['method' => 'PATCH', 'route' => ['admin.attendances.entries.update', $timeEntry->id], 'class' => 'box-no-shadow']) !!}
        {{ Form::hidden('url', URL::previous()) }}
        <div class="columns">
            <div class="column">
                <div class="field">
                    <label class="label">{{ __('message.child') }}</label>
                    <div class="control select is-fullwidth">
                        {{ Form::select('child', $children, $timeEntry->child_id, ['class' => '', 'disabled' => $readonly]) }}
                    </div>
                </div>
                <div class="field ">
                    <label class="label">{{ __('message.attendanceType') }}</label>
                    <div class="control select is-fullwidth">
                        {{ Form::select('entry_type', $attendanceTypes, $timeEntry->type_id, ['class' => '', 'disabled' => $readonly]) }}
                    </div>
                </div>
                <div class="field">
                    <label class="label">{{ __('message.comment') }}</label>
                    <div class="control">
                        {!! Form::textarea('comment', null, ['class' => 'textarea', 'rows' => 6, 'disabled' => $readonly]) !!}
                    </div>
                </div>
            </div>
            <div class="column columns">
                <div class="column">
                    <div class="field">
                        <label class="label">{{ __('message.time_start_date') }}</label>
                        <div class="control">
                            <input type="text" name="time_start_date" value="{{ $timeEntry->time_start->format('d/m/Y') }}"  id="time_start_date"
                                class="input is-fullwidth js-mini-picker-date sr-only"
                                {{ $readonly ? 'disabled' : '' }}>
                            <div class="js-mini-picker-container" id="time_start_date"></div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label">{{ __('message.time_start_time') }}</label>
                        <div class="control">
                            <input type="time" name="time_start_time" value="{{ $timeEntry->time_start_time }}" id="time_start_time"
                                class="input is-fullwidth js-mini-picker-time sr-only"
                                {{ $readonly ? 'disabled' : '' }}>
                            <div class="js-mini-picker-container" id="time_start_time"></div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">{{ __('message.time_end_time') }}</label>
                        <div class="control">
                            <!-- value="$timeEntry->time_end" -->
                            <input type="time" name="time_end_time" value="{{ $timeEntry->time_end_time }}" id="time_end_time"
                                class="input is-fullwidth js-mini-picker-time sr-only"
                                {{ $readonly ? 'disabled' : '' }}>
                            <div class="js-mini-picker-container" id="time_end_time"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (!$readonly)
            <div class="columns is-flex-direction-row-reverse pt-4">
                <div class="column field is-pulled-right">
                    <div class="control is-pulled-right">
                        {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-floppy-disk"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'action', 'value' => 'save', 'disabled' => $readonly]) !!}
                    </div>
                </div>
                <div class="column field is-pulled-left">
                    <div class="control">
                        {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-minus"></i></span><span>' . __('message.remove') . '</span>', ['class' => 'button is-danger is-outlined confirmDelete', 'type' => 'submit', 'name' => 'action', 'value' => 'delete', 'disabled' => $readonly]) !!}
                    </div>
                </div>
                <div class="is-clearfix"></div>
            </div>
        @endif
        {!! Form::close() !!}
    </x-content-page>
    <x-calendar></x-calendar>
</x-app-layout>
