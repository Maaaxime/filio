<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.dashboard') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>
        <section class="section">
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
                    <article class="tile is-child box">
                        <div class="columns is-mobile is-vcentered">
                            <div class="column is-narrow">
                                @if ($child->image)
                                    <div class="image is-rounded is-64x64"
                                        style="background-image: url('{{ asset('/storage/images/' . $child->image) }}');">
                                    </div>
                                @endif
                            </div>
                            <div class="column">
                                <p class="title">{{ $child->first_name }}</p>
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
                        <footer class="card-footer">
                            <a href="#" class="card-footer-item timer" data-child="{{ $child->id }}">
                                <i class="fa-fw fas fa-clock nav-icon"></i>
                                <span>{{ $child->showCurrentAttendanceEntry() }}</span>
                            </a>
                        </footer>
                    </article>
                </div>

                @php
                    $counter++;
                @endphp
                @endforeach
            </div>
        </section>
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
