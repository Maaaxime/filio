<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ trans_choice('message.myChilds',Auth()->user()->childs()->count()) }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>

        <div class="box-no-shadow">
            @foreach ($childs as $key => $child)
                <a href="{{ route('childs.edit', $child->id) }}">
                    <div class="card mb-4">
                        <header class="card-header mt-4">
                            <table class="table card-header-title">
                                <tr>
                                    <td class="is-narrow">
                                        @if ($child->image)
                                            <div class="image is-rounded is-48x48"
                                                style="background-image: url('{{ asset('/storage/images/' . $child->image) }}');">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="content">
                                        <p class="title is-4">{{ $child->first_name }}</p>
                                        <p class="subtitle is-6">{{ $child->last_name }}</p>
                                    </td>
                                </tr>
                            </table>
                        </header>
                    </div>
                </a>
            @endforeach
        </div>
    </x-content-page>
</x-app-layout>
