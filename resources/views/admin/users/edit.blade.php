<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.usersManagement') }} : {{ $user->name }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ route('users.index') }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'enctype' => 'multipart/form-data', 'class' => 'box']) !!}
        <div class="pb-6">
            <ul class="steps is-medium is-centered has-content-centered is-horizontal">
                <li class="steps-segment is-active">
                    <a hef="#" class="has-text-dark" aria-controls="tab1-section">
                        <span class="steps-marker">
                            <span class="icon">
                                <i class="fa fa-user"></i>
                            </span>
                        </span>
                        <div class="steps-content">
                            <p class="heading">{{ __('message.general') }}</p>
                        </div>
                    </a>
                </li>
                <li class="steps-segment">
                    <a hef="#" class="has-text-dark" aria-controls="tab2-section">
                        <span class="steps-marker">
                            <span class="icon">
                                <i class="fa-solid fa-id-badge"></i>
                            </span>
                        </span>
                        <div class="steps-content">
                            <p class="heading">{{ __('message.roles') }}</p>
                        </div>
                    </a>
                </li>
                <li class="steps-segment">
                    <a hef="#" class="has-text-dark" aria-controls="tab3-section">
                        <span class="steps-marker">
                            <span class="icon">
                                <i class="fa-solid fa-baby"></i>
                            </span>
                        </span>
                        <div class="steps-content">
                            <p class="heading">{{ __('message.childs') }}</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-panels">
            <section id="tab1-section" class="tab-panel">
                <div class="columns pt-6">
                    <div class="column">
                        <label class="label">{{ __('message.profilePicture') }}</label>
                        <div class="file is-boxed">
                            <label class="file-label" style="width: 100%; height: 100%;">
                                <input class="file-input" type="file" name="image" style="width: 100%;"
                                    @if ($readonly) disabled @endif>
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        {{ __('message.uploadProfilePicture') }}
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">{{ __('message.name') }}</label>
                            <div class="control">
                                {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => 'input', 'disabled' => $readonly]) !!}
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">{{ __('auth.email') }}</label>
                            <div class="control">
                                {!! Form::email('email', null, ['placeholder' => __('auth.email'), 'class' => 'input', 'disabled' => $readonly]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column field">
                        <label class="label">{{ __('auth.password') }}</label>
                        <div class="control">
                            {!! Form::password('password', ['placeholder' => __('auth.password'), 'class' => 'input', 'disabled' => $readonly]) !!}
                        </div>
                    </div>
                    <div class="column field">
                        <label class="label">{{ __('auth.password-confirm') }}</label>
                        <div class="control">
                            {!! Form::password('confirm-password', ['placeholder' => __('auth.password-confirm'), 'class' => 'input', 'disabled' => $readonly]) !!}
                        </div>
                    </div>
                </div>
            </section>
            <section id="tab2-section" class="tab-panel is-hidden">
                <div class="field">
                    <p class="title">{{ __('message.roles') }}</p>
                    @foreach ($roles as $value)
                        <div class="card mb-4">
                            <header class="card-header">
                                <p class="card-header-title">
                                    {{ $value->name }}
                                </p>
                                <span class="card-header-icon" aria-label="more options">
                                    {!! Form::checkbox('roles[]', $value->name, in_array($value->name, $userRole), ['class' => 'checkbox icon', 'disabled' => $readonly]) !!}
                                </span>
                            </header>
                        </div>
                    @endforeach
                </div>
            </section>
            <section id="tab3-section" class="tab-panel is-hidden">
                <p class="title">{{ __('message.childs') }}</p>
                @foreach ($childs as $value)
                    <div class="card mb-4">
                        <header class="card-header mt-4">
                            <table class="table card-header-title">
                                <tr>
                                    <td class="is-narrow">
                                        @if ($value->image)
                                            <div class="img-circle"
                                                style="background-image: url('{{ asset('/storage/images/' . $value->image) }}');">
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $value->full_name }}
                                    </td>
                                </tr>
                            </table>

                            <span class="card-header-icon" aria-label="more options">
                                {!! Form::checkbox('childs[]', $value->id, in_array($value->id, $userChildren), ['class' => 'checkbox icon', 'disabled' => $readonly]) !!}
                            </span>
                        </header>
                    </div>
                @endforeach
            </section>
        </div>

        @if (!$readonly)
            @can('user-mngt')
            <div class="columns is-flex-direction-row-reverse pt-4">
                <div class="column field">
                    <div class="control is-pulled-right">
                        {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-floppy-disk"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-success', 'type' => 'submit', 'name' => 'action', 'value' => 'save', 'disabled' => $readonly]) !!}
                    </div>
                </div>
                <div class="column field is-pulled-left">
                    <div class="control">
                        {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-minus"></i></span><span>' . __('message.remove') . '</span>', ['class' => 'button is-danger is-outlined confirmDelete', 'type' => 'submit', 'name' => 'action', 'value' => 'delete', 'disabled' => $readonly]) !!}
                    </div>
                </div>
                <div class="is-clearfix"></div>
            </div>
            @endcan
        @endif
        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
