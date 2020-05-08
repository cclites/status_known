<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Faker\Generator as Faker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Role as R;
use App\Permission as P;

class FullySeedDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:v1';

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

        $faker = new Faker();
        //generate between 6 and 10 businesses

        $randBusinessCount = rand(2, 6);

        for($i=0; $i < $randBusinessCount; $i += 1){

            $business = factory(\App\Business::class)
                        ->create();

            factory(\App\Account::class)
                ->create([
                    'business_id' => $business->id
                ]);

            $randUserCount = rand(1,5);

            for($j=0; $j < $randUserCount; $j += 1){

                $user = factory(\App\User::class, $randUserCount)
                            ->create([
                                'business_id' => $business->id,
                            ]);



                $user[0]->assignRole(R::BUSINESS);
                $user[0]->givePermissionTo(P::CAN_READ, P::CAN_CREATE, P::CAN_DELETE, P::CAN_UPDATE);


                $randRecordsCount = rand(1, 5);

                for($k=0; $k<$randRecordsCount; $k += 1){

                    $record = factory(\App\Record::class)
                                ->create([
                                    'business_id' => $business->id,
                                    'created_by_id' => $user[0]['id']
                                ]);

                    factory(\App\Report::class)
                        ->create([
                            'business_id' => $business->id,
                            'requested_by_id' => $user[0]['id'],
                            'tracking' => $record['tracking'],
                            'record_id' => $record['id'],
                        ]);

                    factory(\App\Invoice::class)->create([
                        'business_id' => $business->id,
                        'tracking' => $record['tracking'],
                        'amount' => $record['amount'],
                    ]);
                }

            }

        }

    }
}
