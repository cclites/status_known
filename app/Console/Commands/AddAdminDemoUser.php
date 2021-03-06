<?php
namespace App\Console\Commands;

use Illuminate\Support\Facades\Hash;

use App\Role as R;
use App\Permission as P;


class AddAdminDemoUser extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:demo_admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Demo Admin';

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

        $user->name = "Demo Admin";
        $user->password = Hash::make('demo');
        $user->business_id = 0;
        $user->email = 'demoAdmin@acctix.com';

        $user->save();

        $user->assignRole(R::ADMIN, R::API);

        $user->givePermissionTo(P::CAN_READ, P::CAN_CREATE, P::CAN_DELETE, P::CAN_UPDATE);

    }
}
