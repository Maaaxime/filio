<?php

use App\Models\AttendanceSchedule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceScheduleEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_schedule_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AttendanceSchedule::class, 'schedule_id');
            $table->date('schedule_date');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_schedule_entries');
    }
}
