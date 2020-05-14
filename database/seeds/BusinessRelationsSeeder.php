<?php

use Illuminate\Database\Seeder;

class BusinessRelationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * php artisan db:seed --class=BusinessRelationsSeeder
     */
    public function run()
    {
        $business = factory(App\Business::class)->create();
    }
}
