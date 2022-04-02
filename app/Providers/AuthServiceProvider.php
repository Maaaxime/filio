<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\AttendanceEntry' => 'App\Policies\AttendanceEntryPolicy',
        'App\Models\AttendanceSchedule' => 'App\Policies\AttendanceSchedulePolicy',
        'App\Models\AttendanceScheduleEntry' => 'App\Policies\AttendanceScheduleEntryPolicy',
        'App\Models\AttendanceType' => 'App\Policies\AttendanceTypePolicy',
        'App\Models\Child' => 'App\Policies\ChildPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
