<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.rolesManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous(); }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::open(['route' => 'roles.store', 'method' => 'POST', 'class' => 'box-no-shadow']) !!}
        {{  Form::hidden('url',URL::previous())  }}
        <div class="field">
            <label class="label">{{ __('message.name') }}</label>
            <div class="control">
                {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => 'input']) !!}
            </div>
        </div>
        <div class="field">
            <p class="title">{{ __('message.roles') }}</p>
            @foreach ($permission as $value)
                <div class="card mb-4">
                    <header class="card-header">
                        <div class="card-header-title">
                            <p class="title is-5">{{ $value->name }}</p>
                            @if ($value->description != '')
                                <p class="subtitle is-6">{{ $value->description }}</p>
                            @endif
                        </div>
                        <span class="card-header-icon" aria-label="more options">
                            {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'checkbox icon']) }}
                        </span>
                    </header>
                </div>
            @endforeach
        </div>

        @can('role-mngt')
            <div class="field is-pulled-right pt-4">
                <div class="control is-pulled-right">
                    {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-plus"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'action', 'value' => 'save']) !!}
                </div>
            </div>
            <div class="is-clearfix"></div>
        @endcan

        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
