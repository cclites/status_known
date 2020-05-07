<?php

namespace App\Console\Commands;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use App\Permission as P;


class addReadPermissions extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:permission';

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
        $users = \App\User::where("id", ">", 1)
                    ->get()
                    ->each(function($user){

                        $user->assignRole(R::BUSINESS);
                        $user->givePermissionTo(P::CAN_READ, P::CAN_CREATE);

                    });
    }
}
