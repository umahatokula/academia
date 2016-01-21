<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->integer('phone');
            $table->string('email')->unique();
            $table->text('address');
            $table->string('occupation');
            $table->integer('gender_id');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('local_id');
            $table->integer('religion_id');
            $table->integer('blood_group_id');
            $table->integer('staff')->nullable();
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
        Schema::drop('parents');
    }
}
