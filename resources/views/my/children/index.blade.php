<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ trans_choice('message.myChildren',Auth()->user()->children()->count()) }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>

        <div>
            <div class="list has-hoverable-list-items">
                @foreach ($children as $key => $child)
                    <div class="list-item">
                        <div class="list-item-image">
                            @if ($child->image)
                                <div class="image is-rounded is-48x48"
                                    style="background-image: url('{{ asset('/storage/images/' . $child->image) }}');">
                                </div>
                            @endif
                        </div>
                        <div class="list-item-content">
                            <div class="list-item-title">
                                {{ $child->first_name }}</div>
                            <div class="list-item-description is-grouped is-grouped-multiline">
                                <div class="field is-grouped is-grouped-multiline">
                                    @if ($child->remainingDaysBeforeBirthday())
                                        <div class="control">
                                            <div class="tags has-addons is-rounded">
                                                <span class="tag is-primary is-light">
                                                    <i class="fa-solid fa-cake-candles"></i>
                                                </span>
                                                <span class="tag is-primary is-light" style="min-width: 47px;">
                                                    {{ __('message.days') . $child->remainingDaysBeforeBirthday() }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="list-item-controls">
                            <div class="buttons is-right">
                                <a href="{{ route('user.children.edit', $child->id) }}" class="button is-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-content-page>
</x-app-layout>
