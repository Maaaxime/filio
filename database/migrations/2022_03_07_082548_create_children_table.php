<?php

use App\Models\AttendanceSchedule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('children');
        Schema::create('children', function (Blueprint $table) {
            $table->increments('id');

            /* General Informations */
            $table->string('image')->default('child.png');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->integer('gender');
            $table->date('birthdate')->nullable();
            $table->string('city_of_birth', 30)->nullable();
            $table->string('phone_no', 30)->nullable();
            $table->string('email', 80)->nullable();

            $table->text('medical_conditions')->nullable();
            $table->text('medical_medications')->nullable();
            $table->text('medical_allergies')->nullable();
            $table->string('blood_type', 20)->nullable();
            $table->string('doctor_name', 100)->nullable();
            $table->text('doctor_address')->nullable();
            $table->string('doctor_phone_no', 30)->nullable();

            /* Family Situation */
            $table->string('address', 100)->nullable();
            $table->string('address2', 50)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('postCode', 30)->nullable();

            $table->integer('no_dependant_children')->nullable();
            $table->integer('no_children_less_7yo')->nullable();
            $table->enum('legal_regime', array('general', 'officier','msa','other'))->nullable();
            $table->string('legal_regime_other', 100)->nullable();

            $table->string('legal_tutor1_name', 100)->nullable();
            $table->string('legal_tutor1_socialsecurity', 30)->nullable();
            $table->string('legal_tutor1_caf', 30)->nullable();
            $table->string('legal_tutor1_job_title', 100)->nullable();
            $table->text('legal_tutor1_address')->nullable();
            $table->string('legal_tutor1_phone_no', 30)->nullable();

            $table->string('legal_tutor2_name', 100)->nullable();
            $table->string('legal_tutor2_socialsecurity', 30)->nullable();
            $table->string('legal_tutor2_caf', 30)->nullable();
            $table->string('legal_tutor2_job_title', 100)->nullable();
            $table->text('legal_tutor2_address')->nullable();
            $table->string('legal_tutor2_phone_no', 30)->nullable();          

            $table->text('authorized_persons')->nullable();

            /* Contracts Informations */
            $table->date('contract_starting_date')->nullable();
            $table->date('contract_ending_date')->nullable();
            $table->float('annual_resources')->nullable();
            $table->float('children_care_expenses')->nullable();
            $table->float('alimony_paid')->nullable();
            $table->float('applicable_rate')->nullable();
            $table->timestamp('contract_edited_at')->nullable();
            $table->foreignIdFor(AttendanceSchedule::class, 'schedule_id');
            
            $table->timestamps();
        });

        Schema::dropIfExists('child_user');
        Schema::create('child_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('child_id')->unsigned();
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
        Schema::dropIfExists('model_has_children');
        Schema::dropIfExists('child_user');
        Schema::dropIfExists('children');
    }
}
