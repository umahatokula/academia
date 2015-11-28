<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('mname');
            $table->integer('parent_id');
            $table->integer('class_id')->nullable();
            $table->integer('phone');
            $table->text('address');
            $table->string('dob');
            $table->integer('height');
            $table->integer('weight');
            $table->integer('gender_id');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('local_id');
            $table->integer('religion_id');
            $table->integer('blood_group_id');
            $table->softDeletes();
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
        Schema::drop('students');
    }
}
