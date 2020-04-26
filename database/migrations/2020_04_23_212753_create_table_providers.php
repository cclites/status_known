<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contact_name', 100)->unique();
            $table->string('company_name', 100)->unique();
            $table->string('provider_name', 100)->unique();
            $table->string('phone', 12);
            $table->string('email', 50);

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
        Schema::dropIfExists('providers');
    }
}
