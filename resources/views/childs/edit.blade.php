<x-app-layout>
    <x-slot name="header">
        <hgroup>
            <h2 class="">
                {{ __('message.childsManagement') }}
            </h2>
            <h3>
                <a href="{{ route('childs.index') }}">
                    <span class="icon"><i class="gg-arrow-left-o"></i></span>{{ __('message.back') }}
                </a>
            </h3>
        </hgroup>
    </x-slot>

    <x-banner />

    {!! Form::model($children, ['method' => 'PATCH', 'route' => ['childs.update', $children->id]]) !!}
    <details open>
        <summary>{{ __('message.general') }}</summary>
        <div class="grid">
            <label for="first_name">
                {{ __('message.first_name') }}
                {!! Form::text('first_name', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
            <label for="last_name">
                {{ __('message.last_name') }}
                {!! Form::text('last_name', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>
        <div class="grid">
            <label for="birthdate">
                {{ __('message.birthdate') }}
                {!! Form::date('birthdate', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
            <label for="city_of_birth">
                {{ __('message.city_of_birth') }}
                {!! Form::text('city_of_birth', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>
        <div class="grid">
            <label for="phone_no">
                {{ __('message.phone_no') }}
                {!! Form::text('phone_no', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
            <label for="email">
                {{ __('message.email') }}
                {!! Form::email('email', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>

        <label for="address">
            {{ __('message.address') }}
            {!! Form::text('address', null, ['class' => '', 'disabled' => $readonly]) !!}
        </label>
        <label for="address2">
            {{ __('message.address2') }}
            {!! Form::text('address2', null, ['class' => '', 'disabled' => $readonly]) !!}
        </label>
        <div class="grid">
            <label for="postCode">
                {{ __('message.postCode') }}
                {!! Form::text('postCode', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
            <label for="city">
                {{ __('message.city') }}
                {!! Form::text('city', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>
    </details>
    <details>
        <summary>{{ __('message.medical') }}</summary>
        <label for="blood_type">
            {{ __('message.blood_type') }}
            {!! Form::text('blood_type', null, ['class' => '', 'disabled' => $readonly]) !!}
        </label>
        <div class="grid">
            <label for="medical_conditions">
                {{ __('message.medical_conditions') }}
                {!! Form::textarea('medical_conditions', null, ['rows' => 2, 'class' => '', 'disabled' => $readonly]) !!}
            </label>
            <label for="medical_medications">
                {{ __('message.medical_medications') }}
                {!! Form::textarea('medical_medications', null, ['rows' => 2, 'class' => '', 'disabled' => $readonly]) !!}
            </label>
            <label for="medical_allergies">
                {{ __('message.medical_allergies') }}
                {!! Form::textarea('medical_allergies', null, ['rows' => 2, 'class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>
        <h4>{{ __('message.doctor') }}</h4>
        <div class="grid">
            <div>
                <label for="doctor_name">
                    {{ __('message.doctor_name') }}
                    {!! Form::text('doctor_name', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="doctor_phone_no">
                    {{ __('message.doctor_phone_no') }}
                    {!! Form::text('doctor_phone_no', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
            </div>
            <label for="doctor_address">
                {{ __('message.doctor_address') }}
                {!! Form::textarea('doctor_address', null, ['rows' => 5, 'class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>
    </details>
    <details>
        <summary>{{ __('message.family_situation') }}</summary>
        <div class="grid">
            <div>
                <h4>{{ __('message.legal_tutor1') }}</h4>
                <label for="legal_tutor1_name">
                    {{ __('message.legal_tutor_name') }}
                    {!! Form::text('legal_tutor1_name', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="legal_tutor1_socialsecurity">
                    {{ __('message.legal_tutor_socialsecurity') }}
                    {!! Form::text('legal_tutor1_socialsecurity', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="legal_tutor1_caf">
                    {{ __('message.legal_tutor_caf') }}
                    {!! Form::text('legal_tutor1_caf', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="legal_tutor1_job_title">
                    {{ __('message.legal_tutor_job_title') }}
                    {!! Form::text('legal_tutor1_job_title', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="legal_tutor1_address">
                    {{ __('message.legal_tutor_address') }}
                    {!! Form::textarea('legal_tutor1_address', null, ['rows' => 2, 'class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="legal_tutor1_phone_no">
                    {{ __('message.legal_tutor_phone_no') }}
                    {!! Form::text('legal_tutor1_phone_no', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
            </div>
            <div>
                <h4>{{ __('message.legal_tutor2') }}</h4>
                <label for="legal_tutor2_name">
                    {{ __('message.legal_tutor_name') }}
                    {!! Form::text('legal_tutor2_name', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="legal_tutor2_socialsecurity">
                    {{ __('message.legal_tutor_socialsecurity') }}
                    {!! Form::text('legal_tutor2_socialsecurity', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="legal_tutor2_caf">
                    {{ __('message.legal_tutor_caf') }}
                    {!! Form::text('legal_tutor2_caf', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="legal_tutor2_job_title">
                    {{ __('message.legal_tutor_job_title') }}
                    {!! Form::text('legal_tutor2_job_title', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="legal_tutor2_address">
                    {{ __('message.legal_tutor_address') }}
                    {!! Form::textarea('legal_tutor2_address', null, ['rows' => 2, 'class' => '', 'disabled' => $readonly]) !!}
                </label>
                <label for="legal_tutor2_phone_no">
                    {{ __('message.legal_tutor_phone_no') }}
                    {!! Form::text('legal_tutor2_phone_no', null, ['class' => '', 'disabled' => $readonly]) !!}
                </label>
            </div>
        </div>
        <label for="authorized_persons">
            {{ __('message.authorized_persons') }}
            {!! Form::textarea('authorized_persons', null, ['rows' => 3, 'class' => '', 'disabled' => $readonly]) !!}
        </label>
    </details>
    <details>
        <summary>{{ __('message.contract') }}</summary>
        <div class="grid">
            <label for="contract_starting_date">
                {{ __('message.contract_starting_date') }}
                {!! Form::date('contract_starting_date', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
            <label for="contract_ending_date">
                {{ __('message.contract_ending_date') }}
                {!! Form::date('contract_ending_date', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>
        <div class="grid">
            <label for="annual_resources">
                {{ __('message.annual_resources') }}
                {!! Form::number('annual_resources', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
            <label for="child_care_expenses">
                {{ __('message.child_care_expenses') }}
                {!! Form::number('child_care_expenses', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
            <label for="alimony_paid">
                {{ __('message.alimony_paid') }}
                {!! Form::number('alimony_paid', null, ['class' => '', 'disabled' => $readonly]) !!}
            </label>
        </div>
    </details>
    <div class="grid">
        {!! Form::button('<span class="icon"><i class="gg-remove"></i></span>' . __('message.remove'), ['class' => 'btn-danger', 'type' => 'submit', 'name' => 'action', 'value' => 'delete', 'disabled' => $readonly]) !!}
        {!! Form::button('<span class="icon"><i class="gg-add"></i></span>' . __('message.save'), ['class' => 'btn-success', 'type' => 'submit', 'name' => 'action', 'value' => 'save', 'disabled' => $readonly]) !!}
    </div>
    {!! Form::close() !!}
</x-app-layout>
