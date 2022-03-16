<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.attendanceTypesManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('admin.attendances.types.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
            </a>
        </x-slot>

        <div class="table-container pr-2 pl-2">
            <table class="table is-striped is-hoverable is-fullwidth" data-sortable>
                <thead>
                    <tr>
                        <th scope="col" class="has-text-centered is-narrow" data-sortable="false">#</th>
                        <th scope="col">{{ __('message.name') }}</th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.description') }}</th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.attendanceTypeNeedProof') }}</th>
                        <th scope="col" class="is-hidden-touch">
                            {{ __('message.attendanceTypeNeedPermission') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendanceTypes as $key => $attendanceType)
                        <tr>
                            <th class="is-narrow" data-sortable="false">
                                <a href="{{ route('admin.attendances.types.edit', $attendanceType->id) }}" class="button is-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </th>
                            <td>
                                {{ $attendanceType->name }}
                                @if ($attendanceType->default)
                                    <span
                                        class="tag is-primary is-light">{{ __('message.attendanceTypeDefault') }}</span>
                                @endif
                            </td>
                            <td class="is-hidden-touch">
                                {{ $attendanceType->description }}
                            </td>
                            <td class="is-hidden-touch has-text-centered">
                                {{ Form::checkbox('need_proof', null, $attendanceType->need_proof, ['class' => 'checkbox icon','disabled' => true]) }}
                            </td>
                            <td class="is-hidden-touch has-text-centered">
                                {{ Form::checkbox('need_permission', null, $attendanceType->need_permission, ['class' => 'checkbox icon','disabled' => true]) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $attendanceTypes->links('vendor.pagination.custom') }}
    </x-content-page>
</x-app-layout>
