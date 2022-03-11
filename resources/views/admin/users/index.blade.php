<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.usersManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ route('users.create') }}">
                <i class="fa-solid fa-circle-plus"></i> {{ __('message.add') }}
            </a>
        </x-slot>

        <div class="table-container pr-2 pl-2">
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">{{ __('message.name') }}</th>
                        <th scope="col">{{ __('message.roles') }}</th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.childs') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td class="is-narrow">
                                @if ($user->image)
                                    <div class="img-circle is-48x48 image"
                                        style="background-image: url('{{ asset('/storage/images/' . $user->image) }}');">
                                    </div>
                                @endif
                            </td>
                            <td class="is-narrow">
                                <a href="{{ route('users.edit', $user->id) }}">
                                    <p class="title is-5">
                                        {{ $user->name }}
                                    </p>
                                    <p class="subtitle is-6">
                                        {{ $user->email }}
                                    </p>
                                </a>

                            </td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    <div class="tags">
                                        @foreach ($user->getRoleNames() as $v)
                                            <span class="tag is-primary is-light">{{ $v }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="is-hidden-touch">
                                @foreach ($user->childs as $child)
                                    @if ($child->image)
                                        <a href="{{ route('childs.show', $child->id) }}">
                                            <div class="image img-circle is-48x48" style="
                                            background-image: url('{{ asset('/storage/images/' . $child->image) }}');
                                            display: inline-block;
                                            margin-left: calc(-7px); margin-right: calc(-7px);
                                            box-shadow: 0 0 0 2px #fff, inset 0 0 0 1px rgb(34 41 47 / 7%);
    cursor: pointer;" data-tooltip="{{ $child->full_name }}">
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $data->links('vendor.pagination.custom') }}
    </x-content-page>
</x-app-layout>
