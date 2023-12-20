<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLimitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limitations', function (Blueprint $table) {
            $table->id()->index();
            $table->bigInteger('payroll_id')->nullable()->index();
            $table->bigInteger('invoice_id')->nullable()->index();
            $table->bigInteger('arrest_receipt_id')->nullable()->index();
            $table->date('date')->nullable();
            $table->string('description')->nullable();
            $table->string('debit_amount')->nullable();
            $table->string('credit_amount')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable()->index();
            $table->bigInteger('index_account_id')->nullable()->index();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('limitations');
    }
}
