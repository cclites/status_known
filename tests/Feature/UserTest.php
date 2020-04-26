<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;



class UserTest extends TestCase
{

    use WithoutMiddleware;
    use DatabaseTransactions;

    public $user;


    /**
     * Make sure we have a test user
     */
    public function testUserCanBeCreated()
    {
        $this->user = $this->createUser();
        $this->assertIsArray($this->user);
    }

    public function testUserCanBeSaved(){


        $user = $this->user;

        //$response = $this->get('/');

        //$response->assertStatus(200);

        /*
        $response = $this->post(route('users_store', [$user]));

        $response->assertStatus(200);*/

        $this->postJson(route('users_store', [$user]))
            //->assertStatus(200)
        ->dump();

    }

    public function createUser(){

        $faker = Faker::create();

        $data = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        return $data;

        //return new User($data);
    }
/*
$this->putJson(route('users_store', ['user' => $this->user]))
->assertStatus(200);
*/

}
