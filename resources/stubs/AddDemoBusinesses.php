<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use App\Permission as P;

use Illuminate\Support\Facades\Hash;

class AddDemoBusinesses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:demo_business';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo business setup';

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
        //\DB::statement("DROP DATABASE `status_known`");
       // \DB::statement("CREATE DATABASE `status_known`");


        //sleep(5);
        //\DB::statement("USE `status_known`");

        //sleep(5);
        //$this->command('php artisan migrate');
        //\Artisan::call('migrate');
        //echo "Getting ready to sleep\n";
        //sleep(60);

        echo "Adding records\n";
        $business = factory(\App\Business::class)->create(['name'=>'Demo Business 1']);

        $hashedPassword = Hash::make('demo');

        $user1 = factory(\App\User::class)->create(['business_id'=> $business['id'], 'name'=>'Demo User 1', 'password' => $hashedPassword]);
        $user1->assignRole(R::BUSINESS);
        $user1->givePermissionTo(P::CAN_READ);

        $user2 = factory(\App\User::class)->create(['business_id'=> $business['id'], 'name'=>'Demo User 2', 'password' => $hashedPassword]);
        $user2->assignRole(R::BUSINESS);
        $user2->givePermissionTo(P::CAN_CREATE);

        $user3 = factory(\App\User::class)->create(['business_id'=> $business['id'], 'name'=>'Demo User 3', 'password' => $hashedPassword]);
        $user3->assignRole(R::BUSINESS);
        $user3->givePermissionTo(P::CAN_READ, P::CAN_CREATE, P::CAN_UPDATE, P::CAN_DELETE);

        $user1['records'] = factory(\App\Record::class, 4)
                                   ->create(['business_id'=> $business['id'], 'created_by_id'=> $user1['id']])
                                    ->each(function($record) use($business, $user1){

                                        factory(\App\Report::class)->create(['business_id'=> $business['id'],  'requested_by_id' => $user1['id'], 'tracking' => $record['tracking'], 'record_id' => $record['id']]);
                                        factory(\App\Invoice::class)->create(['business_id'=> $business['id'], 'tracking' => $record['tracking']]);
                                    });

        $user2['records'] = factory(\App\Record::class, 8)
            ->create(['business_id'=> $business['id'], 'created_by_id'=> $user2['id']])
            ->each(function($record) use($business, $user2){

                factory(\App\Report::class)->create(['business_id'=> $business['id'],  'requested_by_id' => $user2['id'], 'tracking' => $record['tracking'], 'record_id' => $record['id']]);
                factory(\App\Invoice::class)->create(['business_id'=> $business['id'], 'tracking' => $record['tracking']]);
            });
    }
}
