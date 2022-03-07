<x-app-layout>
    <x-slot name="header">
        <hgroup>
            <h2 class="">
                {{ __('message.childsManagement') }}
            </h2>
            <h3>
                <a href="{{ route('childs.create') }}">
                    <span class="icon"><i class="gg-add"></i></span>{{ __('message.add') }}
                </a>
            </h3>
        </hgroup>
    </x-slot>

    <x-banner />

    <table role="grid">
        <thead>
            <tr>
                <th scope="col" class="w-10">#</th>
                <th scope="col">{{ __('message.first_name') }}</th>
                <th scope="col">{{ __('message.last_name') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($childs as $key => $child)
                <tr>
                    <th scope="row">
                        <a href="{{ route('childs.edit', $child->id) }}">
                            {{ $child->id }}
                        </a>
                    </th>
                    <td>
                        <div class="grid flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                @if ($child->image)
                                    <div class="w-10 h-10 img-circle"
                                        style="background-image: url('{{ asset('/storage/images/' . $child->image) }}')">
                                    </div>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('childs.edit', $child->id) }}">
                                    {{ $child->first_name }} {{ $child->last_name }}<br />
                                <small>{{ $child->parents() }}</small></a>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        @foreach ($child->address() as $key => $addrPart)
                        {{ $addrPart }} <br />
                    @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $childs->links('vendor.pagination.custom') }}

</x-app-layout>
