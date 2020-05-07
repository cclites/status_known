<?php

namespace App\Console\Commands;



use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use App\Permission as P;

use Illuminate\Support\Facades\Hash;

class AddDemoUser extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:demo_user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Demo User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = new \App\User();

        $user->name = "Demo User #1";
        $user->password = Hash::make('demo');
        $user->business_id = 0;
        $user->email = 'demoUser@acctix.com';

        $user->save();

        $user->assignRole(R::BUSINESS);
        $user->givePermissionTo(P::CAN_READ, P::CAN_CREATE, P::CAN_DELETE, P::CAN_UPDATE);

    }
}
