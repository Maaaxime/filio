<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.dashboard') }}</x-slot>
        <x-slot name="headerSubtitle">test</x-slot>

        <nav class="level is-mobile">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Utilisateurs</p>
                    <p class="title">{{ $users }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Roles</p>
                    <p class="title">{{ $roles }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Enfants</p>
                    <p class="title">{{ $childs }}</p>
                </div>
            </div>
        </nav>
    </x-content-page>
</x-app-layout>
