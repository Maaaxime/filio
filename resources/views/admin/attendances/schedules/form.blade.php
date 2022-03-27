<x-app-layout>
    <x-content-page>
        <x-slot name="header">
            {{ __('message.attendanceSchedulesManagement') .($attendanceSchedule->name ? ' : ' . $attendanceSchedule->name : '') }}
        </x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::model($attendanceSchedule, ['method' => $methodName, 'route' => [$actionRoute, $attendanceSchedule->id], 'class' => 'box-no-shadow']) !!}
        {{ Form::hidden('url', URL::previous()) }}
        <div class="pb-6 sticky">
            <ul class="steps is-medium is-centered has-content-centered is-horizontal">
                <li class="steps-segment is-active">
                    <a hef="#" class="has-text-dark" aria-controls="tab1-section">
                        <span class="steps-marker">
                            <span class="icon">
                                <i class="fa-solid fa-gears"></i>
                            </span>
                        </span>
                        <div class="steps-content">
                            <p class="heading">{{ __('message.general') }}</p>
                        </div>
                    </a>
                </li>
                <li class="steps-segment">
                    <a hef="#" class="has-text-dark" aria-controls="tab2-section">
                        <span class="steps-marker">
                            <span class="icon">
                                <i class="fa-solid fa-umbrella-beach"></i>
                            </span>
                        </span>
                        <div class="steps-content">
                            <p class="heading">{{ __('message.closingDays') }}</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-panels">
            <section id="tab1-section" class="tab-panel">
                <div class="field">
                    <label class="label">{{ __('message.name') }}</label>
                    <div class="control">
                        {!! Form::text('name', null, ['class' => 'input', 'disabled' => $readonly]) !!}
                    </div>
                </div>
                <div class="columns">
                    <div class="field column">
                        <label class="label">{{ __('message.default_time_start') }}</label>
                        <div class="control">
                            {!! Form::time('default_time_start', null, ['class' => 'input', 'disabled' => $readonly]) !!}
                        </div>
                    </div>
                    <div class="field column">
                        <label class="label">{{ __('message.default_time_end') }}</label>
                        <div class="control">
                            {!! Form::time('default_time_end', null, ['class' => 'input', 'disabled' => $readonly]) !!}
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="pb-2">
                        <div class="is-pulled-left">
                            <p class="label">{{ __('message.openingDays') }}</p>
                        </div>
                        <div class="is-pulled-right">
                            <p class="">
                                <a OnClick='$(".checkbox-workingDay").prop("checked", true);'>Sélectionner
                                    tout</a> /
                                <a
                                    OnClick='$(".checkbox-workingDay").each(function (){$(this).prop("checked", !($(this).prop("checked"))); });'>Inverser</a>
                            </p>
                        </div>
                        <div class="is-clearfix"></div>
                    </div>
                    <div class="list has-visible-pointer-controls has-hoverable-list-items">
                        @foreach (App\Models\AttendanceSchedule::workingDays as $i => $workingDay)
                            <div class="list-item">
                                <div class="list-item-content">
                                    <div class="list-item-title">
                                        {{ __("message.$workingDay") }}
                                    </div>
                                </div>
                                <div class="list-item-controls">
                                    {{ Form::checkbox('workingDays[]',$workingDay,in_array(App\Models\AttendanceSchedule::workingDays[$i], $attendanceSchedule->selectedWorkingDays),['id' => $workingDay, 'class' => 'checkbox icon checkbox-workingDay', 'disabled' => $readonly]) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="tab2-section" class="tab-panel is-hidden">
                <p class="label">{{ __('message.closingDays') }}</p>
                <div class="box notification">

                    <div class="field">
                        <label class="label">{{ __('message.date') }}</label>
                        <div class="control">
                            <input type="date" name="scheduleEntry-date" id="scheduleEntry-date" class="input">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">{{ __('message.name') }}</label>
                        <div class="control">
                            <input type="text" name="scheduleEntry-name" id="scheduleEntry-name" class="input">
                        </div>
                    </div>
                    <div>
                        <div class="is-pulled-left">
                            <button type="button" onClick="importJson('France')" class="button is-primary is-light"
                                data-value="create">
                                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span>
                                {{ __('message.importFrance') }}
                            </button>
                            <button type="button" onClick="importJson('Alsace')" class="button is-primary is-light"
                                data-value="create">
                                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span>
                                {{ __('message.importAlsace') }}
                            </button>
                        </div>
                        <div class="is-pulled-right">
                            <button type="button" onClick="addScheduleEntry()" class="button is-primary is-light"
                                data-value="create">
                                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span>
                                {{ __('message.add') }}
                            </button>
                        </div>
                        <div class="is-clearfix"></div>
                    </div>
                </div>
                <div class="list has-hoverable-list-items" id="scheduleEntry-list">
                    @include('admin.attendances.schedules.entries')
                </div>
            </section>
        </div>
        @if (!$readonly)
            <div class="columns is-flex-direction-row-reverse pt-4">
                <div class="column field is-pulled-right">
                    <div class="control is-pulled-right">
                        {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-floppy-disk"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'action', 'value' => 'save', 'disabled' => $readonly]) !!}
                    </div>
                </div>
                @if ($attendanceSchedule->id)
                    <div class="column field is-pulled-left">
                        <div class="control">
                            {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-minus"></i></span><span>' . __('message.remove') . '</span>', ['class' => 'button is-danger is-outlined confirmDelete', 'type' => 'submit', 'name' => 'action', 'value' => 'delete', 'disabled' => $readonly]) !!}
                        </div>
                    </div>
                @endif
                <div class="is-clearfix"></div>
            </div>
        @endif
        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
