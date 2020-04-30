<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BusinessesTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(InvoicesTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(RecordsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
    }
}
