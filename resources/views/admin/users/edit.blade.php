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

    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'enctype' => 'multipart/form-data']) !!}
    <div class="grid">
        <div>
            @if ($user->image)
            <div class="w-40 h-40 img-circle" style="background-image: url('{{ asset('/storage/images/' . $user->image) }}')"></div>
            @endif
            {{ Form::file('image', null, ['name' => 'image', 'class' => '']) }}
        </div>
        <div>
            <label for="name">
                {{ __('message.name') }}
                {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => '', 'disabled' => $readonly]) !!}
            </label>
            <label for="email">
                {{ __('auth.email') }}
                {!! Form::text('email', null, ['placeholder' => __('auth.email'), 'class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>
    </div>
    <div class="grid">
        <div>
            <label for="password" class="">
                {{ __('auth.password') }}
                {!! Form::password('password', ['placeholder' => __('auth.password'), 'class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>
        <div>
            <label for="confirm-password" class="">
                {{ __('auth.password-confirm') }}
                {!! Form::password('confirm-password', ['placeholder' => __('auth.password-confirm'), 'class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>
    </div>

    <label for="roles">
        {{ __('message.roles') }}
        {!! Form::select('roles[]', $roles, $userRole, ['class' => '', 'multiple', 'disabled' => $readonly]) !!}
    </label>
    @can('user-mngt')
        <div class="grid">
            {!! Form::button('<span class="icon"><i class="gg-remove"></i></span>' . __('message.remove'), ['class' => 'btn-danger', 'type' => 'submit', 'name' => 'action', 'value' => 'delete', 'disabled' => $readonly]) !!}
            {!! Form::button('<span class="icon"><i class="gg-add"></i></span>' . __('message.save'), ['class' => 'btn-success', 'type' => 'submit', 'name' => 'action', 'value' => 'save', 'disabled' => $readonly]) !!}
        </div>
    @endcan
    {!! Form::close() !!}
</x-app-layout>
