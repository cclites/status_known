<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Spatie\Permission\Models\Permission;
use App\Permission as P;

class AddPermissionsToDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::create(['name' => P::CAN_READ]);
        Permission::create(['name' => P::CAN_DELETE]);
        Permission::create(['name' => P::CAN_UPDATE]);
        Permission::create(['name' => P::CAN_CREATE]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Permission::truncate();

    }
}
