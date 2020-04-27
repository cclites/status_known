<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role as R;
use APp\Permission as P;

class UserTest extends TestCase
{

    use RefreshDatabase;

    public $user;


    /**
     * Make sure we have a test user
     */
    public function testUserCanBeCreated()
    {
        $this->user = factory(\App\User::class)->create();
        $this->assertIsObject($this->user);
    }

    public function testCanAddRoleToUser()
    {
        $user = factory(\App\User::class)->create();
        $user->assignRole(R::ADMIN);
        $this->assertTrue($user->hasRole('admin'));
    }

    public function testCanRemoveRoleFromUser()
    {
        $user = factory(\App\User::class)->create();
        $user->assignRole(R::ADMIN);
        $this->assertTrue($user->hasRole('admin'));

        $user->removeRole(R::ADMIN);
        $this->assertFalse($user->hasRole('admin'));
    }

    public function testCanAddPermissionToUserRole()
    {
        $user = factory(\App\User::class)->create();
        $user->assignRole(R::ADMIN);

        $role = Role::findByName('admin');
        $role->givePermissionTo(P::CAN_READ);

        $this->assertTrue($user->hasPermissionTo(P::CAN_READ));
    }

}
