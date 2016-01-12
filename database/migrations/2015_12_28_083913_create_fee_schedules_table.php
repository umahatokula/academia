<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_schedules', function (Blueprint $table) {
            $table->string('fee_schedule_code');
            $table->integer('fee_element_id');
            $table->double('amount', 15, 2)->default(0.00);
            $table->string('session');
            $table->integer('term_id');
            $table->integer('class_id');
            $table->integer('status_id')->default(1);
            $table->primary(array('fee_schedule_code', 'fee_element_id'));
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
        Schema::drop('fee_schedules');
    }
}
