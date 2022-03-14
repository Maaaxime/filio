<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.timeEntryTypesManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('types.create') }}" class="button is-primary is-light">
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
                        <th scope="col" class="is-hidden-touch">{{ __('message.timeEntryTypesNeedProof') }}</th>
                        <th scope="col" class="is-hidden-touch">
                            {{ __('message.timeEntryTypesNeedPermission') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timeEntryTypes as $key => $timeEntryType)
                        <tr>
                            <th class="is-narrow" data-sortable="false">
                                <a href="{{ route('types.edit', $timeEntryType->id) }}" class="button is-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </th>
                            <td>
                                {{ $timeEntryType->name }}
                                @if ($timeEntryType->default)
                                    <span
                                        class="tag is-primary is-light">{{ __('message.timeEntryTypesDefault') }}</span>
                                @endif
                            </td>
                            <td class="is-hidden-touch">
                                {{ $timeEntryType->description }}
                            </td>
                            <td class="is-hidden-touch has-text-centered">
                                {{ Form::checkbox('need_proof', null, $timeEntryType->need_proof, ['class' => 'checkbox icon','disabled' => true]) }}
                            </td>
                            <td class="is-hidden-touch has-text-centered">
                                {{ Form::checkbox('need_permission', null, $timeEntryType->need_permission, ['class' => 'checkbox icon','disabled' => true]) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $timeEntryTypes->links('vendor.pagination.custom') }}
    </x-content-page>
</x-app-layout>
