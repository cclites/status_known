<?php

namespace Tests\Functions;

use App\Permission as P;
use App\Role as R;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Faker\Generator as Faker;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserControllersTest extends TestCase
{
    use RefreshDatabase;

    public $business;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->user->assignRole(R::BUSINESS);
        Auth::login($this->user, true);
    }

    public function testUserCanBeCreated(){

        $this->user->givePermissionTo(P::CAN_CREATE);

        $newUser = factory(User::class)->make()->toArray();


        $response = $this
            ->actingAs($this->user)
            ->post('/users/', $newUser);


        $response->assertStatus(200);

    }

}
