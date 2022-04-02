<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.childrenManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>

        {!! Form::open(['route' => 'admin.children.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'box-no-shadow']) !!}
        {{ Form::hidden('url', URL::previous()) }}
        <div class="pb-6 sticky">
            <ul class="steps is-medium is-centered has-content-centered is-horizontal">
                @can('child.read-general')
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
                @endcan
                @can('child.read-medical')
                    <li class="steps-segment">
                        <a hef="#" class="has-text-dark" aria-controls="tab2-section">
                            <span class="steps-marker">
                                <span class="icon">
                                    <i class="fa-solid fa-briefcase-medical"></i>
                                </span>
                            </span>
                            <div class="steps-content">
                                <p class="heading">{{ __('message.medical') }}</p>
                            </div>
                        </a>
                    </li>
                @endcan
                @can('child.read-family')
                    <li class="steps-segment">
                        <a hef="#" class="has-text-dark" aria-controls="tab3-section">
                            <span class="steps-marker">
                                <span class="icon">
                                    <i class="fa-solid fa-heart"></i>
                                </span>
                            </span>
                            <div class="steps-content">
                                <p class="heading">{{ __('message.family_situation') }}</p>
                            </div>
                        </a>
                    </li>
                @endcan
                @can('child.read-contract')
                    <li class="steps-segment">
                        <a hef="#" class="has-text-dark" aria-controls="tab4-section">
                            <span class="steps-marker">
                                <span class="icon">
                                    <i class="fa-solid fa-file-signature"></i>
                                </span>
                            </span>
                            <div class="steps-content">
                                <p class="heading">{{ __('message.contract') }}</p>
                            </div>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <div class="tab-panels">
            @can('child.read-general')
                <section id="tab1-section" class="tab-panel">
                    <div class="columns pt-6">
                        <div class="column">
                            <label class="label">{{ __('message.profilePicture') }}</label>
                            <div class="file is-normal is-boxed has-name is-fullwidth" id="file">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="image" id="file">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                        <span class="file-label has-text-centered">
                                            {{ __('message.uploadProfilePicture') }}
                                        </span>
                                    </span>
                                    <span class="file-name" style="min-width: 100%;">

                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">{{ __('message.first_name') }}</label>
                                <div class="control">
                                    {!! Form::text('first_name', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.last_name') }}</label>
                                <div class="control">
                                    {!! Form::text('last_name', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.gender') }}</label>
                                <div class="control">
                                    <label class="radio">
                                        <input type="radio" name="gender" value="0" checked>
                                        {{ __('message.girl') }}
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="gender" value="1">
                                        {{ __('message.boy') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column field">
                            <label class="label">{{ __('message.birthdate') }}</label>
                            <div class="control">
                                {!! Form::date('birthdate', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                        <div class="column field">
                            <label class="label">{{ __('message.city_of_birth') }}</label>
                            <div class="control">
                                {!! Form::text('city_of_birth', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column field">
                            <label class="label">{{ __('message.phone_no') }}</label>
                            <div class="control">
                                {!! Form::text('phone_no', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                        <div class="column field">
                            <label class="label">{{ __('message.email') }}</label>
                            <div class="control">
                                {!! Form::email('email', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">{{ __('message.address') }}</label>
                        <div class="control">
                            {!! Form::text('address', null, ['class' => 'input']) !!}
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">{{ __('message.address2') }}</label>
                        <div class="control">
                            {!! Form::text('address2', null, ['class' => 'input']) !!}
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column field">
                            <label class="label">{{ __('message.postCode') }}</label>
                            <div class="control">
                                {!! Form::text('postCode', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                        <div class="column field">
                            <label class="label">{{ __('message.city') }}</label>
                            <div class="control">
                                {!! Form::text('city', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                    </div>
                </section>
            @endcan
            @can('child.read-medical')
                <section id="tab2-section" class="tab-panel is-hidden">
                    <div class="field">
                        <label class="label">{{ __('message.blood_type') }}</label>
                        <div class="control">
                            {!! Form::text('blood_type', null, ['class' => 'input']) !!}
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column field">
                            <label class="label">{{ __('message.medical_conditions') }}</label>
                            <div class="control">
                                {!! Form::textarea('medical_conditions', null, ['rows' => 2, 'class' => 'textarea']) !!}
                            </div>
                        </div>
                        <div class="column field">
                            <label class="label">{{ __('message.medical_medications') }}</label>
                            <div class="control">
                                {!! Form::textarea('medical_medications', null, ['rows' => 2, 'class' => 'textarea']) !!}
                            </div>
                        </div>
                        <div class="column field">
                            <label class="label">{{ __('message.medical_allergies') }}</label>
                            <div class="control">
                                {!! Form::textarea('medical_allergies', null, ['rows' => 2, 'class' => 'textarea']) !!}
                            </div>
                        </div>
                    </div>
                    <p class="title">{{ __('message.doctor') }}</p>
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">{{ __('message.doctor_name') }}</label>
                                <div class="control">
                                    {!! Form::text('doctor_name', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.doctor_phone_no') }}</label>
                                <div class="control">
                                    {!! Form::text('doctor_phone_no', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="column field">
                            <label class="label">{{ __('message.doctor_address') }}</label>
                            <div class="control">
                                {!! Form::textarea('doctor_address', null, ['rows' => 4, 'class' => 'textarea']) !!}
                            </div>
                        </div>
                    </div>
                </section>
            @endcan
            @can('child.read-family')
                <section id="tab3-section" class="tab-panel is-hidden">
                    <div class="columns">
                        <div class="column">
                            <p class="title">{{ __('message.legal_tutor1') }}</p>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_name') }}</label>
                                <div class="control">
                                    {!! Form::text('legal_tutor1_name', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_socialsecurity') }}</label>
                                <div class="control">
                                    {!! Form::text('legal_tutor1_socialsecurity', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_caf') }}</label>
                                <div class="control">
                                    {!! Form::text('legal_tutor1_caf', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_job_title') }}</label>
                                <div class="control">
                                    {!! Form::text('legal_tutor1_job_title', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_address') }}</label>
                                <div class="control">
                                    {!! Form::textarea('legal_tutor1_address', null, ['rows' => 4, 'class' => 'textarea']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_phone_no') }}</label>
                                <div class="control">
                                    {!! Form::text('legal_tutor1_phone_no', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <p class="title">{{ __('message.legal_tutor2') }}</p>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_name') }}</label>
                                <div class="control">
                                    {!! Form::text('legal_tutor2_name', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_socialsecurity') }}</label>
                                <div class="control">
                                    {!! Form::text('legal_tutor2_socialsecurity', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_caf') }}</label>
                                <div class="control">
                                    {!! Form::text('legal_tutor2_caf', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_job_title') }}</label>
                                <div class="control">
                                    {!! Form::text('legal_tutor2_job_title', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_address') }}</label>
                                <div class="control">
                                    {!! Form::textarea('legal_tutor2_address', null, ['rows' => 4, 'class' => 'textarea']) !!}
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">{{ __('message.legal_tutor_phone_no') }}</label>
                                <div class="control">
                                    {!! Form::text('legal_tutor2_phone_no', null, ['class' => 'input']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">{{ __('message.authorized_persons') }}</label>
                        <div class="control">
                            {!! Form::textarea('authorized_persons', null, ['rows' => 5, 'class' => 'textarea']) !!}
                        </div>
                    </div>
                </section>
            @endcan
            @can('child.read-contract')
                <section id="tab4-section" class="tab-panel is-hidden">
                    <div class="columns">
                        <div class="column field">
                            <label class="label">{{ __('message.contract_starting_date') }}</label>
                            <div class="control">
                                {!! Form::date('contract_starting_date', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                        <div class="column field">
                            <label class="label">{{ __('message.contract_ending_date') }}</label>
                            <div class="control">
                                {!! Form::date('contract_ending_date', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                        <div class="column field">
                            <label class="label">{{ __('message.attendanceSchedulesManagement') }}</label>
                            <div class="control">
                                {!! Form::select('schedule_id', App\Models\AttendanceSchedule::all()->pluck('name','id'),null, ['class' => 'input']); !!}
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column field">
                            <label class="label">{{ __('message.annual_resources') }}</label>
                            <div class="control">
                                {!! Form::number('annual_resources', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                        <div class="column field">
                            <label class="label">{{ __('message.child_care_expenses') }}</label>
                            <div class="control">
                                {!! Form::number('child_care_expenses', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                        <div class="column field">
                            <label class="label">{{ __('message.alimony_paid') }}</label>
                            <div class="control">
                                {!! Form::number('alimony_paid', null, ['class' => 'input']) !!}
                            </div>
                        </div>
                    </div>
                </section>
            @endcan
        </div>
        @can('child.create')
            <div class="field is-pulled-right pt-4">
                <div class="control is-pulled-right">
                    {!! Form::button('<span class="icon is-small"><i class="fa-solid fa-floppy-disk"></i></span><span>' . __('message.save') . '</span>', ['class' => 'button is-primary', 'type' => 'submit', 'name' => 'action', 'value' => 'save']) !!}
                </div>
            </div>
            <div class="is-clearfix"></div>
        @endcan
        {!! Form::close() !!}
    </x-content-page>
</x-app-layout>
