<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.rolesManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('admin.roles.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
            </a>
        </x-slot>
        <div class="box-no-shadow">
            <div class="content">
                <div class="list has-hoverable-list-items">
                    @foreach ($roles as $key => $role)
                        <div class="list-item">
                            <div class="list-item-content">
                                <div class="list-item-title">
                                    {{ $role->name }}
                                </div>
                            </div>
                            <div class="list-item-controls">
                                <div class="buttons is-right">
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="button is-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $roles->links('vendor.pagination.custom') }}
            </div>
        </div>
    </x-content-page>
</x-app-layout>
