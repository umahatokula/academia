<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_chart_of_account')->nullable();
            $table->string('item_title');
            $table->integer('account_code')->nullable();
            $table->integer('radix_no');
            $table->integer('parent_radix_id');
            $table->integer('item_level');
            $table->integer('id_parent');
            $table->integer('status_id');
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
        Schema::drop('chart_of_accounts');
    }
}
