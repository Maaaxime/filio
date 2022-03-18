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
                                    <?php
                                    $noOfSteps = $child->todaysAttendanceEntries()->count();
                                    $stepNo = 0;
                                    ?>
                                    <ul class="steps is-vertical">
                                        @foreach ($child->todaysAttendanceEntries() as $attendanceEntry)
                                            <?php
                                            $stepNo += 1;
                                            ?>
                                            @if ($attendanceEntry->time_end)
                                                <li class="steps-segment">
                                                    <span href="#" class="steps-marker"></span>
                                                    <div class="steps-content">
                                                        <p class="is-size-6">
                                                            {{ $attendanceEntry->time_start_time }} : Arrivée à la crèche
                                                        </p>
                                                    </div>
                                                </li>
                                                <li
                                                    class="steps-segment {{ $stepNo < $noOfSteps ? 'has-gaps is-dashed' : '' }} ">
                                                    <span href="#" class="steps-marker"></span>
                                                    <div class="steps-content">
                                                        <p class="is-size-6">
                                                            {{ $attendanceEntry->time_end_time }} : Départ de la crèche
                                                        </p>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="steps-segment">
                                                    <span class="steps-marker"></span>
                                                    <div class="steps-content">
                                                        <p class="is-size-6">
                                                            {{ $attendanceEntry->time_start_time }} : Arrivée à la crèche
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
                                <a href="{{ url("my/attendances/check-in/$child->id") }}"
                                    class="card-footer-item">Check-In</a>
                                <a href="{{ url("my/attendances/check-out/$child->id") }}"
                                    class="card-footer-item">Check-Out</a>
                            </footer>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </x-content-page>
</x-app-layout>
