<x-app-layout>
    <x-slot name="header">
        <hgroup>
            <h2 class="">
                {{ __('message.usersManagement') }}
            </h2>
            <h3>
                <a href="{{ route('users.index') }}">
                    <span class="icon"><i class="gg-arrow-left-o"></i></span>{{ __('message.back') }}
                </a>
            </h3>
        </hgroup>
    </x-slot>

    <x-banner />

    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
    <div class="tabset">
        <!-- Tab 1 -->
        <input type="radio" name="tabset" id="tab1" aria-controls="tab1-section" checked>
        <label for="tab1">{{ __('message.general') }}</label>
        <!-- Tab 2 -->
        <input type="radio" name="tabset" id="tab2" aria-controls="tab2-section">
        <label for="tab2">{{ __('message.rolesManagement') }}</label>
        <!-- Tab 3 -->
        <input type="radio" name="tabset" id="tab3" aria-controls="tab3-section">
        <label for="tab3">{{ __('message.childsManagement') }}</label>
        <div class="tab-panels">
            <section id="tab1-section" class="tab-panel">
                <label for="name">
                    {{ __('message.name') }}
                    {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => '']) !!}
                </label>
                <label for="email">
                    {{ __('auth.email') }}
                    {!! Form::text('email', null, ['placeholder' => __('auth.email'), 'class' => '']) !!}
                </label>
                <div class="grid">
                    <div>
                        <label for="password" class="">
                            {{ __('auth.password') }}
                            {!! Form::password('password', ['placeholder' => __('auth.password'), 'class' => '']) !!}
                        </label>
                    </div>
                    <div>
                        <label for="confirm-password" class="">
                            {{ __('auth.password-confirm') }}
                            {!! Form::password('confirm-password', ['placeholder' => __('auth.password-confirm'), 'class' => '']) !!}
                        </label>
                    </div>
                </div>
            </section>
            <section id="tab2-section" class="tab-panel">
                <fieldset>
                    <legend>{{ __('message.roles') }}</legend>
                    @foreach ($roles as $value)
                        <label for="{{ $value->name }}">
                            {!! Form::checkbox('roles[]', $value->name, [], ['class' => '']) !!}
                            {{ $value->name }}
                        </label>
                    @endforeach
                </fieldset>
            </section>
            <section id="tab3-section" class="tab-panel">
                <fieldset>
                    <legend>{{ __('message.childs') }}</legend>
                    @foreach ($childs as $value)
                        <label for="{{ $value->id }}">
                            {!! Form::checkbox('childs[]', $value->id, [], ['class' => '']) !!}
                            {{ $value->full_name }}
                        </label>
                    @endforeach
                </fieldset>
            </section>
            {!! Form::button('<span class="icon"><i class="gg-add"></i></span>' . __('message.save'), ['class' => 'btn-success', 'type' => 'submit', 'name' => 'action', 'value' => 'save']) !!}
            {!! Form::close() !!}
</x-app-layout>
