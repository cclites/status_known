<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_by_id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->double('amount');
            $table->binary('data');
            $table->string('tracking', 32);

            $table->timestamps();

            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('business_id')->references('id')->on('businesses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
