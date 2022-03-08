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
    <figure>
        <table role="grid">
            <thead>
                <tr>
                    <th scope="col">{{ __('message.name') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $key => $role)
                    <tr>
                        <td>
                            <a href="{{ route('roles.edit', $role->id) }}">{{ $role->name }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </figure>
    {{ $roles->links('vendor.pagination.custom') }}

</x-app-layout>
