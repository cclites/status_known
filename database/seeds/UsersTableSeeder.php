<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use APp\Permission as P;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\User::class)->create();

        //Add a business role to the user
        $user->assignRole(R::BUSINESS);

        //Give permissions to the user
        $user->givePermissionTo(P::CAN_UPDATE, P::CAN_DELETE, P::CAN_CREATE, P::CAN_READ);

        $user->save();
    }
}
