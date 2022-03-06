<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('message.usersManagement') }}
        </h2>
    </x-slot>

    <x-banner />

    <div>
        @can('user-mngt')
            <a class="btn-icon btn-success" href="{{ route('users.create') }}" role="button">
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
                <th scope="col">{{ __('message.roles') }}</th>
                <th scope="col">{{ __('message.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>
                        <div class="grid flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 img-circle"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                alt="">
                            </div>
                            <div>
                                <a href="{{ route('users.show',$user->id) }}">{{ $user->name }}</a><br /><small>{{ $user->email }}</small>
                            </div>
                        </div>
                        
                    </td>
                    <td>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @can('user-mngt')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                            <div class="grid">
                                <div><a href="{{ route('users.edit', $user->id) }}" role="button"
                                        class="btn-icon btn-info">{{ __('message.edit') }} <i class="gg-file-document"></i></a></div>
                                <div>
                                    {!! Form::button( __('message.remove') . ' <i class="gg-file-remove"></i>', ['class' => 'btn-icon btn-danger contrast', 'type' => 'submit']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $data->render() !!}

</x-app-layout>
