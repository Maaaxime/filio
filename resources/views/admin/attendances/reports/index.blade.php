<x-app-layout>
    <x-content-page>
        <x-slot name="header">{{ __('message.reportsManagement') }}</x-slot>
        <x-slot name="headerSubtitle">
            <a href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-chevron-left"></i> {{ __('message.back') }}
            </a>
        </x-slot>
        <x-slot name="headerAction">


        </x-slot>
        <div class="box-no-shadow">
            <div class="box notification">
                {!! Form::open(['route' => 'admin.attendances.reports.index', 'method' => 'GET', 'class' => 'box-no-shadow']) !!}
                <p class="label">{{ __('message.filters') }}</p>
                <div class="columns is-centered">
                    <div class="column">
                        <div class="control select  is-fullwidth">
                            {!! Form::select('report', $reportFilters['availableReports'], $reportFilters['selectedReport'], [
                                'class' => '',
                            ]) !!}
                        </div>
                    </div>
                    <div class="column">
                        <div class="control select  is-fullwidth">
                            {!! Form::select('child', $childFilters['childrenArray'], $childFilters['selectedChild'], ['class' => '']) !!}
                        </div>
                    </div>
                    <div class="column is-narrow">
                        <div class="control select">
                            {!! Form::select('month', $dateFilters['monthArray'], $dateFilters['selectedMonth'], ['class' => '']) !!}
                        </div>
                        <div class="control select is-pulled-right">
                            {!! Form::selectYear('year', $dateFilters['firstYear'], $dateFilters['lastYear'], ['class' => '']) !!}
                        </div>
                        <div class="is-clearfix"></div>
                    </div>
                    <div class="column is-narrow">
                        {!! Form::button(
                            '<span class="icon is-small"><i class="fa-solid fa-arrows-rotate"></i></span><span>' .
                                __('message.refresh') .
                                '</span>',
                            ['class' => 'button is-primary  is-fullwidth', 'type' => 'submit'],
                        ) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="box-no-shadow">
                @switch($viewType)
                    @case('graph')
                        @if ($chart)
                            <div class="columns">
                                <div class="column is-two-thirds">
                                    <canvas id="canvas" height="280" width="600"></canvas>
                                </div>
                                <div class="column is-one-thirds">
                                    <div class="pb-6 sticky">
                                        <ul class="steps is-medium is-centered has-content-centered is-horizontal has-gaps">
                                            @php $first = true; @endphp
                                            @foreach ($table as $type => $entries)
                                                <li class="steps-segment  {{ $first ? 'is-active' : '' }}">
                                                    <a hef="#" class="has-text-dark"
                                                        aria-controls="tab-{{ $type }}">
                                                        <span class="steps-marker">
                                                        </span>
                                                        <div class="steps-content">
                                                            <p class="heading">{{ $type }}</p>
                                                        </div>
                                                    </a>
                                                </li>
                                                @php $first = false; @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-panels">
                                        @php $first = true; @endphp
                                        @foreach ($table as $type => $entries)
                                            @php $total = 0; @endphp
                                            <section id="tab-{{ $type }}"
                                                class="tab-panel {{ $first ? '' : 'is-hidden' }}">
                                                <div class="table-container pr-2 pl-2">
                                                    <table
                                                        class="table is-striped is-hoverable is-fullwidth sortable-theme-minimal"
                                                        data-sortable>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">{{ __('message.time_start_date') }}</th>
                                                                <th scope="col" class="has-text-right">
                                                                    {{ __('message.quantity') }}
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php ksort($entries); @endphp
                                                            @foreach ($entries as $date => $value)
                                                                @php $total += $value; @endphp
                                                                <tr>
                                                                    <td>{{ $date }}</td>
                                                                    <td class="has-text-right">
                                                                        {{ number_format($value, 2, ',', ' ') }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Total</th>
                                                                <th class="has-text-right">
                                                                    {{ number_format($total, 2, ',', ' ') }}
                                                                </th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </section>
                                            @php $first = false; @endphp
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <p>{{ __('message.noDataToDisplay') }}.</p>
                        @endif
                    @break

                    @case('table')
                        <table class="table is-striped is-hoverable is-fullwidth sortable-theme-minimal" data-sortable>
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('message.children') }}</th>
                                    @foreach ($table['dates']['dateRange'] as $date)
                                        <th scope="col">{{ substr($date, 0, 2) }}</th>
                                    @endforeach
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($table['children'] as $childId => $childName)
                                    @php
                                        $childSum = 0;
                                        $currChild = head(
                                            Arr::where($chart, function ($value, $key) use ($childId) {
                                                return $value['childId'] == $childId;
                                            }),
                                        );
                                    @endphp
                                    <tr>
                                        <td>{{ $childName }}</td>
                                        @foreach ($table['dates']['dateRange'] as $date)
                                            @php
                                                $currDate = substr($date, 0, 2);
                                                if ($currChild) {
                                                    $currChildData = head(
                                                        Arr::where($currChild['data'], function ($value, $key) use ($currDate) {
                                                            return $key == $currDate;
                                                        }),
                                                    );
                                                    @$childSum += $currChildData;
                                                }
                                                
                                            @endphp
                                            <td class="has-text-right">
                                                @if (isset($currChildData) && $currChildData != 0)
                                                    {{ sprintf('%0.2f', $currChildData) }}
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="has-text-right">{{ sprintf('%0.2f', $childSum) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @break

                @endswitch
            </div>
        </div>
    </x-content-page>

    @section('scripts')
        @if ($chart)
            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js" crossorigin="anonymous"></script>

            <script>
                $(document).ready(function() {
                    var ctx = document.getElementById("canvas").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($dateFilters['dateRange']) !!},
                            datasets: {!! json_encode($chart) !!}
                        },
                        options: {
                            locale: "{{ App::currentLocale() }}",
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            </script>
        @endif
    @endsection
</x-app-layout>
