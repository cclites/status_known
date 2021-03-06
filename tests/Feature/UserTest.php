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
use App\Permission as P;

class UserTest extends TestCase
{

    use RefreshDatabase;

    public $user;

    protected function setUp() : void
    {
        echo "\nUser tests\n";

        parent::setUp();
        $this->user = factory(\App\User::class)->create();
    }

    public function testUserCanBeCreated()
    {
        $this->assertTrue(true);
    }

    public function testCanAddRoleToUser()
    {
        $user = $this->user;
        $user->assignRole(R::ADMIN);
        $this->assertTrue($user->hasRole('admin'));
    }

    public function testCanRemoveRoleFromUser()
    {
        $user = $this->user;
        $user->assignRole(R::ADMIN);
        $this->assertTrue($user->hasRole('admin'));

        $user->removeRole(R::ADMIN);
        $this->assertFalse($user->hasRole('admin'));
    }

    public function testCanAddPermissionToUserRole()
    {
        $user = $this->user;
        $user->assignRole(R::ADMIN);
        $user->givePermissionTo(P::CAN_READ);

        $this->assertTrue($user->hasPermissionTo(P::CAN_READ));
    }

}
