<x-app-layout>
    <x-slot name="header">
        <hgroup>
            <h2 class="">
                {{ __('message.usersManagement') }}
            </h2>
            <h3>
                <a href="{{ route('users.create') }}">
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
                    <th scope="col">{{ __('message.roles') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>
                            <div class="grid flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if ($user->image)
                                        <div class="w-10 h-10 img-circle"
                                            style="background-image: url('{{ asset('/storage/images/' . $user->image) }}')">
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <a
                                        href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a><br /><small>{{ $user->email }}</small>
                                </div>
                            </div>

                        </td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="badge rounded-pill btn-info">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </figure>
    {{ $data->links('vendor.pagination.custom') }}

</x-app-layout>
