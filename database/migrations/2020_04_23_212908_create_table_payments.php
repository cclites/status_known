<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('amount');
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('invoice_id');
            $table->string('tracking', 32);
            $table->boolean('approved')->default(false);

            $table->timestamps();

            $table->foreign('business_id')->references('id')->on('businesses');
            $table->foreign('invoice_id')->references('id')->on('invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
