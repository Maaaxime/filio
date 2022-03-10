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

    <figure>
        <table role="grid">
            <thead>
                <tr>
                    <th scope="col">{{ __('message.name') }}</th>
                    <th scope="col">{{ __('message.birthdate') }}</th>
                    <th scope="col">{{ __('message.address') }}</th>
                    <th scope="col">{{ __('message.contract_starting_date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($childs as $key => $child)
                    <tr class="{{ !$child->isActive() ? 'stripes' : '' }}">
                        <td>
                            <div class="grid flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 index50">
                                    @if ($child->image)
                                        <div class="w-10 h-10 img-circle"
                                            style="background-image: url('{{ asset('/storage/images/' . $child->image) }}')">
                                            <span class="badge rounded-pill state-badge h-10-1 w-10-1 {{ ($child->isActive()) ? 'btn-success':'btn-danger' }}" ></span>
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
                            {{ $child->formatAsDate($child->birthdate) }}
                            @if ($child->isActive())
                                <span class="badge rounded-pill btn-success"><small><i class="gg-gift icon"></i>
                                        {{ __('message.days') . $child->remainingDaysBeforeBirthday() }}</small></span>
                            @endif
                        </td>
                        <td>
                            @foreach ($child->address() as $key => $addrPart)
                                {{ $addrPart }} <br />
                            @endforeach
                        </td>
                        <td>
                            {{ $child->formatAsDate($child->contract_starting_date) .(!empty((int) $child->contract_ending_date) ? '-' . $child->formatAsDate($child->contract_ending_date) : '') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </figure>
    {{ $childs->links('vendor.pagination.custom') }}

</x-app-layout>
