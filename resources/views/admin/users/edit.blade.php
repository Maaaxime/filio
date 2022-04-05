<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ $user->name }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>
        <x-slot name="headerPicture">{{ $user->image }}</x-slot>
        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['admin.users.update', $user->id], 'enctype' => 'multipart/form-data', 'class' => 'box-no-shadow']) !!}
        {{ Form::hidden('url', URL::previous()) }}
        <div class="pb-6 sticky">
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
                            <p class="heading">{{ __('message.children') }}</p>
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
                        <div class="file is-normal is-boxed has-name is-fullwidth" id="file">
                            <label class="file-label">
                                <input class="file-input" type="file" name="image"
                                    @if ($readonly) disabled @endif>
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label has-text-centered">
                                        {{ __('message.uploadProfilePicture') }}
                                    </span>
                                </span>
                                <span class="file-name" style="min-width: 100%;">
                                    {{ $user->image }}
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
                    <div class="list has-visible-pointer-controls has-hoverable-list-items">
                        @foreach ($roles as $role)
                            <div class="list-item">
                                <div class="list-item-content">
                                    <div class="list-item-title">
                                        {{ $role->name }}
                                    </div>
                                </div>
                                <div class="list-item-controls">
                                    {!! Form::checkbox('roles[]', $role->name, in_array($role->name, $userRole), ['class' => 'checkbox icon', 'disabled' => $readonly]) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="tab3-section" class="tab-panel is-hidden">
                <p class="title">{{ __('message.children') }}</p>
                <div class="list has-visible-pointer-controls has-hoverable-list-items">
                    @foreach ($children as $child)
                        <div class="list-item">
                            <div class="list-item-image">
                                @if ($child->image)
                                    <div class="image is-rounded is-48x48"
                                        style="background-image: url('{{ asset('/storage/images/' . $child->image) }}');">
                                    </div>
                                @endif
                            </div>
                            <div class="list-item-content">
                                <div class="list-item-title">
                                    {{ $child->full_name }}</div>
                                <div class="list-item-description is-grouped is-grouped-multiline">
                                    <div class="field is-grouped is-grouped-multiline">
                                        @if ($child->remainingDaysBeforeBirthday())
                                            <div class="control">
                                                <div class="tags has-addons is-rounded">
                                                    <span class="tag is-primary is-light">
                                                        <i class="fa-solid fa-cake-candles"></i>
                                                    </span>
                                                    <span class="tag is-primary is-light" style="min-width: 47px;">
                                                        {{ __('message.days') . $child->remainingDaysBeforeBirthday() }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="list-item-controls">
                                {!! Form::checkbox('children[]', $child->id, in_array($child->id, $userChildren), ['class' => 'checkbox icon is-right', 'disabled' => $readonly]) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
        @if (!$readonly)
            <div class="columns is-flex-direction-row-reverse pt-4">
                <div class="column field is-pulled-right">
                    <div class="control is-pulled-right">
                        {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-floppy-disk"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'action', 'value' => 'save', 'disabled' => $readonly]) !!}
                    </div>
                </div>
                <div class="column field is-pulled-left">
                    <div class="control">
                        {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-minus"></i></span><span>' . __('message.remove') . '</span>', ['class' => 'button is-danger is-outlined confirmDelete', 'type' => 'submit', 'name' => 'action', 'value' => 'delete', 'disabled' => $readonly]) !!}
                    </div>
                </div>
                <div class="is-clearfix"></div>
            </div>
        @endif
        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
