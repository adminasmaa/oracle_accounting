<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrestReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrest_receipts', function (Blueprint $table) {
            $table->id()->index();
            $table->bigInteger('invoice_id')->nullable()->index();
            $table->float('batch_quantity')->default(0);
            $table->date('date')->nullable();
            $table->float('advance')->nullable();
            $table->string('description')->nullable();
            $table->string('index_account_id')->nullable()->index();
            $table->string('reportuser')->nullable();
            $table->string('balance')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arrest_receipts');
    }
}
