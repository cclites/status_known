<?php

namespace Tests\Unit;

use App\Business;
use App\Permission as P;
use App\Role as R;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\Update\BusinessUpdateRequest;

/**
 * Class BusinessControllersTest
 * @package Tests\Unit
 */
class BusinessControllersTest extends TestCase
{

    use RefreshDatabase;

    public $user;
    public $business;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->user->assignRole(R::BUSINESS);
        Auth::login($this->user, true);


    }

    public function testBusinessCanBeCreated(){

        $this->user->givePermissionTo(P::CAN_CREATE);

        $businessData = [
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

    public function testBusinessCannotBeCreated()
    {
        $businessData = [
            'name' => 'Test Business',
            'responsible_agent_id' => $this->user->id,
            'email' => 'business@business.com',
            'api_token' => Hash::make(Str::random(32)),
        ];

        $response = $this
            ->actingAs($this->user)
            ->post('/businesses/', $businessData);

        $response->assertStatus(403);
    }

    public function testBusinessCanBeUpdated()
    {
        $businessName = 'Test Business';

        $this->user->givePermissionTo(P::CAN_UPDATE);
        $this->business = factory(Business::class)->create();
        $this->business->name = $businessName;
        $url = '/businesses/' . $this->business->id . '/';

        $response = $this->actingAs($this->user)->patch($url, $this->business->toArray());
        $data = $response->json();

        $this->assertEquals($data['name'], $businessName);
        $response->assertStatus(200);

    }

    public function testBusinessCannotBeUpdated()
    {
        $businessName = 'Test Business';

        $this->business = factory(Business::class)->create();
        $this->business->name = $businessName;
        $url = '/businesses/' . $this->business->id . '/';

        $response = $this->actingAs($this->user)->patch($url, $this->business->toArray());

        $response->assertStatus(403);
    }


    public function testBusinessCanBeDeleted()
    {
        $this->user->givePermissionTo(P::CAN_DELETE);
        $this->business = factory(Business::class)->create();

        $url = '/businesses/' . $this->business->id . '/';
        $response = $this->actingAs($this->user)->delete($url, $this->business->toArray());

        $response->assertStatus(200);
    }

    public function testBusinessCannotBeDeleted()
    {
        $this->business = factory(Business::class)->create();

        $url = '/businesses/' . $this->business->id . '/';
        $response = $this->actingAs($this->user)->delete($url, $this->business->toArray());

        $response->assertStatus(403);
    }

    public function testCanShowBusiness(){

        $this->user->givePermissionTo(P::CAN_READ);
        $this->business = factory(Business::class)->create();

        $url = '/businesses/' . $this->business->id . '/?json=1';
        $response = $this->actingAs($this->user)->get($url, $this->business->toArray());

        $response->assertStatus(200);
    }

    public function testCannotShowBusiness(){

        $this->business = factory(Business::class)->create();

        $url = '/businesses/' . $this->business->id . '/?json=1';
        $response = $this->actingAs($this->user)->get($url, $this->business->toArray());

        $response->assertStatus(403);
    }


}
