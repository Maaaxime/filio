<?php

use App\Models\Children;
use App\Models\TimeEntryType;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('time_entry_types');
        Schema::create('time_entry_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('default')->default(false);
            $table->boolean('need_proof')->default(false);
            $table->boolean('need_permission')->default(false);
            $table->timestamps();
        });

        Schema::dropIfExists('time_entries');
        Schema::create('time_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignIdFor(Children::class,'children_id');
            $table->foreignIdFor(TimeEntryType::class,'entry_type_id');
            $table->datetime('time_start');
            $table->datetime('time_end')->nullable();
            $table->datetime('system_time_start');
            $table->datetime('system_time_end')->nullable();

            $table->foreignIdFor(User::class,'created_by_id');
            $table->foreignIdFor(User::class,'updated_by_id');
            $table->foreignIdFor(User::class,'deleted_by_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_entries');
        Schema::dropIfExists('time_entry_types');
    }
}
