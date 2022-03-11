<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.childsManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>

        <div class="container pr-2 pl-2">
            <div class="columns pb-6 is-narrow-mobile">

                @foreach ($childs as $key => $child)
                    <div class="column is-2">
                        <a href="{{ route('childs.show', $child->id) }}">
                            <div class="card">
                                <div class="card-image">
                                    <figure class="image is-4by3"
                                        style="background-image: url('{{ asset('/storage/images/' . $child->image) }}');">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="content">
                                        <p class="title is-4">{{ $child->first_name }}</p>
                                        <p class="subtitle is-6">{{ $child->last_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </x-content-page>
</x-app-layout>
