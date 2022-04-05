<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.dashboard') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <div class="box-no-shadow">
            <div class="content">
                @if ($promotedPosts->count() > 0)
                    @foreach ($promotedPosts as $post)
                        <div class="notification  {{ $post->color_name }}">
                            <div class="columns">
                                <div class="column">
                                    <p>{{ $post->title }}<br />
                                        <span class="is-size-7">
                                            {{ __('message.postInfo', ['name' => $post->author->name,'datetime' => $post->created_at->format('d/m/Y H:i')]) }}
                                        </span>
                                    </p>
                                </div>
                                <div
                                    class="column is-flex is-justify-content-center is-align-content-center is-flex-direction-column is-flex-grow-0">
                                    <a class="button {{ $post->color_name }} is-light"
                                        href="{{ route('user.posts.show', $post->slug) }}">
                                        {{ __('message.postView') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div>
                    <div class="divider"><p class="is-size-4">{{ __('message.attentances') }}</p></div>
                </div>

                <div class="tile is-ancestor">
                    @php
                        $noOfColumns = 3;
                        $counter = 0;
                    @endphp
                    @foreach ($children as $child)
                        @if ($counter % $noOfColumns == 0)
                </div>
                <div class="tile is-ancestor">
                    @endif
                    <div class="tile is-parent">
                        <article
                            class="tile is-child box is-flex is-flex-direction-column is-justify-content-space-between">
                            <div class="columns is-mobile is-vcentered">
                                <div class="column is-narrow">
                                    @if ($child->image)
                                        <div class="image is-rounded is-64x64"
                                            style="background-image: url('{{ asset('/storage/images/' . $child->image) }}');">
                                        </div>
                                    @endif
                                </div>
                                <div class="column">
                                    <p class="title" style="color: {{ $child->gender_color }}">
                                        {{ $child->first_name }}</p>
                                </div>
                            </div>
                            <div class="content">
                                @php
                                    $noOfSteps = $child->todaysAttendanceEntries()->count();
                                    $stepNo = 0;
                                @endphp
                                <ul class="steps is-vertical">
                                    @foreach ($child->todaysAttendanceEntries() as $attendanceEntry)
                                        @php
                                            $stepNo += 1;
                                        @endphp
                                        @if ($attendanceEntry->time_end)
                                            <li class="steps-segment">
                                                <span href="#" class="steps-marker"></span>
                                                <div class="steps-content">
                                                    <p class="is-size-6">
                                                        {{ $attendanceEntry->time_start_time }} : Arrivée à la
                                                        crèche
                                                    </p>
                                                </div>
                                            </li>
                                            <li
                                                class="steps-segment {{ $stepNo < $noOfSteps ? 'has-gaps is-dashed' : '' }} ">
                                                <span href="#" class="steps-marker"></span>
                                                <div class="steps-content">
                                                    <p class="is-size-6">
                                                        {{ $attendanceEntry->time_end_time }} : Départ de la
                                                        crèche
                                                    </p>
                                                </div>
                                            </li>
                                        @else
                                            <li class="steps-segment">
                                                <span class="steps-marker"></span>
                                                <div class="steps-content">
                                                    <p class="is-size-6">
                                                        {{ $attendanceEntry->time_start_time }} : Arrivée à la
                                                        crèche
                                                    </p>
                                                </div>
                                                <div class="steps-content is-divider-content">
                                                    <p class="heading">
                                                        {{ \Carbon\Carbon::now()->format('H:i') }}</p>
                                                </div>
                                            </li>
                                            <li class="steps-segment">
                                                <span class="steps-marker"></span>
                                            </li>
                                        @endif

                                        <?php $previousExist = true; ?>
                                    @endforeach
                                </ul>
                            </div>
                            <div>
                                <a href="#" class="button is-primary is-block timer" data-child="{{ $child->id }}">
                                    <span class="icon is-small">
                                        <i class="fa-fw fas fa-clock nav-icon"></i>
                                    </span>
                                    <span>{{ $child->showCurrentAttendanceEntry() }}</span>
                                </a>
                            </div>
                        </article>
                    </div>

                    @php
                        $counter++;
                    @endphp
                    @endforeach
                </div>
                @if ($recentPosts->count() > 0)
                    <div>
                        <div class="divider"><p class="is-size-4">{{ __('message.postRecents') }}</p></div>
                    </div>

                    <div class="list has-hoverable-list-items">
                        @foreach ($recentPosts as $key => $post)
                            <a href="{{ route('user.posts.show', $post->slug) }}">
                                <div class="list-item">
                                    <div class="list-item-content">
                                        <div class="list-item-title">
                                            {{ $post->title }}
                                        </div>
                                        <div class="list-item-description">
                                            {{ __('message.postInfo', ['name' => $post->author->name,'datetime' => $post->created_at->format('d/m/Y H:i')]) }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </x-content-page>

    @section('scripts')
        <script>
            $(function() {
                window._token = $('meta[name="csrf-token"]').attr('content');

                $('.timer').click(function(event) {
                    event.preventDefault();

                    let childId = $(this).data("child");
                    let $timer = $(this);

                    $.ajax({
                        method: "POST",
                        url: "{{ route('user.attendances.updateCurrent') }}",
                        data: {
                            child: childId,
                            _token
                        },
                        success: (data) => window.location.reload(),
                        error: (data) => console.log(data)
                    });
                });
            });
        </script>
    @endsection
</x-app-layout>
