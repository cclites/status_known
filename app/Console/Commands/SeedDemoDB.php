<?php
namespace App\Console\Commands;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Faker\Generator as Faker;

use App\Role as R;
use App\Permission as P;

class SeedDemoDB extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed-demo-db';

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
        //Drop and recreate database
        DB::connection()->getPdo()->exec("DROP DATABASE `status_known`");
        DB::connection()->getPdo()->exec("CREATE DATABASE `status_known`");
        DB::connection()->getPdo()->exec("USE`status_known`");

        //Run migrations
        Artisan::call("migrate");

        echo "Migrations complete.\n";
        //return;

        //$randBusinessCount = rand(2, 6);
        $randBusinessCount = 1;

        for($i=0; $i < $randBusinessCount; $i += 1){

            echo "Creating business.\n";

            $business = factory(\App\Business::class)
                ->create();

            echo "Business has been created\n";



            /*
            factory(\App\Account::class)
                ->create([
                    'business_id' => $business->id,
                    'data' => Crypt::encrypt($this->makeData())
                ]);*/

            $randUserCount = rand(1,5);

            for($j=0; $j < $randUserCount; $j += 1){

                $user = factory(\App\User::class, $randUserCount)
                    ->create([
                        'business_id' => $business->id,
                    ]);



                $user[0]->assignRole(R::BUSINESS);
                $user[0]->givePermissionTo(P::CAN_READ, P::CAN_CREATE, P::CAN_DELETE, P::CAN_UPDATE);


                /*
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
                            'record_id' => $record['id'], //TODO: Fully seperate records and reports
                        ]);

                    factory(\App\Invoice::class)->create([
                        'business_id' => $business->id,
                        'tracking' => $record['tracking'],
                        'amount' => $record['amount'],
                    ]);
                }
*/
            }

        }

        Artisan::call("setup:demo_admin");
        Artisan::call("setup:demo_user");
        Artisan::call("setup:demo_api_user");

    }

    public function makeData(Faker $faker){


        $data = [
            'addresses' => [
                [
                    'address_1' => $faker->streetAddress,
                    'city' => $faker->city,
                    'state' => $faker->state,
                    'zip' => $faker->postcode,
                ],
                [
                    'address_1' => $faker->streetAddress,
                    'city' => $faker->city,
                    'state' => $faker->state,
                    'zip' => $faker->postcode,
                ],
                [
                    'address_1' => $faker->streetAddress,
                    'city' => $faker->city,
                    'state' => $faker->state,
                    'zip' => $faker->postcode
                ],
            ],
            'driving' => [
                [
                    'date' => $faker->year,
                    'county' => $faker->firstNameFemale,
                    'state' => $faker->state,
                    'violation' => $faker->text(25)
                ],
                [
                    'date' => $faker->year,
                    'county' => $faker->firstNameFemale,
                    'state' => $faker->state,
                    'violation' => $faker->text(25)
                ],
                [
                    'date' => $faker->year,
                    'county' => $faker->firstNameFemale,
                    'state' => $faker->state,
                    'violation' => $faker->text(25)
                ],
            ],
            'criminal' => [
                [
                    'date' => $faker->year,
                    'county' => $faker->firstNameFemale,
                    'state' => $faker->state,
                    'violation' => $faker->text(50),
                    'disposition' => $faker->text(45),
                ],
                [
                    'date' => $faker->year,
                    'county' => $faker->firstNameFemale,
                    'state' => $faker->state,
                    'violation' => $faker->text(50),
                    'disposition' => $faker->text(45),
                ],
                [
                    'date' => $faker->year,
                    'county' => $faker->firstNameFemale,
                    'state' => $faker->state,
                    'violation' => $faker->text(50),
                    'disposition' => $faker->text(45),
                ],
            ]
        ];

        return $data;

    }


}
