<?php

namespace App\Http\Controllers;

use App\Models\AttendanceEntry;
use App\Models\AttendanceType;
use App\Models\Child;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;

class AttendanceReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $dateFilters = $this->getDateFilters($request->month, $request->year);
        $reportFilters = $this->getReportFilters($request->report);
        $childFilters = $this->getChildFilters($request->child);

        $datasets = null;
        $chart = null;
        $table = null;
        switch ($reportFilters["selectedReport"]) {
            case 0: // chartTotalChildrenPerDay
                $datasets = $this->getChartTotalChildrenPerDay($dateFilters, $childFilters["selectedChild"]);
                $chart = $datasets[0];
                $table = $datasets[1];
                $viewType = "graph";
                break;
            case 1: // chartTotalHoursPerDay
                $datasets = $this->getChartTotalHoursPerDay($dateFilters, $childFilters["selectedChild"]);
                $chart = $datasets[0];
                $table = $datasets[1];
                $viewType = "graph";
                break;
            case 2: // chartTableChildPerDay
                $childrenArray = Child::active($dateFilters)->get()->pluck('full_name', 'id')->toArray();

                $datasets = $this->getChartTableChildPerDay($dateFilters, $childrenArray);
                $chart = $datasets[0];
                $table = array('children' => $childrenArray, 'dates' => $dateFilters);
                $viewType = "table";
                break;
            default:
                $datasets = null;
                $chart = null;
                $table = null;
                $viewType = "none";
                break;
        }

        return view('admin.attendances.reports.index', compact('dateFilters', 'reportFilters', 'childFilters', 'chart', 'table', 'viewType'));
    }

    private function getReportFilters($fromReport): array
    {
        $selectedReport =  isset($fromReport) ? $fromReport : 0;
        $availableReports = array(
            0 => __('message.chartTotalChildrenPerDay'),
            1 => __('message.chartTotalHoursPerDay'),
            2 => __('message.chartTableChildPerDay')
        );

        return array(
            "availableReports" => $availableReports,
            "selectedReport" => $selectedReport
        );
    }

    private function getDateFilters($fromMonth, $fromYear): array
    {
        $monthArray = $this->getMonthArray(false);
        $selectedMonth = isset($fromMonth) ? $fromMonth : idate("m");

        $firstYear = AttendanceEntry::OrderBy('time_start')->First();
        $firstYear = $firstYear == null ? idate("Y") : intval($firstYear->time_start->year);
        $lastYear = idate("Y");
        $selectedYear = isset($fromYear) ? intval($fromYear) : idate("Y");

        $fromDate = Carbon::createFromDate($selectedYear, $selectedMonth, 01);
        $firstDay = $fromDate->copy()->startOfMonth()->setTime(0, 0, 0);
        $lastDay = $fromDate->copy()->lastOfMonth()->setTime(23, 59, 59);

        $dateRange = [];
        $period = CarbonPeriod::create($firstDay, $lastDay);
        foreach ($period as $date) {
            array_push($dateRange, $date->format('d/m/Y'));
        }

        return array(
            'monthArray' => $monthArray,
            'firstYear' => $firstYear,
            'lastYear' => $lastYear,
            'firstDay' => $firstDay,
            'lastDay' => $lastDay,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'dateRange' => $dateRange
        );
    }

    private function getChildFilters($fromChild): array
    {
        $childrenArray = [];
        array_push($childrenArray, __('message.allChilds'));
        $childrenArray = $childrenArray + Child::active()->get()->pluck('full_name', 'id')->toArray();
        $selectedChild = isset($fromChild) ? intval($fromChild) : 0;

        return array(
            'childrenArray' => $childrenArray,
            'selectedChild' => $selectedChild
        );
    }

    private function getMonthArray(bool $withBlank): array
    {
        $monthArray = array(
            1 => __('months.january'),
            2 => __('months.february'),
            3 => __('months.march'),
            4 => __('months.april'),
            5 => __('months.may'),
            6 => __('months.june'),
            7 => __('months.july'),
            8 => __('months.august'),
            9 => __('months.september'),
            10 => __('months.october'),
            11 => __('months.november'),
            12 => __('months.december')
        );

        if ($withBlank) {
            array_unshift($monthArray, "");
        }
        return $monthArray;
    }

    private function getChartTableChildPerDay(array $dateFilters, array $childrenArray)
    {
        $chartDatasets = [];
        $defaultEntryType = AttendanceType::whereDefault(1)->first();

        foreach ($childrenArray as $childId => $childName) {
            $data = AttendanceEntry::whereNotNull('time_end')
                ->whereBetween('time_start', [$dateFilters["firstDay"], $dateFilters["lastDay"]])
                ->where('type_id', '=', $defaultEntryType->id)
                ->where('child_id', '=', $childId);

            $data = $data->get(
                array(
                    DB::raw(' DATE_FORMAT(Date(time_start),"%d") as date_start'),
                    'time_start',
                    'time_end',
                )
            )
                ->groupBy(['date_start'])
                ->map(function ($items) {
                    $sum = 0;

                    foreach ($items as $item) {
                        $sum += $item->total_time_hours;
                    }

                    return $sum;
                })
                ->toArray();

            if ($data) {
                $dataset = array(
                    "childId" => $childId,
                    "childName" => $childName,
                    "data" => $data
                );

                array_push($chartDatasets, $dataset);
            }
        }

        return [$chartDatasets];
    }

    private function getChartTotalChildrenPerDay(array $dateFilters, int $child_id = null)
    {
        $chartDatasets = [];
        $tableDatasets = [];

        $entryTypes = AttendanceType::all();
        foreach ($entryTypes as $type) {
            $data = AttendanceEntry::whereNotNull('time_end')
                ->whereBetween('time_start', [$dateFilters["firstDay"], $dateFilters["lastDay"]])
                ->where('type_id', '=', $type->id);

            if (($child_id != null) && ($child_id != 0))
                $data = $data->where('child_id', '=', $child_id);

            $data = $data->get(
                array(
                    DB::raw(' DATE_FORMAT(Date(time_start),"%d/%m/%Y") as date_start'),
                )
            )
                ->groupBy('date_start', 'child_id')
                ->map(function ($items) {
                    return $items->count();
                })
                ->toArray();

            if ($data) {
                $dataset = array(
                    "label" =>  $type->name,
                    "data" => $data,
                    "borderWidth" => 1,
                    'backgroundColor' => $type->background_color,
                    'borderColor' => $type->font_color
                );

                array_push($chartDatasets, $dataset);
                $tableDatasets = array_merge($tableDatasets, array($type->name => $data));
            }
        }

        return [$chartDatasets, $tableDatasets];
    }

    private function getChartTotalHoursPerDay(array $dateFilters, int $child_id = null)
    {
        $chartDatasets = [];
        $tableDatasets = [];

        $entryTypes = AttendanceType::all();
        foreach ($entryTypes as $type) {
            $data = AttendanceEntry::whereNotNull('time_end')
                ->whereBetween('time_start', [$dateFilters["firstDay"], $dateFilters["lastDay"]])
                ->where('type_id', '=', $type->id);

            if (($child_id != null) && ($child_id != 0))
                $data = $data->where('child_id', '=', $child_id);


            $data = $data->get(
                array(
                    DB::raw(' DATE_FORMAT(Date(time_start),"%d/%m/%Y") as date_start'),
                    'time_start',
                    'time_end',
                )
            )
                ->groupBy(['date_start'])
                ->map(function ($items) {
                    $sum = 0;

                    foreach ($items as $item) {
                        $sum += $item->total_time_hours;
                    }

                    return $sum;
                })
                ->toArray();

            if ($data) {
                $dataset = array(
                    "label" =>  $type->name,
                    "data" => $data,
                    "borderWidth" => 1,
                    'backgroundColor' => $type->background_color,
                    'borderColor' => $type->font_color
                );

                array_push($chartDatasets, $dataset);
                $tableDatasets = array_merge($tableDatasets, array($type->name => $data));
            }
        }

        return [$chartDatasets, $tableDatasets];
    }
}
