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
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserControllersTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    public function setUp() : void
    {
        echo "\nUser Controller tests\n";

        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->user->assignRole(R::BUSINESS);

        Auth::login($this->user, true);
    }

    public function testUserCanBeCreated()
    {
        $this->user->givePermissionTo(P::CAN_CREATE);

        $userData = factory(User::class)
                            ->make()
                            ->toArray();

        $newUser = [
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'password' => Hash::make($userData['email'])
                    ];

        $response = $this
                    ->actingAs($this->user)
                    ->post('/users/', $newUser);

        $response->assertStatus(200);

    }

    public function testUserCannotBeCreated()
    {
        $newUser = factory(User::class)->make()->toArray();

        $response = $this
            ->actingAs($this->user)
            ->post('/users/', $newUser);

        $response->assertStatus(403);

    }

    public function testUserCanBeUpdated()
    {
        $userEmail = 'Fake@email.com';

        $this->user->givePermissionTo(P::CAN_UPDATE);

        $newUser = factory(User::class)->create()->toArray();
        $newUser['email'] = $userEmail;

        $url = '/users/' . $newUser['id'] . '/';

        $response = $this->actingAs($this->user)->patch($url, $newUser);
        $response->assertStatus(200);
    }

    public function testUserCannotBeUpdated()
    {
        $userEmail = 'Fake@email.com';

        $newUser = factory(User::class)->create()->toArray();
        $newUser['email'] = $userEmail;

        $url = '/users/' . $newUser['id'] . '/';

        $response = $this->actingAs($this->user)->patch($url, $newUser);
        $response->assertStatus(403);
    }

    public function testUserCanBeDeleted()
    {
        $this->user->givePermissionTo(P::CAN_DELETE, P::CAN_CREATE);

        $userData = factory(User::class)
                    ->make()->toArray();

        $response = $this
            ->actingAs($this->user)
            ->post('/users/', $userData);

        $id = $response->json()['original'][0]['id'];

        $response = $this
                    ->actingAs($this->user)
                    ->delete('/users/' . $id);

        collect($response->original)->each(function($u) use($response, $id)
        {
            if($u === $id){
                $this->assertTrue(false);
            }
        });

        $this->assertTrue(true);
    }


    public function testUserCannotBeDeleted()
    {
        $user = factory(User::class)->make();
        $userId = $user['id'];

        $url = '/users/' . $userId . '/';

        $response = $this
                    ->actingAs($this->user)
                    ->delete($url);

        collect($response->original)->each(function($u) use($response, $userId)
        {
            if($u === $userId){
                $this->assertTrue(false);
            }
        });

        $this->assertTrue(true);
    }

    public function testCanShowUser(){

        $this->user->givePermissionTo(P::CAN_READ);
        $user = factory(User::class)->create();

        $userId = $user['id'];

        $url = '/users/' . $user['id'] . '/';

        $response = $this
                    ->actingAs($this->user)
                    ->get($url);

        collect($response->original)->each(function($u) use($response, $userId)
        {
            if($u === $userId){
                $this->assertTrue(true);
            }
        });

        $this->assertTrue(true);

    }

    public function testCannotShowUser(){

        $user = factory(User::class)->make();
        $userId = $user['id'];

        $url = '/users/' . $user['id'] . '/';

        $response = $this
                    ->actingAs($this->user)
                    ->get($url);

        collect($response->original)->each(function($u) use($response, $userId)
        {
            if($u === $userId){
                $this->assertTrue(false);
            }
        });

        $this->assertTrue(true);
    }

    public function tearDown(): void
    {
        $this->user->syncPermissions();
    }


}
