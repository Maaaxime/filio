<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.childsManagement') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <x-slot name="headerAction">
            <a href="{{ route('childs.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fa-solid fa-circle-plus"></i></span> {{ __('message.add') }}
            </a>
        </x-slot>

        <div class="table-container pr-2 pl-2">
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th scope="col" class="has-text-centered is-narrow">#</th>
                        <th scope="col" colspan="2">{{ __('message.name') }}</th>
                        <th scope="col" colspan="2">{{ __('message.birthdate') }}</th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.address') }}</th>
                        <th scope="col" class="is-hidden-touch">{{ __('message.contract_starting_date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($childs as $key => $children)
                        <tr {{ !$children->isActive() ? 'class="stripes"' : '' }}>
                            <th class="is-narrow">
                                <a href="{{ route('childs.edit', $children->id) }}" class="button is-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </th>
                            <td class="is-narrow">
                                @if ($children->image)
                                    <div class="image img-circle is-48x48"
                                        style="background-image: url('{{ asset('/storage/images/' . $children->image) }}');">
                                    </div>
                                @endif
                            </td>
                            <td>
                                <p>
                                    {{ $children->first_name }} {{ $children->last_name }}
                                </p>
                                <p class="is-size-7">
                                    {{ $children->parents() }}
                                </p>
                            </td>
                            <td class="is-hidden-touch">
                                {{ $children->formatAsDate($children->birthdate) }}
                            </td>
                            <td>
                                <div class="field is-grouped is-grouped-multiline">
                                    @if ($children->remainingDaysBeforeBirthday())
                                        <div class="control">
                                            <div class="tags has-addons">
                                                <span class="tag is-primary is-light">
                                                    <i class="fa-solid fa-cake-candles"></i>
                                                </span>
                                                <span class="tag is-primary is-light" style="min-width: 47px;">
                                                    {{ __('message.days') . $children->remainingDaysBeforeBirthday() }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($children->age())
                                        <div class="control">
                                            <div class="tags has-addons">
                                                <span class="tag is-warning is-light">
                                                    <i class="fa-solid fa-baby"></i>
                                                </span>
                                                <span class="tag is-warning is-light" style="min-width: 47px;">
                                                    {{ $children->age() }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="is-hidden-touch">
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode(implode(',', $children->address())) }}"
                                    target="_blank" class="has-text-dark">
                                    @foreach ($children->address() as $key => $addrPart)
                                        {{ $addrPart }} <br />
                                    @endforeach
                                </a>
                            </td>
                            <td class="is-hidden-touch">
                                {{ $children->formatAsDate($children->contract_starting_date) .(!empty((int) $children->contract_ending_date) ? '-' . $children->formatAsDate($children->contract_ending_date) : '') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $childs->links('vendor.pagination.custom') }}
    </x-content-page>
</x-app-layout>
