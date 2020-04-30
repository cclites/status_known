<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Account::class)->create();
        /*
        factory(App\Account::class)->create()->each(function ($user) {
            $user->posts()->save(factory(App\Post::class)->make());
        });*/
    }
}
