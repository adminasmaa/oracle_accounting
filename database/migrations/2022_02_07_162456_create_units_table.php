<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->nullable();;
            $table->float('pieces')->default(0)->nullable();;
            $table->string('measruing_unit')->nullable();;
            $table->float('selling_price')->default(0);
            $table->float('purchasing_price')->default(0);
            $table->unsignedBigInteger('item_id')->nullable()->index();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
        Schema::dropIfExists('units');
    }
}
