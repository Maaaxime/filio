<x-app-layout>
    <x-slot name="header">
            {{ __('message.dashboard') }}
    </x-slot>

    <article>
        <p>Il y a actuellement :
            <ul>
                <li>
                    <a href="{{ url('/admin/users') }}">{{ $users }} utilisateurs. </a>
                </li>
                <li>
                    <a href="{{ url('/admin/roles') }}">{{ $roles }} rôles.</a>
                </li>
                <li>
                    <a href="{{ url('/childs') }}">{{ $childs }} enfants.</a>
                </li>
            </ul>
        </p>
    </article>
</x-app-layout>
