<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBusinesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name', 100)->unique();
            $table->unsignedBigInteger('responsible_agent_id'); //Agent responsible for everything. Is FK
            $table->string('address_1', 150);
            $table->string('address_2', 150)->nullable();
            $table->string('city', 50);
            $table->string('state', 25);
            $table->string('zip', 12);
            $table->string('phone', 32);
            $table->timestamps();

            $table->foreign('responsible_agent_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
