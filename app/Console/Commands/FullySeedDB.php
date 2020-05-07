<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Faker\Generator as Faker;

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

        $randBusinessCount = rand(12, 25);

        $provider = factory(\App\Provider::class)->create();


        $businesses = factory(\App\Business::class, $randBusinessCount)
                        ->create()
                        ->each(function($business){

                            factory(\App\Account::class)
                                ->create([
                                    'business_id' => $business->id
                                ]);

                            $randUserCount = rand(0,5);

                            factory(\App\User::class, $randUserCount)->create([
                                'business_id' => $business->id
                            ])->each(function(\App\User $user) use($business){
                                $randRecordsCount = rand(10, 100);
                                factory(\App\Record::class, $randRecordsCount)
                                        ->create([
                                            'business_id' => $business->id,
                                            'created_by_id' => $user->id
                                        ])
                                        ->each(function($record) use($business, $user){

                                            factory(\App\Report::class)
                                                ->create([
                                                    'business_id' => $business->id,
                                                    'requested_by_id' => $user->id,
                                                    'tracking' => $record->tracking,
                                                ]);

                                            factory(\App\Invoice::class)->create([
                                                'business_id' => $business->id,
                                                'tracking' => $record->tracking,
                                                'amount' => $record->amount,
                                            ]);
                                        });
                            });


                        });

    }
}
