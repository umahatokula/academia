<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountPolicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_policies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('discount_name');
            $table->integer('children_number')->nullable();
            $table->integer('all_wards')->nullable();
            $table->integer('dont_divide')->nullable();
            $table->string('type')->nullable();
            $table->integer('discount_duration')->nullable();
            $table->integer('ward_to_deduct')->nullable();
            $table->integer('percentage_value')->nullable();
            $table->json('affected_elements')->nullable();
            $table->integer('sum_value')->nullable();
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
        Schema::drop('discount_policies');
    }
}
