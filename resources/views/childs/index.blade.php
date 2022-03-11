<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.childsManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ route('childs.create') }}">
                <i class="fa-solid fa-circle-plus"></i> {{ __('message.add') }}
            </a>
        </x-slot>

        <div class="table-container pr-2 pl-2">
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">{{ __('message.name') }}</th>
                        <th scope="col" colspan="2">{{ __('message.birthdate') }}</th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.address') }}</th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.contract_starting_date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($childs as $key => $child)
                        <tr {{ !$child->isActive() ? 'class="stripes"' : '' }}>
                            <td class="is-narrow">
                                @if ($child->image)
                                    <div class="image img-circle is-48x48"
                                        style="background-image: url('{{ asset('/storage/images/' . $child->image) }}');">
                                    </div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('childs.edit', $child->id) }}">
                                    <p class="title is-5">
                                        {{ $child->first_name }} {{ $child->last_name }}
                                    </p>
                                    <p class="subtitle is-6">
                                        {{ $child->parents() }}
                                    </p>
                                </a>
                            </td>
                            <td class="is-hidden-touch">
                                {{ $child->formatAsDate($child->birthdate) }}
                            </td>
                            <td>
                                <div class="field is-grouped is-grouped-multiline">
                                    @if ($child->remainingDaysBeforeBirthday())
                                        <div class="control">
                                            <div class="tags has-addons">
                                                <span class="tag is-primary is-light">
                                                    <i class="fa-solid fa-cake-candles"></i>
                                                </span>
                                                <span class="tag is-primary is-light" style="min-width: 47px;">
                                                    {{ __('message.days') . $child->remainingDaysBeforeBirthday() }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($child->age())
                                        <div class="control">
                                            <div class="tags has-addons">
                                                <span class="tag is-warning is-light">
                                                    <i class="fa-solid fa-baby"></i>
                                                </span>
                                                <span class="tag is-warning is-light" style="min-width: 47px;">
                                                    {{ $child->age() }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="is-hidden-touch">
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode(implode(',', $child->address())) }}"
                                    target="_blank"  class="has-text-dark">
                                        @foreach ($child->address() as $key => $addrPart)
                                            {{ $addrPart }} <br />
                                        @endforeach
                                </a>
                            </td>
                            <td class="is-hidden-touch">
                                {{ $child->formatAsDate($child->contract_starting_date) .(!empty((int) $child->contract_ending_date) ? '-' . $child->formatAsDate($child->contract_ending_date) : '') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $childs->links('vendor.pagination.custom') }}
    </x-content-page>
</x-app-layout>
