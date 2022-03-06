<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->unique();
            $table->string('address');
            $table->string('address2');
            $table->string('city');
            $table->string('postCode');
            $table->string('phoneNo');
            $table->string('phoneNo2');
            $table->string('email');
            $table->string('homePage');
            $table->string('registrationNo');
            $table->integer('typeId');
            $table->string('bankName');
            $table->string('bankAccountNo');
            $table->string('bankIBAN');
            $table->string('bankSWIFTCode');
            $table->string('cafEmail');
            $table->string('cafCaseNo');
            $table->string('cafSiasCaseNo');
            $table->binary('brandPicture');
            $table->string('brandColorCode');
            $table->integer('systemIndicatorId');
            $table->string('systemIndicatorCustomText');
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
        Schema::dropIfExists('companies');
    }
}
