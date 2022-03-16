<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.rolesManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::open(['route' => 'admin.roles.store', 'method' => 'POST', 'class' => 'box-no-shadow']) !!}
        {{ Form::hidden('url', URL::previous()) }}
        <div class="field">
            <label class="label">{{ __('message.name') }}</label>
            <div class="control">
                {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => 'input']) !!}
            </div>
        </div>
        <div class="field">
            <div class="pb-2">
                <div class="is-pulled-left">
                    <p class="label">{{ __('message.roles') }}</p>
                </div>
                <div class="is-pulled-right">
                    <p class="">
                        <a OnClick='$(".checkbox-permission").prop("checked", true);'>Sélectionner
                            tout</a> /
                        <a
                            OnClick='$(".checkbox-permission").each(function (){$(this).prop("checked", !($(this).prop("checked"))); });'>Inverser</a>
                    </p>
                </div>
                <div class="is-clearfix"></div>
            </div>
            <div class="list has-visible-pointer-controls has-hoverable-list-items">
                @foreach ($permissions as $permission)
                    <div class="list-item">
                        <div class="list-item-content">
                            <div class="list-item-title">
                                {{ $permission->name }}
                            </div>
                        </div>
                        <div class="list-item-controls">
                            {{ Form::checkbox('permission[]', $permission->id, false, ['class' => 'checkbox-permission checkbox icon']) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @canany(['role-create', 'role-update'])
            <div class="field is-pulled-right pt-4">
                <div class="control is-pulled-right">
                    {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-plus"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'action', 'value' => 'save']) !!}
                </div>
            </div>
            <div class="is-clearfix"></div>
        @endcanany
        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
