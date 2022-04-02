<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.whoops') }}</x-slot>
        <x-slot name="headerSubtitle">{{ __('message.whoopsMissing') }}</x-slot>
        <x-slot name="headerAction"></x-slot>

        <section>
            <figure class="image" style="width: 50%; position: relative; margin-right: auto; margin-left:auto;">
                <img src="{{ asset('img/404.png') }}" alt="{{ __('message.whoopsMissing') }}">
            </figure>
        </section>
    </x-content-page>
</x-app-layout>