<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('type', 24); //eg. primary, secondary, emergency
            $table->string('number', 24)->notNull();
            $table->string('extension')->nullable();
            $table->string('contact_name', 100);
            $table->unsignedBigInteger('business_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_numbers');
    }
}
