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
            $table->string('email', 64);
            $table->boolean('active')->default(true);
            $table->string('api_token')->nullable();
            $table->boolean('api_access')->default(false);
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
        Schema::dropIfExists('businesses');
    }
}
