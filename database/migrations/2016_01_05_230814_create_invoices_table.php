<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->integer('student_id');
            $table->string('fee_schedule_code');
            $table->string('invoice_number');
            $table->double('amount', 15, 2);
            $table->double('discount', 15, 2);
            $table->double('balance', 15, 2);
            $table->double('total', 15, 2);
            $table->json('exempted_fee_elements')->nullable();
            $table->integer('status_id')->default(4);
            $table->primary(array('student_id', 'fee_schedule_code'));
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
        Schema::drop('invoices');
    }
}
