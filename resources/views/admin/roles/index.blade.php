<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('message.rolesManagement') }}
        </h2>
    </x-slot>

    <x-banner />

    <div>
        @can('user-mngt')
            <a class="btn-icon btn-success" href="{{ route('roles.create') }}" role="button">
                {{ __('message.add') }}
                <i class="gg-file-add"></i>
            </a>
        @endcan
    </div>

    <table role="grid">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('message.name') }}</th>
                <th scope="col">{{ __('message.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key => $role)
                <tr>
                    <th scope="row">{{ $role->id }}</th>
                    <td>
                        <a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a>
                    </td>
                    <td>
                        @can('role-mngt')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                            <div class="grid">
                                <div><a href="{{ route('roles.edit', $role->id) }}" role="button"
                                        class="btn-icon btn-info">{{ __('message.edit') }} <i class="gg-file-document"></i></a></div>
                                <div>
                                    {!! Form::button(__('message.remove') . '<i class="gg-file-remove"></i>', ['class' => 'btn-icon btn-danger contrast', 'type' => 'submit']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $roles->render() !!}

</x-app-layout>
