<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Hash;

use App\Role as R;
use App\Permission as P;


class AddDemoAPIUser extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:demo_api_user';

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

        $user->name = "Demo API User";
        $user->password = Hash::make('demo');
        $user->business_id = \App\Business::all()->random()->id;
        $user->email = 'demoApiUser@acctix.com';

        $user->save();

        $user->assignRole(R::API);
        $user->givePermissionTo(P::CAN_READ, P::CAN_CREATE);

    }
}
