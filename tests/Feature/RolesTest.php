<?php

namespace Tests\Feature;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Permission as P;
use App\Role as R;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use RefreshDatabase;

    public $business;
    public $user1;
    public $user2;

    protected function setUp() : void
    {
        parent::setUp();
        echo "\nTesting Record Relations\n";

        $this->business = factory(\App\Business::class)->create(['name'=>'Demo Business 1']);
        $this->user1 = factory(\App\User::class)->create(['business_id'=> $this->business['id'], 'name'=>'Demo User 1']);
        $this->user2 = factory(\App\User::class)->create(['business_id'=> $this->business['id'], 'name'=>'Demo User 2']);

    }

    function testUserCanRead()
    {
        $this->user1->assignRole(R::BUSINESS);
        $this->user1->givePermissionTo(P::CAN_READ);
        $this->assertTrue($this->user1->hasPermissionTo(P::CAN_READ));
    }

    function testUserCannotRead()
    {
        $this->user2->assignRole(R::BUSINESS);
        $this->user2->givePermissionTo(P::CAN_CREATE);
        $this->assertFalse($this->user2->hasPermissionTo(P::CAN_READ));
    }
}
