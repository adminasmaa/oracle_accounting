<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_items', function (Blueprint $table) {
            $table->id()->index();
            $table->bigInteger('user_id')->nullable()->index();
            $table->float('advance')->default(0);
            $table->float('paying_off')->default(0);
            $table->bigInteger('payroll_id')->nullable()->index();
            $table->float('salary')->nullable()->index();
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
        Schema::dropIfExists('payroll_items');
    }
}
