<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.rolesManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ route('roles.create') }}">
                <i class="fa-solid fa-circle-plus"></i> {{ __('message.add') }}
            </a>
        </x-slot>

        <div class="table-container pr-2 pl-2">
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th scope="col">{{ __('message.name') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td class="is-narrow">
                                <a href="{{ route('roles.edit', $role->id) }}">
                                    <p class="title is-5">
                                        {{ $role->name }}
                                    </p>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $roles->links('vendor.pagination.custom') }}
    </x-content-page>
</x-app-layout>
