<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.attendanceTypesManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('admin.attendances.types.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
            </a>
        </x-slot>

        <div class="list has-hoverable-list-items">
            @foreach ($attendanceTypes as $key => $attendanceType)
                <div class="list-item">
                    <div class="list-item-content">
                        <div class="list-item-title">
                            {{ $attendanceType->name }}
                            @if ($attendanceType->default)
                                <span class="tag is-primary is-light">{{ __('message.attendanceTypeDefault') }}</span>
                            @endif
                        </div>
                        <div class="list-item-description">{{ $attendanceType->description }}</div>
                    </div>
                    <div class="list-item-controls">
                        <div class="buttons is-right">
                            <a href="{{ route('admin.attendances.types.edit', $attendanceType->id) }}"
                                class="button is-primary">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $attendanceTypes->links('vendor.pagination.custom') }}
    </x-content-page>
</x-app-layout>
