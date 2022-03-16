<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.usersManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('admin.users.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
            </a>
        </x-slot>

        <div>
            {!! Form::open(['route' => 'admin.users.index.filtered', 'method' => 'POST', 'class' => 'box-no-shadow']) !!}
            <div class="buttons has-addons is-centered">
                <button type="submit" class="button {{ (($filter == 'all') || ($filter == '')) ? 'is-primary is-selected' : '' }}"
                    name="action" value="all">
                    <span>{{ __('message.allUsers') }}</span>
                </button>
                @foreach ($roles as $key => $role)
                    <button type="submit" class="button {{ $filter == $role->name ? 'is-primary is-selected' : '' }}"
                        name="action" value="{{ $role->name }}">
                        <span>{{ $role->name . ' (' . $role->users()->count() . ')' }}</span>
                    </button>
                @endforeach
            </div>
            {!! Form::close() !!}
            <div class="list has-hoverable-list-items">
                @foreach ($users as $key => $user)
                    <div class="list-item">
                        <div class="list-item-image">
                            @if ($user->image)
                                <div class="image is-rounded is-48x48"
                                    style="background-image: url('{{ asset('/storage/images/' . $user->image) }}');">
                                </div>
                            @endif
                        </div>

                        <div class="list-item-content">
                            <div class="list-item-title">{{ $user->name }}</div>
                            <div class="list-item-description">{{ $user->email }}</div>
                        </div>
                        <div class="list-item-content is-inline-block is-hidden-touch">
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
                        </div>
                        <div class="list-item-controls">
                            <div class="buttons is-right">
                                <a href="mailto:{{ $user->email }}" class="button is-primary">
                                    <i class="fa-solid fa-envelope"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="button is-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-content-page>
</x-app-layout>
