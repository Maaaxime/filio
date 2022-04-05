<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.attendanceTypesManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('admin.attendances.types.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
            </a>
        </x-slot>
        <div class="box-no-shadow">
            <div class="content">
                <div class="list has-hoverable-list-items">
                    @foreach ($attendanceTypes as $key => $attendanceType)
                        <div class="list-item">
                            <div class="list-item-content">
                                <div class="list-item-title">
                                    <span class="mx-1 px-1" style="color: {{ $attendanceType->font_color }}; background-color:{{ $attendanceType->background_color }}; text-align: center;
                                line-height: 2em;">&#9632;</span>
                                    {{ $attendanceType->name }}
                                    @if ($attendanceType->default)
                                        <span
                                            class="tag is-primary is-light">{{ __('message.attendanceTypeDefault') }}</span>
                                    @endif
                                </div>
                                <div class="list-item-description">{{ $attendanceType->description }}</div>
                            </div>
                            <div class="list-item-controls">
                                <div class="buttons is-right">
                                    <a href="{{ route('admin.attendances.types.edit', $attendanceType->id) }}"
                                        class="button is-primary" data-tooltip="{{ __('message.edit') }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{ $attendanceTypes->links('vendor.pagination.custom') }}
    </x-content-page>
</x-app-layout>
