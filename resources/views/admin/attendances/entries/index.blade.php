<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.attendanceEntriesManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('admin.attendances.entries.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
            </a>
        </x-slot>

        <div class="table-container pr-2 pl-2">
            <table class="table is-striped is-hoverable is-fullwidth sortable-theme-minimal" data-sortable>
                <thead>
                    <tr>
                        <th scope="col" data-sortable="false">{{ __('message.child') }}</th>
                        <th scope="col" class="is-hidden-touch"></th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.user') }}</th>
                        <th scope="col" class="">{{ __('message.attendanceType') }}</th>
                        <th scope="col" class="">{{ __('message.time_start_date') }}</th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.time_start_time') }}</th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.time_end_time') }}</th>
                        <th scope="col" class="has-text-right">{{ __('message.time_duration') }}</th>
                        <th scope="col" class="has-text-centered" data-sortable="false">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendanceEntries as $key => $timeEntry)
                        <tr>
                            <td class="is-narrow">
                                @if ($timeEntry->child->image)
                                    <div class="image is-rounded is-48x48"
                                        style="background-image: url('{{ asset('/storage/images/' . $timeEntry->child->image) }}');">
                                    </div>
                                @endif
                            </td>
                            <td class="is-hidden-touch">
                                {{ $timeEntry->child->full_name }}
                            </td>
                            <td class="is-hidden-touch">
                                {{ $timeEntry->createdby->name }}
                            </td>
                            <td class="">
                                {{ $timeEntry->type->name }}
                            </td>
                            <td class="">
                                {{ $timeEntry->time_start ? $timeEntry->time_start->translatedFormat('d/m/y') : '' }}
                            </td>
                            <td class=" is-hidden-touch">
                                {{ $timeEntry->time_start ? $timeEntry->time_start->translatedFormat('H:i') : '' }}
                            </td>
                            <td class=" is-hidden-touch">
                                {{ $timeEntry->time_end ? $timeEntry->time_end->translatedFormat('H:i') : '' }}
                            </td>
                            <td class="has-text-right">
                                {{ $timeEntry->total_time_hours_string }}
                            </td>
                            <th class="is-narrow" data-sortable="false">
                                <a href="{{ route('admin.attendances.entries.edit', $timeEntry->id) }}"
                                    class="button is-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $attendanceEntries->links('vendor.pagination.custom') }}
    </x-content-page>
</x-app-layout>
