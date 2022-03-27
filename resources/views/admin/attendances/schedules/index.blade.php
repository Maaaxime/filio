<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.attendanceSchedulesManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('admin.attendances.schedules.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
            </a>
        </x-slot>

        <div class="list has-hoverable-list-items">
            @foreach ($attendanceSchedules as $attendanceSchedule)
                <div class="list-item">
                    <div class="list-item-content">
                        <div class="list-item-title">
                            {{ $attendanceSchedule->name }} ({{ $attendanceSchedule->time_slot }})
                        </div>
                        <div class="list-item-description">
                            @foreach ($attendanceSchedule->selectedWorkingDays as $workingDay)
                                <span class="tag is-primary is-light">{{ __("message.$workingDay") }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="list-item-controls">
                        <div class="buttons is-right">
                            <a href="{{ route('admin.attendances.schedules.edit', $attendanceSchedule->id) }}"
                                class="button is-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-content-page>
</x-app-layout>
