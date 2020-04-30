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
        $user = $this->call(UsersTableSeeder::class);
        $business = $this->call(BusinessesTableSeeder::class, ['user'=>$user]);
        $account = $this->call(AccountsTableSeeder::class);
        $invoice = $this->call(InvoicesTableSeeder::class);
        $payment = $this->call(PaymentsTableSeeder::class);
        $provider = $this->call(ProvidersTableSeeder::class);
        $record = $this->call(RecordsTableSeeder::class);
        $reports = $this->call(ReportsTableSeeder::class);
    }
}
