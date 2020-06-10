<?php

namespace Tests\Functions;

use App\Permission as P;
use App\Role as R;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class InvoiceControllersTest extends TestCase
{
    public $business;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->user->assignRole(R::BUSINESS);
        Auth::login($this->user, true);
    }

    public function testInvoiceCanBeCreated(){

        $this->user->givePermissionTo(P::CAN_CREATE);

        $InvoiceData = [
            'name' => 'Test Business',
            'responsible_agent_id' => $this->user->id,
            'email' => 'business@business.com',
            'api_token' => Hash::make(Str::random(32)),
        ];

        $response = $this
            ->actingAs($this->user)
            ->post('/businesses/', $businessData);

        $response->assertStatus(200);

    }

}
