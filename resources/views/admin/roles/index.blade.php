<x-app-layout>
    <x-slot name="header">
        <hgroup>
            <h2 class="">
                {{ __('message.rolesManagement') }}
            </h2>
            <h3>
                <a href="{{ route('roles.create') }}">
                    <span class="icon"><i class="gg-add"></i></span>{{ __('message.add') }}
                </a>
            </h3>
        </hgroup>
    </x-slot>

    <x-banner />

    <table role="grid">
        <thead>
            <tr>
                <th scope="col" class="w-10">#</th>
                <th scope="col">{{ __('message.name') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key => $role)
                <tr>
                    <th scope="row">
                        <a href="{{ route('roles.edit', $role->id) }}">
                            {{ $role->id }}
                        </a>
                    </th>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}">{{ $role->name }}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $roles->links('vendor.pagination.custom') }}

</x-app-layout>
