<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use App\Permission as P;

class AddAdminPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AddAdminPermissions {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $username = $this->argument('name');
        $user = \App\User::where('name', 'like', '%' . $username . '%')->first();

        $user->assignRole(R::ADMIN);
        $user->givePermissionTo(P::CAN_DELETE, P::CAN_UPDATE, P::CAN_READ, P::CAN_CREATE);

        echo $user->getAllPermissions() . "\n";
        echo $user->getRoleNames() . "\n";
    }
}
