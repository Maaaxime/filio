<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.rolesManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('admin.roles.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
            </a>
        </x-slot>

        <div class="table-container pr-2 pl-2">
            <table class="table is-striped is-hoverable is-fullwidth" data-sortable>
                <thead>
                    <tr>
                        <th scope="col" class="has-text-centered is-narrow" data-sortable="false">#</th>
                        <th scope="col">{{ __('message.name') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <th class="is-narrow" data-sortable="false">
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="button is-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </th>
                            <td>
                                {{ $role->name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $roles->links('vendor.pagination.custom') }}
    </x-content-page>
</x-app-layout>
