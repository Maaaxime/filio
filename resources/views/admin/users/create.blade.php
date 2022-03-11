<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.usersManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous(); }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'box-no-shadow']) !!}
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
                                <input class="file-input" type="file" name="image" style="width: 100%;">
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
                                {!! Form::text('name', null, ['placeholder' => __('message.name'), 'class' => 'input']) !!}
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">{{ __('auth.email') }}</label>
                            <div class="control">
                                {!! Form::email('email', null, ['placeholder' => __('auth.email'), 'class' => 'input']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column field">
                        <label class="label">{{ __('auth.password') }}</label>
                        <div class="control">
                            {!! Form::password('password', ['placeholder' => __('auth.password'), 'class' => 'input']) !!}
                        </div>
                    </div>
                    <div class="column field">
                        <label class="label">{{ __('auth.password-confirm') }}</label>
                        <div class="control">
                            {!! Form::password('confirm-password', ['placeholder' => __('auth.password-confirm'), 'class' => 'input']) !!}
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
                                    {!! Form::checkbox('roles[]', $value->name, null, ['class' => 'checkbox icon']) !!}
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
                                            <div class="image img-circle is-48x48"
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
                                {!! Form::checkbox('childs[]', $value->id, null, ['class' => 'checkbox icon']) !!}
                            </span>
                        </header>
                    </div>
                @endforeach
            </section>
        </div>
        @can('user-mngt')
            <div class="field is-pulled-right pt-4">
                <div class="control is-pulled-right">
                    {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-circle-plus"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-success', 'type' => 'submit', 'name' => 'action', 'value' => 'save']) !!}
                </div>
            </div>
            <div class="is-clearfix"></div>
        @endcan
        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
