<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.dashboard') }}</x-slot>
        <x-slot name="headerSubtitle"></x-slot>

        <nav class="level is-mobile">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Utilisateurs</p>
                    <p class="title">{{ $users }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Roles</p>
                    <p class="title">{{ $roles }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Enfants</p>
                    <p class="title">{{ $children }}</p>
                </div>
            </div>
        </nav>

        <section class="section">
            <div class="columns">
                @foreach (Auth::user()->children()->get()
    as $child)
                    <div class="column">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    {{ $child->full_name }}
                                </p>
                            </header>

                            <div class="card-content">
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
                            </div>
                            <footer class="card-footer">
                                <a href="#" class="card-footer-item timer" data-child="{{ $child->id }}">
                                    <i class="fa-fw fas fa-clock nav-icon"></i>
                                    <span>{{ $child->showCurrentAttendanceEntry() }}</span>
                                </a>
                            </footer>
                        </div>
                    </div>
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

                    console.log(childId);
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
