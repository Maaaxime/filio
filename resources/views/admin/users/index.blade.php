<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.usersManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('admin.users.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
            </a>
        </x-slot>

        <div class="table-container pr-2 pl-2">
            <table class="table is-striped is-hoverable is-fullwidth" data-sortable>
                <thead>
                    <tr>
                        <th scope="col" class="has-text-centered is-narrow" data-sortable="false">#</th>
                        <th scope="col">{{ __('message.name') }}</th>
                        <th scope="col"></th>
                        <th scope="col">{{ __('message.roles') }}</th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.children') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                        <tr>
                            <th class="is-narrow" data-sortable="false">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="button is-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </th>
                            <td class="is-narrow">
                                @if ($user->image)
                                    <div class="image is-rounded is-48x48 image"
                                        style="background-image: url('{{ asset('/storage/images/' . $user->image) }}');">
                                    </div>
                                @endif
                            </td>
                            <td>
                                <p>
                                    {{ $user->name }}
                                </p>
                                <p class="is-size-7">
                                    {{ $user->email }}
                                </p>
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
                                @foreach ($user->children as $child)
                                    @if ($child->image)
                                        <a href="{{ route('admin.children.show', $child->id) }}">
                                            <div class="image is-rounded img-multi is-48x48"
                                                style="background-image: url('{{ asset('/storage/images/' . $child->image) }}');"
                                                data-tooltip="{{ $child->full_name }}">
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
