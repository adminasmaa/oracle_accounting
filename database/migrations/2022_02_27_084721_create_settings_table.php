<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id()->index();
            $table->string('company_name');
            $table->string('company_phone')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_manager')->nullable();
            $table->text('company_description')->nullable();
            $table->bigInteger('payment_selling_account_index_id')->nullable()->index();
            $table->bigInteger('payment_parchasing_account_index_id')->nullable()->index();
            $table->bigInteger('inbox_account_index_id')->nullable()->index();
            $table->bigInteger('salary_account_index_id')->nullable()->index();
            $table->bigInteger('customers_account_index_id')->nullable()->index();
            $table->bigInteger('suppliers_account_index_id')->nullable()->index();
            $table->bigInteger('discount_earned_account_index_id')->nullable()->index(); // الخصم المكتسب
            $table->bigInteger('allowed_discount_account_index_id')->nullable()->index(); // الخصم المسموح بة


            $table->text('path')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
